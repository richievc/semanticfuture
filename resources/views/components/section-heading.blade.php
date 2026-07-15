@props(['eyebrow' => null, 'align' => 'center', 'title' => '', 'description' => null])

<div {{ $attributes->class('mx-auto max-w-2xl ' . ($align === 'center' ? 'text-center' : 'text-left')) }}>
    @if ($eyebrow)
        <x-badge>{{ $eyebrow }}</x-badge>
    @endif

    <h2 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
        {{ $title }}
    </h2>

    @if ($description)
        <p class="mt-4 text-base leading-relaxed text-slate-400">
            {{ $description }}
        </p>
    @endif
</div>
