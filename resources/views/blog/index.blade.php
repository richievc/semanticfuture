<x-layout title="Blog" description="Practical articles about AI discovery, semantic search, and creator strategy.">
    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-300">SemanticFuture Blog</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">Ideas for the next era of discovery</h1>
            <p class="mt-5 text-lg leading-8 text-slate-400">Practical notes on AI search, semantic discovery, and building content that remains useful.</p>
        </div>

        <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article class="group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] transition hover:-translate-y-1 hover:border-accent-400/30">
                    @if ($post->imageUrl())
                        <a href="{{ route('blog.show', $post) }}" class="block aspect-[16/9] overflow-hidden bg-navy-900">
                            <img src="{{ $post->imageUrl() }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        </a>
                    @endif
                    <div class="p-7">
                        <p class="text-xs font-semibold uppercase tracking-wider text-accent-300">
                            {{ $post->published_at->format('F j, Y') }}
                            @if ($post->author) · {{ $post->author->name }} @endif
                        </p>
                        <h2 class="mt-3 text-xl font-semibold text-white">
                            <a href="{{ route('blog.show', $post) }}" class="hover:text-accent-300">{{ $post->title }}</a>
                        </h2>
                        @if ($post->excerpt)
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-400">{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post) }}" class="mt-5 inline-flex text-sm font-semibold text-accent-300 hover:text-accent-200">Read article →</a>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-white/10 bg-white/[0.03] p-12 text-center text-slate-400">
                    The first article is being prepared. Check back soon.
                </div>
            @endforelse
        </div>

        @if ($posts->hasPages())
            <div class="mt-12">{{ $posts->links() }}</div>
        @endif
    </section>
</x-layout>
