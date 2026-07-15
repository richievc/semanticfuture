@props(['size' => 'md'])

@php
    $sizes = [
        'xs' => 'w-14 aspect-[3/4]',
        'sm' => 'w-40 aspect-[3/4]',
        'md' => 'w-56 aspect-[3/4]',
        'lg' => 'w-72 aspect-[3/4]',
    ];
@endphp

@if ($size === 'xs')
    {{-- Compact thumbnail for tight list rows (My Downloads, checkout summary) —
         there isn't enough room at this width for the full title text, so this
         shows a simplified monogram badge instead of overflowing/wrapping. --}}
    <div {{ $attributes->class('relative ' . $sizes['xs'] . ' shrink-0 rounded-lg glow-border overflow-hidden bg-gradient-to-br from-navy-700 via-navy-800 to-navy-950 flex items-center justify-center') }}>
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-accent-500/10"></div>
        <span class="relative flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-br from-accent-400 to-accent-700 text-navy-950 text-xs font-bold">S</span>
    </div>
@else
    <div {{ $attributes->class('relative ' . ($sizes[$size] ?? $sizes['md']) . ' shrink-0 rounded-xl glow-border overflow-hidden bg-gradient-to-br from-navy-700 via-navy-800 to-navy-950 p-5 flex flex-col justify-between') }}>
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-accent-500/10"></div>

        <div class="relative">
            <p class="text-[10px] font-semibold uppercase tracking-widest text-accent-300">SemanticFuture</p>
        </div>

        <div class="relative">
            <p class="text-lg font-bold leading-tight text-white">From SEO to<br>Semantic Discovery</p>
            <p class="mt-2 text-xs italic text-accent-200">The Changing Horizon</p>
        </div>

        <div class="relative flex items-center justify-between text-[10px] text-slate-400">
            <span>2026 Edition</span>
            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-gradient-to-br from-accent-400 to-accent-700 text-navy-950 font-bold">S</span>
        </div>
    </div>
@endif
