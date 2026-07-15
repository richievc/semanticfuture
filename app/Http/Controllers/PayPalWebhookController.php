<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmed;
use App\Models\CustomerEbookAccess;
use App\Models\Ebook;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentEvent;
use App\Models\ProductEvent;
use App\Services\PayPalIpnVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PayPalWebhookController extends Controller
{
    public function handle(Request $request, PayPalIpnVerifier $verifier)
    {
        $payload = $request->all();

        // PayPal's classic IPN protocol identifies a notification by txn_id
        // (or, for non-payment IPNs, sometimes a different id) — this is
        // what we dedupe on. PayPal is documented to occasionally resend
        // the same IPN more than once, so this table (unique on
        // provider_event_id) is what makes replays a no-op instead of a
        // duplicate order/charge.
        $eventId = $payload['txn_id'] ?? $payload['ipn_track_id'] ?? null;

        if (! $eventId) {
            Log::warning('PayPal IPN received with no identifiable event id.', ['payload' => $payload]);

            return response('ignored', 200);
        }

        $existing = PaymentEvent::where('provider_event_id', $eventId)->first();

        if ($existing && $existing->processing_status === 'processed') {
            return response('ok', 200);
        }

        $event = $existing ?? PaymentEvent::create([
            'payment_provider' => 'paypal',
            'provider_event_id' => $eventId,
            'event_type' => $payload['txn_type'] ?? 'unknown',
            'processing_status' => 'pending',
            'payload' => $this->redactSensitive($payload),
        ]);

        if (! $verifier->verify($payload)) {
            $event->update([
                'processing_status' => 'failed',
                'failure_message' => 'IPN postback could not be verified with PayPal.',
            ]);

            Log::warning('PayPal IPN failed verification.', ['event_id' => $eventId]);

            return response('invalid', 400);
        }

        $orderNumber = $payload['custom'] ?? $payload['invoice'] ?? null;
        $order = $orderNumber ? Order::where('order_number', $orderNumber)->first() : null;

        if (! $order) {
            $event->update([
                'processing_status' => 'failed',
                'failure_message' => 'No matching order found for reference: '.($orderNumber ?? '(none)'),
            ]);

            return response('order not found', 200);
        }

        $event->update(['related_order_id' => $order->id]);

        $paymentStatus = $payload['payment_status'] ?? null;

        if ($paymentStatus === 'Completed') {
            $this->markPaid($order, $payload);
        } elseif (in_array($paymentStatus, ['Failed', 'Denied', 'Voided', 'Expired'], true)) {
            $this->markFailed($order, $paymentStatus);
        } elseif ($paymentStatus === 'Refunded') {
            $this->markRefunded($order);
        }
        // Pending/other statuses: leave the order as-is; a later IPN will
        // resolve it (e.g. eCheck clearing).

        $event->update(['processing_status' => 'processed', 'processed_at' => now()]);

        return response('ok', 200);
    }

    protected function markPaid(Order $order, array $payload): void
    {
        if ($order->status === 'paid') {
            return; // already processed by an earlier IPN for this order
        }

        DB::transaction(function () use ($order, $payload) {
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
                'paypal_capture_id' => $payload['txn_id'] ?? null,
            ]);

            $item = $order->items->first();
            $ebook = $item?->ebook ?? Ebook::find($item?->ebook_id);

            if (! $item || ! $ebook) {
                return;
            }

            $access = CustomerEbookAccess::updateOrCreate(
                ['user_id' => $order->user_id, 'ebook_id' => $ebook->id],
                [
                    'order_item_id' => $item->id,
                    'granted_at' => now(),
                    'revoked_at' => null,
                    'download_limit' => $ebook->max_downloads,
                ]
            );

            ProductEvent::log(ProductEvent::PURCHASE_COMPLETED, [
                'ebook_id' => $ebook->id,
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'customer_ebook_access_id' => $access->id,
            ]);

            if ($order->user?->email) {
                Mail::to($order->user->email)->send(new OrderConfirmed($order->fresh('items'), $access));
            }
        });
    }

    protected function markFailed(Order $order, string $status): void
    {
        if ($order->status === 'paid') {
            return;
        }

        $order->update([
            'status' => 'failed',
            'failure_reason' => 'PayPal payment_status: '.$status,
        ]);

        ProductEvent::log(ProductEvent::PURCHASE_FAILED, [
            'user_id' => $order->user_id,
            'order_id' => $order->id,
        ]);
    }

    protected function markRefunded(Order $order): void
    {
        $order->update(['status' => 'refunded', 'refunded_at' => now()]);

        // Refunded orders lose download access immediately, even against a
        // still-valid signed link that was emailed earlier.
        CustomerEbookAccess::whereHas('orderItem', function ($q) use ($order) {
            $q->where('order_id', $order->id);
        })->update(['revoked_at' => now()]);
    }

    /**
     * Strip fields that carry more payer/financial detail than the admin
     * analytics screens need, before persisting the raw payload for
     * troubleshooting. We deliberately keep enough to debug a mismatched
     * order, but not full payer name/address/email.
     */
    protected function redactSensitive(array $payload): array
    {
        foreach (['payer_email', 'first_name', 'last_name', 'address_street', 'address_city', 'address_state', 'address_zip', 'address_country', 'contact_phone'] as $key) {
            if (array_key_exists($key, $payload)) {
                $payload[$key] = '[redacted]';
            }
        }

        return $payload;
    }
}
