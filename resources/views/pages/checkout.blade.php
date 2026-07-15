<x-layout title="Checkout" description="Complete your order for {{ $ebook->title }}.">

    <section class="px-6 pt-20 pb-24 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <x-badge>Checkout</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Complete your order</h1>
            <p class="mt-4 text-lg text-slate-400">Review your order below, then continue to PayPal to pay securely.</p>
        </div>

        <div class="mx-auto mt-14 max-w-xl">
            <x-card :hover="false">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Order summary</p>

                <div class="mt-4 flex items-center gap-4 border-b border-white/5 pb-5">
                    <x-book-cover size="xs" />
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-white">{{ $ebook->title }}</p>
                        <p class="mt-1 text-xs text-slate-500">Instant PDF download</p>
                    </div>
                    <p class="text-sm font-semibold text-white">${{ number_format((float) $ebook->price, 2) }}</p>
                </div>

                <div class="flex items-center justify-between py-5 text-sm">
                    <span class="text-slate-400">Subtotal</span>
                    <span class="text-slate-200">${{ number_format((float) $ebook->price, 2) }}</span>
                </div>
                <div class="flex items-center justify-between border-b border-white/5 pb-5 text-sm">
                    <span class="text-slate-400">Total due today</span>
                    <span class="text-lg font-semibold text-white">${{ number_format((float) $ebook->price, 2) }} {{ $ebook->currency }}</span>
                </div>

                <div class="mt-6 rounded-xl border border-accent-400/20 bg-accent-500/5 p-4">
                    <p class="text-xs font-semibold text-accent-300">Order reference: <span class="font-mono">{{ $order->order_number }}</span></p>
                    <p class="mt-1 text-xs leading-relaxed text-slate-400">
                        You'll be taken to PayPal to pay securely. Once PayPal confirms your payment, your order is
                        marked paid automatically and your download unlocks immediately — you'll also get a
                        confirmation email with your download link.
                    </p>
                </div>

                <div class="mt-6">
                    <x-paypal-button :order="$order" label="Continue to PayPal" />
                </div>

                <p class="mt-4 text-center text-xs text-slate-500">
                    Secure checkout via PayPal. You can pay with a PayPal balance, bank account, or card.
                </p>
            </x-card>

            <div class="mt-8 text-center">
                <a href="{{ route('pricing') }}" class="text-sm text-slate-400 hover:text-accent-300">&larr; Back to pricing</a>
            </div>
        </div>
    </section>

</x-layout>
