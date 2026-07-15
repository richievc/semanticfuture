<x-layout title="E-books" description="Browse SemanticFuture's creator handbooks.">

    <section class="px-6 pt-20 pb-24 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <x-badge>E-book Store</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Creator handbooks, done right.</h1>
            <p class="mt-4 text-lg text-slate-400">Practical, evidence-based guides for creators navigating AI-powered search and discovery.</p>
        </div>

        <div class="mx-auto mt-16 grid max-w-4xl gap-6 sm:grid-cols-2">
            @forelse ($ebooks as $ebook)
                <x-card class="flex flex-col">
                    <div class="flex justify-center">
                        <x-book-cover size="md" />
                    </div>

                    <h2 class="mt-6 text-lg font-semibold text-white">
                        <a href="{{ route('ebooks.show', $ebook) }}" class="hover:text-accent-300">{{ $ebook->title }}</a>
                    </h2>
                    <p class="mt-2 flex-1 text-sm text-slate-400">{{ $ebook->short_description }}</p>

                    <div class="mt-6 flex items-center justify-between">
                        <span class="text-lg font-semibold text-white">${{ number_format((float) $ebook->price, 0) }} {{ $ebook->currency }}</span>
                        <x-button href="{{ route('ebooks.show', $ebook) }}" size="sm">View details</x-button>
                    </div>
                </x-card>
            @empty
                <div class="col-span-full text-center text-slate-400">
                    No e-books are published yet — check back soon.
                </div>
            @endforelse
        </div>
    </section>

</x-layout>
