<x-layout title="Download" description="Download {{ $ebook->title }}.">

    <section class="px-6 py-24 lg:px-8">
        <div class="mx-auto flex max-w-3xl flex-col items-center gap-10 text-center lg:flex-row lg:items-center lg:text-left">
            <div class="shrink-0">
                <x-book-cover size="lg" />
            </div>

            <div class="flex-1">
                <x-badge>Your download</x-badge>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">You're all set.</h1>
                <p class="mt-4 text-base leading-relaxed text-slate-400">
                    Thanks for your order. <span class="text-slate-200">{{ $ebook->title }}</span> — PDF format,
                    2026 edition.
                </p>

                <p class="mt-2 text-xs text-slate-500">
                    Downloads used: {{ $access->download_count }} / {{ $access->download_limit }}
                </p>

                <div class="mt-8">
                    @if ($access->download_count < $access->download_limit)
                        <x-button href="{{ route('downloads.go', $access) }}" size="lg" class="w-full justify-center sm:w-auto">
                            Download PDF
                        </x-button>
                    @else
                        <x-button type="button" size="lg" class="w-full justify-center sm:w-auto" disabled>
                            Download limit reached
                        </x-button>
                        <p class="mt-3 text-xs text-slate-500">
                            You've used all {{ $access->download_limit }} downloads on this purchase.
                            <a href="{{ route('contact') }}" class="text-accent-300 hover:text-accent-200">Contact us</a>
                            if you need another.
                        </p>
                    @endif
                </div>

                <p class="mt-6 text-xs text-slate-500">
                    Questions or trouble with an order? <a href="{{ route('contact') }}" class="text-accent-300 hover:text-accent-200">Contact us</a>.
                </p>
            </div>
        </div>
    </section>

</x-layout>
