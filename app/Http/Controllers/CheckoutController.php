<?php

namespace App\Http\Controllers;

use App\Models\CustomerEbookAccess;
use App\Models\Ebook;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * The single product this store currently sells. See config/shop.php —
     * once there's more than one title, this should resolve from a route
     * parameter instead.
     */
    protected function ebook(): Ebook
    {
        return Ebook::where('slug', config('shop.ebook_slug'))
            ->published()
            ->firstOrFail();
    }

    public function show(Request $request)
    {
        $ebook = $this->ebook();
        $user = $request->user();

        // If this user already owns the book, send them straight to their download.
        $existingAccess = CustomerEbookAccess::where('user_id', $user->id)
            ->where('ebook_id', $ebook->id)
            ->whereNull('revoked_at')
            ->first();

        if ($existingAccess) {
            return redirect()->route('download')->with('info', 'You already own this book.');
        }

        // Reuse a recent, still-pending order for this user/book instead of
        // minting a new order number every time someone reloads the
        // checkout page (e.g. hits back from PayPal and returns).
        $order = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('created_at', '>=', now()->subMinutes(30))
            ->whereHas('items', fn ($q) => $q->where('ebook_id', $ebook->id))
            ->latest()
            ->first();

        if (! $order) {
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'SF-'.strtoupper(Str::random(10)),
                'status' => 'pending',
                'subtotal' => $ebook->price,
                'total' => $ebook->price,
                'currency' => $ebook->currency,
                'payment_provider' => 'paypal',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'ebook_id' => $ebook->id,
                'product_title_snapshot' => $ebook->title,
                'unit_price_snapshot' => $ebook->price,
                'quantity' => 1,
                'line_total' => $ebook->price,
            ]);
        }

        ProductEvent::log(ProductEvent::CHECKOUT_STARTED, [
            'ebook_id' => $ebook->id,
            'user_id' => $user->id,
            'order_id' => $order->id,
        ]);

        return view('pages.checkout', compact('ebook', 'order'));
    }

    /**
     * Where PayPal sends the buyer back after they approve (or cancel) the
     * payment. This page is UX only — it never grants access itself. The
     * order's status is only ever changed by PayPalWebhookController once
     * PayPal's IPN confirms the payment server-to-server, which can arrive
     * slightly before or after the buyer lands back here.
     */
    public function complete(Request $request)
    {
        $orderNumber = $request->query('order');

        $order = Order::with('items')
            ->where('user_id', $request->user()->id)
            ->when($orderNumber, fn ($q) => $q->where('order_number', $orderNumber))
            ->latest()
            ->first();

        if (! $order) {
            return redirect()->route('checkout');
        }

        $access = $order->status === 'paid'
            ? CustomerEbookAccess::where('user_id', $order->user_id)
                ->where('ebook_id', $order->items->first()?->ebook_id)
                ->first()
            : null;

        return view('pages.purchase-complete', compact('order', 'access'));
    }

    public function download(Request $request)
    {
        $ebook = $this->ebook();

        $access = CustomerEbookAccess::where('user_id', $request->user()->id)
            ->where('ebook_id', $ebook->id)
            ->whereNull('revoked_at')
            ->first();

        if (! $access) {
            return redirect()->route('pricing')->with('info', 'You don\'t have access to this book yet.');
        }

        return view('pages.download', compact('ebook', 'access'));
    }
}
