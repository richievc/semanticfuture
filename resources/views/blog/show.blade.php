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

        <div class="mt-12 text-base leading-8 text-slate-300
            [&_h2]:mb-4 [&_h2]:mt-12 [&_h2]:text-3xl [&_h2]:font-bold [&_h2]:tracking-tight [&_h2]:text-white
            [&_h3]:mb-3 [&_h3]:mt-8 [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-white
            [&_p]:my-5
            [&_ul]:my-6 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-6
            [&_ol]:my-6 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-6
            [&_strong]:font-semibold [&_strong]:text-white
            [&_blockquote]:my-8 [&_blockquote]:border-l-4 [&_blockquote]:border-accent-400 [&_blockquote]:pl-6 [&_blockquote]:text-xl [&_blockquote]:italic [&_blockquote]:text-slate-200
            [&_hr]:my-10 [&_hr]:border-white/10
            [&_a]:text-accent-300 [&_a]:underline [&_a]:decoration-accent-300/40 [&_a]:underline-offset-4 hover:[&_a]:text-accent-200">
            {!! $post->bodyHtml() !!}
        </div>
    </article>
</x-layout>
