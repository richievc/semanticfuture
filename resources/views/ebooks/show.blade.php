<x-layout :title="$ebook->title" :description="$ebook->short_description">

    {{-- ================= HERO ================= --}}
    <section class="px-6 pt-20 pb-16 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <a href="{{ route('ebooks.index') }}" class="text-sm text-slate-400 hover:text-accent-300">&larr; Back to E-book Store</a>

            <div class="mt-8 flex flex-col items-center gap-10 lg:flex-row lg:items-start">
                <div class="shrink-0">
                    <x-book-cover size="lg" />
                </div>

                <div class="flex-1">
                    <x-badge>E-book · PDF · 2026 Edition</x-badge>
                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $ebook->title }}</h1>
                    @if ($ebook->short_description)
                        <p class="mt-3 text-lg text-slate-400">{{ $ebook->short_description }}</p>
                    @endif

                    <p class="mt-6 text-base leading-relaxed text-slate-300">{{ $ebook->description }}</p>

                    <div class="glass glow-border mt-8 flex flex-wrap items-center justify-between gap-4 rounded-2xl p-6">
                        <div>
                            <p class="text-3xl font-bold text-white">${{ number_format((float) $ebook->price, 2) }} <span class="text-sm font-normal text-slate-400">{{ $ebook->currency }}</span></p>
                            <p class="text-xs text-slate-500">One-time payment · instant access</p>
                        </div>
                        <x-button href="{{ route('checkout') }}" size="lg">Get the Book</x-button>
                    </div>
                    <p class="mt-3 text-xs text-slate-500">Sign in or create a free account at checkout.</p>

                    <p class="mt-6 text-sm text-slate-500">
                        Want to read a sample first? <a href="#preview" class="text-accent-300 hover:text-accent-200">See a sample page below</a>,
                        or <a href="{{ route('preview') }}" class="text-accent-300 hover:text-accent-200">read a free chapter</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= OVERVIEW ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <x-section-heading
            eyebrow="Book overview"
            title="A handbook and a workbook, in one download."
            description="Google's search and recommendation systems — including YouTube's — are steadily layering AI-driven understanding of meaning and context on top of the keyword-matching techniques that have defined search for decades. This book explains that shift plainly, then gives you a working template for responding to it: a companion workbook built into every chapter."
        />

        <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-6 sm:grid-cols-3">
            <x-card :hover="false">
                <p class="text-3xl font-bold text-white">14</p>
                <p class="mt-1 text-sm text-slate-400">In-depth chapters, each with the same five-part structure</p>
            </x-card>
            <x-card :hover="false">
                <p class="text-3xl font-bold text-white">93</p>
                <p class="mt-1 text-sm text-slate-400">Pages, including diagrams, worksheets, and reference tools</p>
            </x-card>
            <x-card :hover="false">
                <p class="text-3xl font-bold text-white">56</p>
                <p class="mt-1 text-sm text-slate-400">Knowledge Check, Worksheet, Action Item &amp; Reflection sections</p>
            </x-card>
        </div>
    </section>

    {{-- ================= WHY IT MATTERS ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-14 lg:grid-cols-2">
            <div>
                <x-badge variant="neutral">Why this matters now</x-badge>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Search results are becoming search-and-AI results.
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-400">
                    AI Overviews now sit above traditional results for a meaningful share of queries. YouTube's
                    recommendation system increasingly understands what a video actually says and shows, not only
                    what its metadata claims. Creators who understand both layers — traditional SEO and this newer
                    semantic layer — are better positioned than creators who only understand one.
                </p>

                <ul class="mt-8 space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Newer and smaller channels can benefit — content-derived understanding doesn't depend on years of watch history.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Traditional SEO fundamentals aren't discarded — they're shown working alongside this new layer, not replaced by it.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Every chapter separates documented fact, interpretation, and creator guidance — so you always know how confident to be.</span>
                    </li>
                </ul>
            </div>

            <x-card :hover="false" class="glow-border">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Traditional SEO vs. Semantic Discovery</p>
                <table class="mt-4 w-full text-sm">
                    <tbody class="divide-y divide-white/5">
                        <tr><td class="py-2 text-slate-400">Keywords</td><td class="py-2 text-right text-white">Meaning</td></tr>
                        <tr><td class="py-2 text-slate-400">Metadata</td><td class="py-2 text-right text-white">Content understanding</td></tr>
                        <tr><td class="py-2 text-slate-400">Ranking</td><td class="py-2 text-right text-white">Ranking + recommendation + AI citation</td></tr>
                        <tr><td class="py-2 text-slate-400">Search results</td><td class="py-2 text-right text-white">Search + AI + discovery</td></tr>
                        <tr><td class="py-2 text-slate-400">Clicks</td><td class="py-2 text-right text-white">User understanding</td></tr>
                        <tr><td class="py-2 text-slate-400">Optimization</td><td class="py-2 text-right text-white">Semantic alignment</td></tr>
                    </tbody>
                </table>
                <p class="mt-4 text-xs text-slate-500">From the "A Closer Look" comparison inside the book.</p>
            </x-card>
        </div>
    </section>

    {{-- ================= WHAT'S INCLUDED ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <x-section-heading
            eyebrow="What you get"
            title="Everything you need to read once — and use every month."
        />

        <div class="mx-auto mt-12 grid max-w-6xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <x-card>
                <h3 class="text-lg font-semibold text-white">14 structured chapters</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">Overview, Why It Matters, Practical Guidance, Key Takeaways, and a Creator Checklist — the same rhythm every time, so you can skim or study.</p>
            </x-card>
            <x-card>
                <h3 class="text-lg font-semibold text-white">A workbook in every chapter</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">Knowledge Check questions, a hands-on Creator Worksheet, an Action Items checklist, and a Reflection Journal — so the book stays useful long after the first read.</p>
            </x-card>
            <x-card>
                <h3 class="text-lg font-semibold text-white">Quick Reference Guide</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">A printable, two-page production checklist — before, during, and after recording, plus a quick "do / avoid" semantic cheat sheet.</p>
            </x-card>
            <x-card>
                <h3 class="text-lg font-semibold text-white">30-Day Semantic Discovery Workbook</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">A complete, week-by-week implementation guide — channel audit, improving existing videos, publishing semantic-ready content, and measuring what changed.</p>
            </x-card>
            <x-card>
                <h3 class="text-lg font-semibold text-white">Semantic Readiness Scorecard</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">Score your channel across nine categories — from transcript quality to accessibility — and track your progress every 30–60 days.</p>
            </x-card>
            <x-card>
                <h3 class="text-lg font-semibold text-white">Glossary, checklist &amp; bibliography</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">A full glossary of terms, a consolidated master creator checklist, and a categorized bibliography of Google and YouTube documentation.</p>
            </x-card>
        </div>
    </section>

    {{-- ================= CHAPTER OVERVIEW ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <x-section-heading eyebrow="Inside the book" title="Chapter overview" />

        <div class="mx-auto mt-12 grid max-w-6xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
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

        <div class="mt-8 text-center">
            <a href="{{ route('features') }}" class="text-sm font-semibold text-accent-300 hover:text-accent-200">See the complete table of contents &rarr;</a>
        </div>
    </section>

    {{-- ================= WHO IT'S FOR ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <x-section-heading eyebrow="Who this is for" title="Written for people who actually make videos." />

        <div class="mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-6 sm:grid-cols-2">
            <x-card>
                <h3 class="text-base font-semibold text-white">This book is for you if…</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-400">
                    <li>· You make YouTube videos for a living, a side income, or a serious hobby.</li>
                    <li>· You want to understand AI Overviews, Semantic IDs, and Gemini without wading through research papers.</li>
                    <li>· You're a newer or smaller channel wondering whether content-derived understanding can help you.</li>
                    <li>· You want a repeatable production workflow, not a one-time tip list.</li>
                </ul>
            </x-card>
            <x-card>
                <h3 class="text-base font-semibold text-white">This book is probably not for you if…</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-400">
                    <li>· You're looking for guaranteed ranking outcomes or a "growth hack." This book explains a genuine, gradual technical shift — not a shortcut.</li>
                    <li>· You want deep, product-level engineering documentation rather than practical creator guidance.</li>
                </ul>
            </x-card>
        </div>
    </section>

    {{-- ================= ABOUT THE AUTHOR / PUBLISHER ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <x-badge>About SemanticFuture</x-badge>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">Why this book exists</h2>
            <p class="mt-6 text-base leading-relaxed text-slate-400">
                Much of what gets written about Google's AI-driven search shift falls into one of two categories:
                either too technical for a working creator to act on, or too alarmist to be useful. SemanticFuture
                built this book to sit in between — grounded in how the technology actually works, translated into
                a practical framework, and organized so every chapter ends in something you can apply. It's written
                for creators first, not marketing teams optimizing a brand account.
            </p>
            <div class="mt-8">
                <a href="{{ route('about') }}" class="text-sm font-semibold text-accent-300 hover:text-accent-200">Read more about SemanticFuture &rarr;</a>
            </div>
        </div>
    </section>

    {{-- ================= PREVIEW ================= --}}
    <section id="preview" class="px-6 py-16 lg:px-8">
        <x-section-heading eyebrow="Preview" title="See a sample before you buy" />
        <div class="mx-auto mt-10 max-w-2xl text-center">
            <x-card :hover="false" class="text-left">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">From Chapter 1 — Overview</p>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">
                    "For most of its history, Google Search has worked primarily as a matching system: a query came
                    in, and the system ranked pages and videos according to how well their text matched that query...
                    What has changed, gradually and cumulatively over the past several years, is that Google has
                    layered AI models — most visibly Gemini — on top of that foundation, giving the system an
                    additional capacity to understand meaning, context, and intent, not just matching text."
                </p>
            </x-card>
            <div class="mt-6">
                <x-button href="{{ route('preview') }}" variant="secondary">Read the full free chapter</x-button>
            </div>
        </div>
    </section>

    {{-- ================= FAQ ================= --}}
    <section class="px-6 py-16 lg:px-8">
        <x-section-heading eyebrow="FAQ" title="Questions creators ask before buying" />

        <div class="mx-auto mt-12 max-w-3xl space-y-4">
            <x-accordion-item question="What format is the book, and how do I get it?">
                It's a 93-page PDF handbook and workbook. After checkout, payment is verified securely through
                PayPal, and your download unlocks immediately on the confirmation page — you'll also get an email
                with a secure download link.
            </x-accordion-item>
            <x-accordion-item question="Is this specific to YouTube, or does it cover Google Search too?">
                Both, deliberately. YouTube's recommendation system and Google's AI Overviews share underlying
                technology, and understanding the connection is what makes the guidance practical rather than
                abstract.
            </x-accordion-item>
            <x-accordion-item question="Do I need a large channel for this to be useful?">
                No. Several chapters — and the workbook exercises — focus specifically on why content-derived
                understanding tends to benefit newer and smaller channels, which historically depended more heavily
                on accumulated watch history.
            </x-accordion-item>
            <x-accordion-item question="Is this book saying traditional SEO doesn't matter anymore?">
                No — the opposite. Traditional SEO fundamentals remain a foundation throughout the book. Semantic
                Discovery is presented as an additional, complementary layer, not a replacement — there's a full
                comparison early in the book laying out exactly how they relate.
            </x-accordion-item>
            <x-accordion-item question="How many times can I download it?">
                Each purchase includes multiple downloads (shown on your My Downloads page), and you can always
                re-download from your account — no need to save the file somewhere else "just in case."
            </x-accordion-item>
            <x-accordion-item question="How do I pay, and is it secure?">
                Checkout is a one-time payment through PayPal — no subscription, no card details stored on our
                servers. Your download link is unique to your order and isn't publicly accessible.
            </x-accordion-item>
        </div>
    </section>

    {{-- ================= FINAL CTA ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <div class="glass glow-border mx-auto max-w-4xl rounded-3xl px-8 py-16 text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Understand the shift. Build the workflow.
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-base text-slate-400">
                Get <span class="text-slate-200">{{ $ebook->title }}</span> and walk into your next upload with a
                clear, practical plan — and a workbook to keep you on track.
            </p>
            <div class="mt-8">
                <x-button href="{{ route('checkout') }}" size="lg">Get the Book — ${{ number_format((float) $ebook->price, 2) }}</x-button>
            </div>
        </div>
    </section>

</x-layout>
