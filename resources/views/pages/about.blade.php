<x-layout title="About" description="Why From SEO to Semantic Discovery exists and who it's for.">

    <section class="px-6 pt-20 pb-16 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <x-badge>About</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Why this handbook exists</h1>
        </div>
    </section>

    <section class="px-6 pb-20 lg:px-8">
        <div class="mx-auto max-w-3xl space-y-6 text-base leading-relaxed text-slate-300">
            <p>
                Over the past several years, Google's search and recommendation systems — including the systems
                behind YouTube — have been steadily incorporating AI models that understand meaning and context
                alongside the keyword-matching techniques that have long defined search. Gemini, AI Overviews, and
                Semantic IDs are each part of that same gradual evolution, not isolated, disconnected updates.
            </p>
            <p>
                Much of what gets written about this shift falls into one of two categories: either too technical
                for a working creator to act on, or too alarmist to be useful. <span class="text-white">SemanticFuture</span>
                built <span class="text-white">From SEO to Semantic Discovery</span> to sit in between — grounded in
                how the technology actually works, translated into a practical framework, and organized around a
                consistent structure so every chapter ends in something you can apply.
            </p>
            <p>
                It's written for creators first — people who make videos for a living or a side income, not
                marketing teams optimizing a brand account. The goal isn't to create urgency. It's to help you
                understand a gradual, ongoing evolution clearly enough that you can prepare for it deliberately,
                without abandoning the SEO fundamentals that continue to serve you well.
            </p>
        </div>

        <div class="mx-auto mt-16 max-w-3xl">
            <x-card :hover="false">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Our approach</p>
                <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <p class="text-sm font-semibold text-white">Grounded in documentation</p>
                        <p class="mt-1 text-sm text-slate-400">Every chapter separates what's officially documented from what's interpretation, and from what's creator guidance.</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Written for action</p>
                        <p class="mt-1 text-sm text-slate-400">Every chapter follows the same structure and ends in a concrete creator checklist.</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Built for the long term</p>
                        <p class="mt-1 text-sm text-slate-400">Focused on durable principles, not a single algorithm update or news cycle.</p>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="mt-16 text-center">
            <x-button href="{{ route('pricing') }}" size="lg">See Pricing & Get the Book</x-button>
        </div>
    </section>

</x-layout>
