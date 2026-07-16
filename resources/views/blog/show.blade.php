<x-layout :title="$post->title" :description="$post->meta_description ?: $post->excerpt">
    <article class="mx-auto max-w-4xl px-6 py-20 lg:px-8">
        <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-accent-300 hover:text-accent-200">← Back to the blog</a>

        <header class="mt-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-accent-300">
                {{ $post->published_at->format('F j, Y') }}
                @if ($post->author) · {{ $post->author->name }} @endif
            </p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="mt-6 text-xl leading-8 text-slate-400">{{ $post->excerpt }}</p>
            @endif
        </header>

        @if ($post->imageUrl())
            <img src="{{ $post->imageUrl() }}" alt="" class="mt-10 aspect-[16/9] w-full rounded-2xl border border-white/10 object-cover">
        @endif

        <div class="mt-12 text-base leading-8 text-slate-300 [&_a]:text-accent-300 [&_a]:underline">
            {!! nl2br(e($post->body)) !!}
        </div>
    </article>
</x-layout>
