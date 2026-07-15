@props(['hover' => true])

<div {{ $attributes->class('glass rounded-2xl p-6 ' . ($hover ? 'transition-all duration-200 hover:border-accent-400/30 hover:-translate-y-0.5' : '')) }}>
    {{ $slot }}
</div>
