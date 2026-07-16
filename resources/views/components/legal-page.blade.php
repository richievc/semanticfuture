@props(['title', 'description', 'updated' => 'July 16, 2026'])

<x-layout :title="$title" :description="$description">
    <article class="mx-auto max-w-4xl px-6 py-20 lg:px-8">
        <header class="border-b border-white/10 pb-10">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-accent-300">Legal</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $title }}</h1>
            <p class="mt-4 text-sm text-slate-400">Last updated: {{ $updated }}</p>
        </header>

        <div class="mt-10 text-base leading-8 text-slate-300
            [&_h2]:mb-4 [&_h2]:mt-12 [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:tracking-tight [&_h2]:text-white
            [&_h3]:mb-3 [&_h3]:mt-8 [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:text-white
            [&_p]:my-5
            [&_ul]:my-5 [&_ul]:list-disc [&_ul]:space-y-2 [&_ul]:pl-6
            [&_ol]:my-5 [&_ol]:list-decimal [&_ol]:space-y-2 [&_ol]:pl-6
            [&_strong]:font-semibold [&_strong]:text-white
            [&_a]:text-accent-300 [&_a]:underline [&_a]:decoration-accent-300/40 [&_a]:underline-offset-4 hover:[&_a]:text-accent-200">
            {{ $slot }}
        </div>
    </article>
</x-layout>
