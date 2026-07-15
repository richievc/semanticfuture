<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Verifies a PayPal "Website Payments Standard" IPN postback the way
 * PayPal's classic IPN protocol requires: re-post the exact same body back
 * to PayPal with cmd=_notify-validate added, over a fresh connection, and
 * trust the notification only if PayPal responds with the literal string
 * "VERIFIED". This defends against forged POSTs to our webhook endpoint
 * that didn't actually come from PayPal.
 *
 * Reference: https://developer.paypal.com/api/nvp-soap/ipn/IPNImplementation/
 */
class PayPalIpnVerifier
{
    public function __construct(protected ?PendingRequest $http = null) {}

    public function verify(array $payload): bool
    {
        $mode = config('shop.paypal_mode', 'sandbox');
        $verifyUrl = config("shop.paypal_urls.$mode.ipn_verify");

        $body = array_merge($payload, ['cmd' => '_notify-validate']);

        try {
            $response = ($this->http ?? Http::asForm()->timeout(15))
                ->withBody(http_build_query($body), 'application/x-www-form-urlencoded')
                ->post($verifyUrl);
        } catch (\Throwable $e) {
            report($e);

            return false;
        }

        return $response->successful() && trim($response->body()) === 'VERIFIED';
    }
}
