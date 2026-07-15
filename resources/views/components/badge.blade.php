@props(['variant' => 'accent'])

@php
    $variants = [
        'accent' => 'bg-accent-500/10 text-accent-300 ring-1 ring-inset ring-accent-400/30',
        'neutral' => 'bg-white/5 text-slate-300 ring-1 ring-inset ring-white/10',
    ];
@endphp

<span {{ $attributes->class('inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium uppercase tracking-wider ' . ($variants[$variant] ?? $variants['accent'])) }}>
    {{ $slot }}
</span>
