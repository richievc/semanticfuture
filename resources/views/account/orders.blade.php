<x-layout title="My Orders">
    <section class="mx-auto max-w-4xl px-6 py-12 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">My Orders</h1>
            <a href="{{ route('account.dashboard') }}" class="text-accent-300 hover:text-accent-200">← Back to Account</a>
        </div>

        <div class="glass glow-border rounded-lg p-6">
            @if ($orders->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-white/10">
                            <tr>
                                <th class="py-3 px-4 text-slate-300 font-semibold">Order #</th>
                                <th class="py-3 px-4 text-slate-300 font-semibold">Date</th>
                                <th class="py-3 px-4 text-slate-300 font-semibold">Total</th>
                                <th class="py-3 px-4 text-slate-300 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="py-3 px-4 text-slate-300">{{ $order->order_number }}</td>
                                    <td class="py-3 px-4 text-slate-300">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 text-accent-300">{{ $order->currency }} {{ number_format($order->total, 2) }}</td>
                                    <td class="py-3 px-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $order->status === 'paid' ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @else
                <p class="text-slate-400">You haven't placed any orders yet. <a href="{{ route('ebooks.index') }}" class="text-accent-300 hover:text-accent-200">Browse our e-books</a></p>
            @endif
        </div>
    </section>
</x-layout>
