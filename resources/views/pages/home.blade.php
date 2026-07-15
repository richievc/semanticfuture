<x-layout title="Home" description="From SEO to Semantic Discovery: a creator's handbook on Gemini, AI Overviews, and Semantic IDs — written for YouTube creators preparing for the future of AI-powered search.">

    {{-- ================= HERO ================= --}}
    <section class="relative overflow-hidden px-6 pt-20 pb-24 lg:px-8 lg:pt-28 lg:pb-32">
        <div class="mx-auto max-w-4xl text-center">
            <x-badge>SemanticFuture Creator Handbook · 2026 Edition</x-badge>

            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-6xl">
                From SEO to
                <span class="text-gradient">Semantic Discovery.</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-slate-400">
                Google's search and recommendation systems are steadily adding AI-driven understanding —
                Gemini, AI Overviews, Semantic Discovery — alongside the SEO fundamentals that still matter.
                <span class="text-slate-200">This handbook helps YouTube creators understand that evolution
                and prepare for it, calmly and practically.</span>
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <x-button href="{{ route('pricing') }}" size="lg">See Pricing & Get the Book</x-button>
                <x-button href="{{ route('preview') }}" variant="secondary" size="lg">Read a Free Chapter</x-button>
            </div>

            <p class="mt-6 text-xs text-slate-500">One-time payment · PDF download · Secure checkout</p>
        </div>

        {{-- Stats strip --}}
        <div class="mx-auto mt-20 grid max-w-4xl grid-cols-2 gap-8 lg:grid-cols-4">
            <x-stat value="14" label="In-depth chapters" />
            <x-stat value="30" label="Day creator roadmap" />
            <x-stat value="3" label="Layers: fact, interpretation, guidance" />
            <x-stat value="2026" label="Current edition" />
        </div>
    </section>

    {{-- ================= FEATURE HIGHLIGHTS ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <x-section-heading
            eyebrow="What's evolving"
            title="Search is adding a semantic layer."
            description="Google Search and YouTube's recommendation systems are steadily incorporating AI-driven understanding of meaning and context, alongside the SEO fundamentals that continue to matter. Here's how this handbook breaks that down for creators."
        />

        <div class="mx-auto mt-14 grid max-w-6xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <x-card>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 20.25a48.25 48.25 0 01-8.135-.687c-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-white">Semantic IDs, explained plainly</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">What Semantic IDs are, how Gemini-family models derive them from your actual content, and how they work alongside — not instead of — your titles, tags, and descriptions.</p>
            </x-card>

            <x-card>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-white">Understanding AI Overviews</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">YouTube is frequently cited within Google's AI Overviews. Learn how transcripts, chapters, and structure support both traditional ranking and this additional citation layer.</p>
            </x-card>

            <x-card>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-white">A 30-day creator roadmap</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">A week-by-week plan to audit your current content, rebuild your templates, publish with the updated framework, and measure what actually changed.</p>
            </x-card>

            <x-card>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/10 text-accent-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-white">A workbook, not just a read</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">Every chapter ends in a Knowledge Check, Creator Worksheet, and Action Items — plus a Semantic Readiness Scorecard to track your channel over time.</p>
            </x-card>
        </div>
    </section>

    {{-- ================= BENEFITS ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-14 lg:grid-cols-2">
            <div>
                <x-badge variant="neutral">Why it matters</x-badge>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Understanding this shift is more useful than reacting to it.
                </h2>
                <p class="mt-4 text-base leading-relaxed text-slate-400">
                    Content-derived understanding doesn't depend on an existing audience or years of watch
                    history — it evaluates well-structured content on its own merits, which is a genuine
                    opportunity for smaller and newer channels. This handbook shows you how to build for it
                    deliberately, without discarding the SEO practices that continue to work.
                </p>

                <ul class="mt-8 space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Understand how Gemini, AI Overviews, and Semantic IDs fit together as one evolving ecosystem — not separate, disconnected updates.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Refine your titles, descriptions, chapters, and transcripts so they serve both viewers and AI systems.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span class="text-sm text-slate-300">Add citation-rate awareness to your existing metrics, without abandoning the ones you already trust.</span>
                    </li>
                </ul>

                <div class="mt-10">
                    <x-button href="{{ route('pricing') }}">See pricing</x-button>
                </div>
            </div>

            <x-card :hover="false" class="glow-border">
                <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Inside the book</p>
                <ol class="mt-4 space-y-3 text-sm text-slate-300">
                    <li class="flex items-center justify-between border-b border-white/5 pb-3"><span>01 · Semantic IDs: Foundations</span><span class="text-slate-500">Ch. 4</span></li>
                    <li class="flex items-center justify-between border-b border-white/5 pb-3"><span>02 · Viewer Satisfaction Signals</span><span class="text-slate-500">Ch. 6</span></li>
                    <li class="flex items-center justify-between border-b border-white/5 pb-3"><span>03 · Transcripts as a Semantic Foundation</span><span class="text-slate-500">Ch. 8</span></li>
                    <li class="flex items-center justify-between border-b border-white/5 pb-3"><span>04 · Structuring Content for Discovery</span><span class="text-slate-500">Ch. 9</span></li>
                    <li class="flex items-center justify-between"><span>05 · A 30-Day Creator Roadmap</span><span class="text-slate-500">Ch. 12</span></li>
                </ol>
                <a href="{{ route('features') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-accent-300 hover:text-accent-200">
                    See the full table of contents
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
            </x-card>
        </div>
    </section>

    {{-- ================= TESTIMONIALS ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <x-section-heading
            eyebrow="Early readers"
            title="Written for creators, not marketers"
            description="Feedback from the creator community during early review."
        />

        <div class="mx-auto mt-14 grid max-w-6xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <x-testimonial
                initials="JM"
                name="Jordan M."
                role="Tutorial channel, 42K subscribers"
                quote="I appreciated that it didn't tell me to throw out everything I knew about SEO. It explained what to add, not what to panic about."
            />
            <x-testimonial
                initials="RK"
                name="Riya K."
                role="Tech review creator"
                quote="The chapter-structure framework alone was worth it — I hadn't thought about timestamps as individual reference points before."
            />
            <x-testimonial
                initials="DT"
                name="Devon T."
                role="Home & DIY channel"
                quote="The 30-day roadmap is the part I actually used. Clear, sequenced, and easy to fit around a normal upload schedule."
            />
        </div>
    </section>

    {{-- ================= FAQ ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <x-section-heading eyebrow="FAQ" title="Questions creators ask before buying" />

        <div class="mx-auto mt-12 max-w-3xl space-y-4">
            <x-accordion-item question="Is this specific to YouTube, or does it cover Google Search too?">
                Both, deliberately. YouTube's recommendation system and Google's AI Overviews share underlying
                technology, and understanding the connection is what makes the guidance in this book practical
                rather than abstract.
            </x-accordion-item>
            <x-accordion-item question="What format is the book, and how do I get it?">
                It's a 93-page PDF handbook and workbook. After a quick, free account sign-up and secure checkout,
                you're taken straight to your download page — and a copy of the download link is emailed to you too.
            </x-accordion-item>
            <x-accordion-item question="Do I need a large channel for this to be useful?">
                No. Several chapters focus specifically on why content-derived understanding tends to benefit
                newer and smaller channels, which historically depended more heavily on accumulated watch history.
            </x-accordion-item>
            <x-accordion-item question="Is this book saying traditional SEO doesn't matter anymore?">
                No — the opposite. Traditional SEO fundamentals remain a foundation throughout the book. Semantic
                Discovery is presented as an additional, complementary layer, not a replacement.
            </x-accordion-item>
            <x-accordion-item question="Will this go out of date quickly?">
                Specific statistics will age the way any dated reference does. The book is written around durable
                principles — clarity, structure, honest alignment between metadata and content — designed to stay
                useful as the underlying systems continue to evolve.
            </x-accordion-item>
            <x-accordion-item question="How do I pay?">
                Checkout is a simple, one-time payment flow — no subscription. Payment processing details are shown
                at checkout.
            </x-accordion-item>
        </div>
    </section>

    {{-- ================= FINAL CTA ================= --}}
    <section class="px-6 py-20 lg:px-8">
        <div class="glass glow-border mx-auto max-w-4xl rounded-3xl px-8 py-16 text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Understand the shift. Prepare your workflow.
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-base text-slate-400">
                Get <span class="text-slate-200">From SEO to Semantic Discovery</span> and walk into your next
                upload with a clear, practical plan — not a reaction to hype.
            </p>
            <div class="mt-8">
                <x-button href="{{ route('pricing') }}" size="lg">Get the Book</x-button>
            </div>
        </div>
    </section>

</x-layout>
