<x-layout title="Order Status" description="Your order status for {{ $order->items->first()?->product_title_snapshot }}.">

    <section class="px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-lg text-center">

            @if ($order->status === 'paid')
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-accent-500/10 text-accent-300">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                </div>
                <x-badge class="mt-6">Order confirmed</x-badge>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">Payment received — you're all set.</h1>
                <p class="mt-4 text-base text-slate-400">
                    A confirmation email with your download link is on its way. You can also download right now below.
                </p>
            @elseif ($order->status === 'pending')
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-300">
                    <svg class="h-8 w-8 animate-spin" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                </div>
                <x-badge class="mt-6" variant="neutral">Confirming payment</x-badge>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">We're confirming your payment.</h1>
                <p class="mt-4 text-base text-slate-400">
                    PayPal is finalizing the transaction — this usually takes a few seconds, occasionally a couple of
                    minutes. Refresh this page in a moment, or check your email; we'll send your download link as
                    soon as it's confirmed.
                </p>
                <div class="mt-8">
                    <x-button href="{{ route('purchase-complete', ['order' => $order->order_number]) }}" variant="secondary">Refresh status</x-button>
                </div>
            @else
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-500/10 text-red-300">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </div>
                <x-badge class="mt-6" variant="neutral">Payment not completed</x-badge>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">This payment didn't go through.</h1>
                <p class="mt-4 text-base text-slate-400">
                    No charge was made and no order was created. You can try again, or
                    <a href="{{ route('contact') }}" class="text-accent-300 hover:text-accent-200">contact us</a> if
                    you keep seeing this.
                </p>
                <div class="mt-8">
                    <x-button href="{{ route('checkout') }}" size="lg">Try again</x-button>
                </div>
            @endif

            <div class="glass mt-8 rounded-2xl p-5 text-left">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-400">Order reference</span>
                    <span class="font-mono text-slate-200">{{ $order->order_number }}</span>
                </div>
                @foreach ($order->items as $item)
                    <div class="mt-3 flex items-center justify-between text-sm">
                        <span class="text-slate-400">Item</span>
                        <span class="text-slate-200">{{ $item->product_title_snapshot }}</span>
                    </div>
                @endforeach
                <div class="mt-3 flex items-center justify-between text-sm">
                    <span class="text-slate-400">Total</span>
                    <span class="text-slate-200">${{ number_format((float) $order->total, 2) }} {{ $order->currency }}</span>
                </div>
                <div class="mt-3 flex items-center justify-between text-sm">
                    <span class="text-slate-400">Status</span>
                    <span class="text-slate-200 capitalize">{{ $order->status }}</span>
                </div>
            </div>

            @if ($order->status === 'paid' && $access)
                <div class="mt-10">
                    <x-button href="{{ route('downloads.go', $access) }}" size="lg">Download Your E-book</x-button>
                </div>
            @endif
        </div>
    </section>

</x-layout>
