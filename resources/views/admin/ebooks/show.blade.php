<x-admin-layout :title="$ebook->title" active="ebooks">

    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $totalPurchases }}</h3><p>Purchases</p></div>
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner"><h3>${{ number_format($totalRevenue, 2) }}</h3><p>Revenue</p></div>
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner"><h3>{{ $totalDownloads }}</h3><p>Downloads</p></div>
                <div class="icon"><i class="fas fa-download"></i></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($ebook->cover_image)
                <img src="{{ asset('storage/'.$ebook->cover_image) }}" alt="Cover" style="max-height:160px;" class="mb-3">
            @endif
            <table class="table table-borderless" style="max-width:640px;">
                <tr><th style="width:180px;">Slug</th><td>{{ $ebook->slug }}</td></tr>
                <tr><th>Price</th><td>{{ $ebook->currency }} {{ number_format($ebook->price, 2) }}</td></tr>
                <tr><th>Status</th><td>{{ $ebook->is_published ? 'Published' : 'Draft' }}</td></tr>
                <tr><th>Max downloads / purchase</th><td>{{ $ebook->max_downloads }}</td></tr>
                <tr><th>File uploaded</th><td>{{ $ebook->file_path ? 'Yes (stored privately)' : 'No — buyers will see "not available" until this is added.' }}</td></tr>
                <tr><th>Short description</th><td>{{ $ebook->short_description }}</td></tr>
                <tr><th>Description</th><td style="white-space:pre-line;">{{ $ebook->description }}</td></tr>
            </table>
            <a href="{{ route('admin.ebooks.edit', $ebook) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.ebooks.index') }}" class="btn btn-default">Back to list</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3 class="card-title">Purchase History &amp; Customers</h3></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Order #</th>
                            <th>Amount</th>
                            <th>Purchased</th>
                            <th>Downloads Used</th>
                            <th>Last Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($orderItems as $item)
                        <tr>
                            <td>{{ $item->order->user?->name ?? '—' }}</td>
                            <td>{{ $item->order->user?->email ?? '—' }}</td>
                            <td class="font-monospace">{{ $item->order->order_number }}</td>
                            <td>{{ $item->order->currency }} {{ number_format((float) $item->line_total, 2) }}</td>
                            <td>{{ $item->order->paid_at?->format('M j, Y') ?? $item->created_at->format('M j, Y') }}</td>
                            <td>{{ $item->access?->download_count ?? 0 }} / {{ $item->access?->download_limit ?? $ebook->max_downloads }}</td>
                            <td>{{ $item->access?->last_downloaded_at?->format('M j, Y g:ia') ?? 'Never' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-muted">No purchases yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
