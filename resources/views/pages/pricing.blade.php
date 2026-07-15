<x-layout title="Pricing" description="Get From SEO to Semantic Discovery — one-time purchase, instant PDF download.">

    <section class="px-6 pt-20 pb-24 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <x-badge>Simple pricing</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">One book. One price. Yours to keep.</h1>
            <p class="mt-4 text-lg text-slate-400">No subscription, no upsell funnel — just the full handbook as an instant PDF download.</p>
        </div>

        <div class="mx-auto mt-16 flex max-w-3xl flex-col items-center gap-10 lg:flex-row lg:items-stretch lg:justify-center">
            <div class="flex items-center justify-center lg:pt-8">
                <x-book-cover size="lg" />
            </div>

            <div class="glass glow-border w-full max-w-md rounded-3xl p-8 text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-accent-300">From SEO to Semantic Discovery</p>
                <p class="mt-1 text-xs italic text-slate-500">The Changing Horizon</p>
                <p class="mt-4 flex items-center justify-center gap-1 text-white">
                    <span class="text-5xl font-bold tracking-tight">${{ number_format((float) ($ebook->price ?? config('shop.price')), 0) }}</span>
                    <span class="text-sm text-slate-400">USD</span>
                </p>
                <p class="mt-2 text-sm text-slate-400">One-time payment · instant access</p>

                <ul class="mt-8 space-y-3 text-left">
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Full 14-chapter handbook, PDF format
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        A built-in workbook — Knowledge Check, Creator Worksheet, Action Items &amp; Reflection Journal in every chapter
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        30-Day Semantic Discovery Workbook, week by week
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Semantic Readiness Scorecard + Quick Reference Guide
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Glossary + master creator checklist
                    </li>
                    <li class="flex items-start gap-3 text-sm text-slate-300">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        Free account, instant access to your download
                    </li>
                </ul>

                <div class="mt-8">
                    @if ($ebook)
                        <x-button href="{{ route('checkout') }}" size="lg" class="w-full justify-center">Buy Now</x-button>
                    @else
                        <x-button href="{{ route('ebooks.index') }}" size="lg" class="w-full justify-center">Browse E-book Store</x-button>
                    @endif
                </div>
                <p class="mt-4 text-xs text-slate-500">Secure checkout · one-time payment, no subscription. Sign in or create a free account at checkout.</p>
            </div>
        </div>

        <div class="mx-auto mt-10 max-w-md text-center">
            <p class="text-xs text-slate-500">
                Want to read a sample first? <a href="{{ route('preview') }}" class="text-accent-300 hover:text-accent-200">Read a free chapter</a>.
                Questions before buying? <a href="{{ route('contact') }}" class="text-accent-300 hover:text-accent-200">Contact us</a>.
            </p>
        </div>
    </section>

</x-layout>
