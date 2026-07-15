@props(['value', 'suffix' => '', 'label'])

<div class="text-center">
    <div class="flex items-baseline justify-center gap-0.5 text-4xl font-bold text-white sm:text-5xl">
        <span data-counter data-counter-target="{{ $value }}">0</span><span>{{ $suffix }}</span>
    </div>
    <p class="mt-2 text-sm text-slate-400">{{ $label }}</p>
</div>
