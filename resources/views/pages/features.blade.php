<x-layout title="Features" description="Everything inside From SEO to Semantic Discovery — full table of contents and what each chapter covers.">

    <section class="px-6 pt-20 pb-16 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <x-badge>Inside the book</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Everything you get</h1>
            <p class="mt-4 text-lg text-slate-400">14 chapters, a full workbook, and a 30-day implementation plan — organized to move from understanding to action, one consistent structure at a time.</p>
        </div>
    </section>

    <section class="px-6 pb-12 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <x-card :hover="false">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Every chapter follows the same structure</p>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-5">
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Overview</p>
                        <p class="mt-1 text-xs text-slate-500">The concept, plainly explained</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Why It Matters</p>
                        <p class="mt-1 text-xs text-slate-500">Relevance to your workflow</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Practical Guidance</p>
                        <p class="mt-1 text-xs text-slate-500">What to do, with examples</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Key Takeaways</p>
                        <p class="mt-1 text-xs text-slate-500">The short summary</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Creator Checklist</p>
                        <p class="mt-1 text-xs text-slate-500">Actions for your next upload</p>
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <section class="px-6 pb-12 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <x-card :hover="false">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">And a workbook built into every chapter</p>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Knowledge Check</p>
                        <p class="mt-1 text-xs text-slate-500">Confirm you've got the concept</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Creator Worksheet</p>
                        <p class="mt-1 text-xs text-slate-500">Apply it to your own channel</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Action Items</p>
                        <p class="mt-1 text-xs text-slate-500">A checklist for your next upload</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-semibold text-white">Reflection Journal</p>
                        <p class="mt-1 text-xs text-slate-500">Track what changed over time</p>
                    </div>
                </div>
            </x-card>
        </div>
    </section>

    <section class="px-6 pb-20 lg:px-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $parts = [
                    ['label' => 'Part I — Foundation', 'chapters' => [
                        'The Changing Horizon: Search Is Evolving',
                        'From Search Results to Answer Engines',
                        'Google\'s AI Ecosystem: Gemini, AI Overviews & Semantic Discovery',
                        'Semantic IDs: Foundations and Creator Relevance',
                        'YouTube\'s Evolving Recommendation System',
                        'Viewer Satisfaction Signals: Beyond Watch Time',
                    ]],
                    ['label' => 'Part II — The Framework', 'chapters' => [
                        'The Four Layers of Discoverability',
                        'Transcripts as a Semantic Foundation',
                        'Structuring Content: Chapters, Timestamps & Descriptions',
                        'Titles and Thumbnails in a Semantic Context',
                        'Community Signals and Cross-Platform Context',
                    ]],
                    ['label' => 'Part III — Applied', 'chapters' => [
                        'Tools, Workflow, and a 30-Day Creator Roadmap',
                        'Measuring Discovery: Metrics Old and New',
                        'Looking Ahead: Preparing for Continued Evolution',
                    ]],
                ];
            @endphp

            @foreach ($parts as $part)
                <x-card class="sm:col-span-2 lg:col-span-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">{{ $part['label'] }}</p>
                    <ul class="mt-4 space-y-3">
                        @foreach ($part['chapters'] as $chapter)
                            <li class="flex items-start gap-2 text-sm text-slate-300">
                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                <span>{{ $chapter }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-card>
            @endforeach
        </div>

        <div class="mx-auto mt-16 max-w-4xl">
            <x-card :hover="false">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Plus</p>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75V15m6-6l-6-6-6 6M6 15v3a3 3 0 003 3h6a3 3 0 003-3v-3" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">Traditional SEO vs. Semantic Discovery</p>
                            <p class="text-sm text-slate-400">A side-by-side comparison showing exactly how the two approaches relate — and why one doesn't replace the other.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">Quick Reference Guide</p>
                            <p class="text-sm text-slate-400">A printable, two-page production checklist for before, during, and after every recording.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">30-Day Semantic Discovery Workbook</p>
                            <p class="text-sm text-slate-400">A complete week-by-week plan: channel audit, improving existing videos, publishing semantic-ready content, and measuring results.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">Semantic Readiness Scorecard</p>
                            <p class="text-sm text-slate-400">Score your channel across nine categories, from transcript quality to accessibility, and re-check it every 30–60 days.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75z" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">Glossary</p>
                            <p class="text-sm text-slate-400">Every term in the book, defined in plain English.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <div>
                            <p class="text-sm font-semibold text-white">Master Creator Checklist</p>
                            <p class="text-sm text-slate-400">Every chapter's checklist consolidated into one reference you can run on every upload.</p>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="mt-16 text-center">
            <x-button href="{{ route('pricing') }}" size="lg">See Pricing & Get the Book</x-button>
        </div>
    </section>

</x-layout>
