<x-layout title="Contact" description="Questions about From SEO to Semantic Discovery? Get in touch.">

    <section class="px-6 pt-20 pb-24 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <x-badge>Contact</x-badge>
            <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl">Questions before you buy?</h1>
            <p class="mt-4 text-lg text-slate-400">Send a message and we'll get back to you — usually within a day.</p>
        </div>

        <div class="mx-auto mt-14 max-w-xl">
            <x-card :hover="false">
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <x-form-field label="Name" name="name" />
                    <x-form-field label="Email" name="email" type="email" />
                    <x-form-field label="Message" name="message" type="textarea" />

                    <x-button type="submit" class="w-full justify-center">Send message</x-button>
                </form>
            </x-card>
        </div>
    </section>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.showToast(@json(session('success')), 'success');
            });
        </script>
    @endif

</x-layout>
