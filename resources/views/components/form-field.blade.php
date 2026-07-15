@props(['label', 'name', 'type' => 'text', 'rows' => null])

<div>
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-slate-300">{{ $label }}</label>

    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows ?? 5 }}"
            {{ $attributes->class('w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-accent-400 focus:outline-none focus:ring-1 focus:ring-accent-400') }}
        >{{ old($name) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name) }}"
            {{ $attributes->class('w-full rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-accent-400 focus:outline-none focus:ring-1 focus:ring-accent-400') }}
        >
    @endif

    @error($name)
        <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p>
    @enderror
</div>
