<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description ?? 'The Semantic Future — a creator\'s guide to Semantic IDs, AI Overviews, and discoverability in the age of answer engines.' }}">

        <title>{{ $title ?? 'SemanticFuture' }} — {{ config('app.name', 'SemanticFuture') }}</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-navy-950 text-slate-200 antialiased selection:bg-accent-500 selection:text-navy-950">

        {{-- Ambient background glow --}}
        <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-40 left-1/2 h-[36rem] w-[36rem] -translate-x-1/2 rounded-full bg-accent-600/20 blur-[120px]"></div>
            <div class="absolute top-1/3 -right-32 h-[28rem] w-[28rem] rounded-full bg-accent-500/10 blur-[100px]"></div>
        </div>

        @include('partials.nav')

        <main>
            {{ $slot }}
        </main>

        @include('partials.footer')

        {{-- Toast container --}}
        <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3"></div>
    </body>
</html>
