@props(['question'])

<div class="accordion-item glass overflow-hidden rounded-xl" data-accordion-item>
    <button
        type="button"
        class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left text-sm font-semibold text-white"
        data-accordion-trigger
        aria-expanded="false"
    >
        <span>{{ $question }}</span>
        <svg data-accordion-icon class="h-5 w-5 shrink-0 text-accent-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>
    <div data-accordion-panel class="grid grid-rows-[0fr] transition-all duration-200 ease-in-out">
        <div class="overflow-hidden">
            <p class="px-5 pb-4 text-sm leading-relaxed text-slate-400">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
