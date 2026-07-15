<x-layout title="My Downloads">
    <section class="mx-auto max-w-4xl px-6 py-12 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">My Downloads</h1>
            <a href="{{ route('account.dashboard') }}" class="text-accent-300 hover:text-accent-200">← Back to Account</a>
        </div>

        <div class="glass glow-border rounded-lg p-6">
            @if ($downloads->count())
                <div class="space-y-4">
                    @foreach ($downloads as $access)
                        <div class="p-4 border border-white/10 rounded-lg hover:bg-white/5 transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-4 flex-1">
                                    <x-book-cover size="xs" />
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-white">{{ $access->ebook->title }}</h3>
                                        <p class="text-sm text-slate-400 mt-1">Purchased: {{ optional($access->granted_at)->format('M d, Y') }}</p>
                                        <p class="text-sm text-slate-400">Downloads: {{ $access->download_count }} / {{ $access->download_limit }}</p>
                                        @if ($access->revoked_at)
                                            <p class="text-sm text-red-400 font-medium mt-2">⚠ Access revoked</p>
                                        @endif
                                    </div>
                                </div>
                                @if (!$access->revoked_at && $access->download_count < $access->download_limit)
                                    <a href="{{ route('downloads.go', $access) }}" class="shrink-0 px-4 py-2 bg-accent-500 hover:bg-accent-600 text-navy-950 rounded-lg font-medium text-sm">
                                        Download
                                    </a>
                                @else
                                    <button disabled class="shrink-0 px-4 py-2 bg-slate-700 text-slate-400 rounded-lg font-medium text-sm cursor-not-allowed">
                                        Download
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $downloads->links() }}
                </div>
            @else
                <p class="text-slate-400">You don't have any purchased e-books yet. <a href="{{ route('ebooks.index') }}" class="text-accent-300 hover:text-accent-200">Start shopping</a></p>
            @endif
        </div>
    </section>
</x-layout>
