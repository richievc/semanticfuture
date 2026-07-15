<x-layout title="Thank You" description="Your download is ready.">

    <section class="px-6 py-24 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-accent-500/10 text-accent-300">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
            </div>

            <h1 class="mt-6 text-3xl font-bold tracking-tight text-white sm:text-4xl">You're all set.</h1>
            <p class="mt-4 text-base text-slate-400">
                Thanks for picking up <span class="text-slate-200">The Semantic Future</span>. Your PDF is ready below —
                a copy of the download link has also been sent to the email you used at checkout.
            </p>

            <div class="mt-10">
                <x-button href="{{ asset('downloads/the-semantic-future.pdf') }}" size="lg">Download the eBook (PDF)</x-button>
            </div>

            <p class="mt-6 text-xs text-slate-500">
                Trouble downloading? <a href="{{ route('contact') }}" class="text-accent-300 hover:text-accent-200">Contact us</a> and we'll sort it out.
            </p>
        </div>
    </section>

</x-layout>
