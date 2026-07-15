@props(['name', 'role', 'quote', 'initials'])

<x-card class="flex h-full flex-col justify-between">
    <p class="text-sm leading-relaxed text-slate-300">&ldquo;{{ $quote }}&rdquo;</p>
    <div class="mt-6 flex items-center gap-3">
        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-accent-400 to-accent-700 text-sm font-semibold text-navy-950">
            {{ $initials }}
        </div>
        <div>
            <p class="text-sm font-semibold text-white">{{ $name }}</p>
            <p class="text-xs text-slate-500">{{ $role }}</p>
        </div>
    </div>
</x-card>
