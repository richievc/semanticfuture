<x-layout title="Read a Free Chapter" description="Read Chapter 1 of From SEO to Semantic Discovery for free.">

    <section class="px-6 pt-20 pb-16 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <x-badge>Free preview</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Chapter 1: The Changing Horizon</h1>
            <p class="mt-4 text-lg text-slate-400">Search Is Evolving — the opening chapter of <span class="text-slate-200">From SEO to Semantic Discovery</span>, free to read in full.</p>
        </div>
    </section>

    <section class="px-6 pb-20 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <x-card :hover="false" class="text-left">
                <div class="space-y-6 text-base leading-relaxed text-slate-300">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Overview</p>
                        <p class="mt-3">
                            For most of its history, Google Search has worked primarily as a matching system: a
                            query came in, and the system ranked pages and videos according to how well their text
                            matched that query, combined with signals like link authority and user engagement. That
                            system still operates today. What has changed, gradually and cumulatively over the past
                            several years, is that Google has layered AI models — most visibly Gemini — on top of
                            that foundation, giving the system an additional capacity to understand meaning,
                            context, and intent, not just matching text.
                        </p>
                        <p class="mt-3">
                            YouTube's recommendation system has followed a parallel path. Alongside the metadata a
                            creator provides — titles, descriptions, tags — YouTube's systems now also build a
                            richer, AI-derived understanding of a video's actual content: what it shows, what it
                            says, and how it's structured. This is described in Google's own research publications
                            as part of a broader move toward what is sometimes called <em>semantic</em>
                            recommendation and retrieval, an area of active, ongoing development rather than a
                            single, finished feature.
                        </p>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">What's documented</p>
                        <p class="mt-2 text-sm text-slate-400">Google and YouTube researchers have published technical work describing methods for representing content using compact, AI-derived codes — sometimes referred to as semantic IDs — as a complement to traditional identifiers and metadata in recommendation systems.</p>
                        <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-accent-300">What this appears to mean</p>
                        <p class="mt-2 text-sm text-slate-400">Recommendation and search systems are increasingly able to draw on the substance of a video, not only its accompanying text, when deciding who to show it to and when to cite it.</p>
                        <p class="mt-4 text-xs font-semibold uppercase tracking-wider text-accent-300">Creator guidance</p>
                        <p class="mt-2 text-sm text-slate-400">Treat metadata and content as partners, not substitutes. Well-written titles and descriptions remain valuable; they now work alongside a growing capacity for the system to understand your video's actual substance.</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Why it matters</p>
                        <p class="mt-3">
                            Creators build habits around whatever the discovery system currently rewards, and those
                            habits tend to lag the system itself by months or years. Understanding the direction of
                            this evolution — toward richer, more content-aware understanding — lets you build
                            production habits that stay useful as the systems continue to mature, rather than
                            habits narrowly tuned to how things worked several years ago.
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">Key takeaways</p>
                        <ul class="mt-3 space-y-2 text-sm text-slate-400">
                            <li>· Google Search and YouTube are incorporating AI-driven semantic understanding as an additional layer, not a wholesale replacement.</li>
                            <li>· Traditional SEO fundamentals remain valuable and work alongside this new layer.</li>
                            <li>· The most durable creator response is content that's clear and well-structured for both viewers and AI systems.</li>
                        </ul>
                    </div>
                </div>
            </x-card>

            <div class="mt-10 text-center">
                <p class="text-sm text-slate-400">13 more chapters cover Semantic IDs, transcripts, chapter structure, and a full 30-day roadmap.</p>
                <div class="mt-6">
                    <x-button href="{{ route('pricing') }}" size="lg">See Pricing & Get the Full Book</x-button>
                </div>
            </div>
        </div>
    </section>

</x-layout>
