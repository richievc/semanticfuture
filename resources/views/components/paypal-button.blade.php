@props(['label' => 'Buy Now — Instant Download', 'order' => null])

@php
    $mode = config('shop.paypal_mode', 'sandbox');
    $checkoutUrl = config("shop.paypal_urls.$mode.checkout");

    // Prefer the actual order/ebook amount over the static config default,
    // so a price change in the admin panel is reflected at checkout instead
    // of silently charging the old config('shop.price') value.
    $lineItem = $order?->items?->first();
    $amount = $lineItem->line_total ?? $order->total ?? config('shop.price');
    $currency = $order->currency ?? config('shop.currency');
    $itemName = $lineItem->product_title_snapshot ?? config('shop.product_name');
@endphp

<form action="{{ $checkoutUrl }}" method="post" target="_top" class="w-full">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="{{ config('shop.paypal_business_email') }}">
    <input type="hidden" name="item_name" value="{{ $itemName }}">
    <input type="hidden" name="amount" value="{{ number_format((float) $amount, 2, '.', '') }}">
    <input type="hidden" name="currency_code" value="{{ $currency }}">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="no_note" value="1">
    @if ($order)
        {{-- Ties the eventual IPN notification back to the pending Order row
             created in CheckoutController@start. This is how we know which
             order to mark paid once PayPal confirms payment. --}}
        <input type="hidden" name="custom" value="{{ $order->order_number }}">
        <input type="hidden" name="invoice" value="{{ $order->order_number }}">
    @endif
    <input type="hidden" name="notify_url" value="{{ url(config('shop.ipn_url')) }}">
    <input type="hidden" name="return" value="{{ url(config('shop.return_url')).'?order='.($order->order_number ?? '') }}">
    <input type="hidden" name="cancel_return" value="{{ url(config('shop.cancel_url')) }}">

    <x-button type="submit" size="lg" {{ $attributes->class('w-full justify-center') }}>
        {{ $label }}
    </x-button>
</form>
