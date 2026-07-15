<x-admin-layout title="Analytics" active="analytics">

    {{-- Summary cards --}}
    <div class="row">
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $totalPurchases }}</h3><p>Total Purchases</p></div>
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box bg-success">
                <div class="inner"><h3>${{ number_format($totalRevenue, 2) }}</h3><p>Total Revenue</p></div>
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner"><h3>{{ $totalDownloads }}</h3><p>Total Downloads</p></div>
                <div class="icon"><i class="fas fa-download"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box bg-danger">
                <div class="inner"><h3>{{ $uniqueCustomers }}</h3><p>Unique Customers</p></div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box" style="background-color:#6f42c1;color:#fff;">
                <div class="inner"><h3>{{ $purchasesThisMonth }}</h3><p>Purchases This Month</p></div>
                <div class="icon"><i class="fas fa-calendar-check"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-6">
            <div class="small-box" style="background-color:#17a2b8;color:#fff;">
                <div class="inner"><h3>${{ number_format($revenueThisMonth, 2) }}</h3><p>Revenue This Month</p></div>
                <div class="icon"><i class="fas fa-chart-line"></i></div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Purchases &amp; Revenue — Last 30 Days</h3></div>
                <div class="card-body"><canvas id="chartDaily" style="max-height:280px;"></canvas></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Downloads — Last 30 Days</h3></div>
                <div class="card-body"><canvas id="chartDownloads" style="max-height:280px;"></canvas></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Purchases &amp; Revenue — Weekly (12 weeks)</h3></div>
                <div class="card-body"><canvas id="chartWeekly" style="max-height:260px;"></canvas></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Purchases &amp; Revenue — Monthly (12 months)</h3></div>
                <div class="card-body"><canvas id="chartMonthly" style="max-height:260px;"></canvas></div>
            </div>
        </div>
    </div>

    {{-- Most downloaded --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Most Downloaded Products</h3></div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead><tr><th>Product</th><th>Downloads</th></tr></thead>
                <tbody>
                @forelse ($mostDownloaded as $row)
                    <tr><td>{{ $row['title'] }}</td><td>{{ $row['downloads'] }}</td></tr>
                @empty
                    <tr><td colspan="2" class="text-muted">No downloads yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent activity --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Recent Activity</h3></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Downloads</th>
                            <th>Last Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($recentActivity as $order)
                        @php $item = $order->items->first(); @endphp
                        <tr>
                            <td>{{ $order->user?->name ?? '—' }}</td>
                            <td>{{ $order->user?->email ?? '—' }}</td>
                            <td>{{ $item?->product_title_snapshot ?? $item?->ebook?->title ?? '—' }}</td>
                            <td>{{ $order->currency }} {{ number_format((float) $order->total, 2) }}</td>
                            <td>{{ $order->created_at->format('M j, Y') }}</td>
                            <td>
                                <span class="badge {{ match($order->status) {
                                    'paid' => 'badge-success',
                                    'pending' => 'badge-warning',
                                    'refunded' => 'badge-secondary',
                                    default => 'badge-danger',
                                } }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $item?->access?->download_count ?? 0 }}</td>
                            <td>{{ $item?->access?->last_downloaded_at?->format('M j, Y g:ia') ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-muted">No orders yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            const dailyData = @json($byDay);
            const weeklyData = @json($byWeek);
            const monthlyData = @json($byMonth);
            const downloadsData = @json($downloadsByDay);

            function moneyRevenueChart(canvasId, data, purchaseLabel) {
                new Chart(document.getElementById(canvasId), {
                    type: 'bar',
                    data: {
                        labels: data.map(d => d.label),
                        datasets: [
                            {
                                label: purchaseLabel,
                                data: data.map(d => d.purchases),
                                backgroundColor: 'rgba(60, 141, 188, 0.7)',
                                yAxisID: 'y',
                            },
                            {
                                label: 'Revenue ($)',
                                data: data.map(d => d.revenue),
                                type: 'line',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                backgroundColor: 'rgba(40, 167, 69, 0.15)',
                                yAxisID: 'y1',
                                tension: 0.3,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, position: 'left', title: { display: true, text: 'Purchases' } },
                            y1: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false }, title: { display: true, text: 'Revenue ($)' } },
                        },
                    },
                });
            }

            moneyRevenueChart('chartDaily', dailyData, 'Purchases');
            moneyRevenueChart('chartWeekly', weeklyData, 'Purchases');
            moneyRevenueChart('chartMonthly', monthlyData, 'Purchases');

            new Chart(document.getElementById('chartDownloads'), {
                type: 'line',
                data: {
                    labels: downloadsData.map(d => d.label),
                    datasets: [{
                        label: 'Downloads',
                        data: downloadsData.map(d => d.downloads),
                        borderColor: 'rgba(255, 193, 7, 1)',
                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                        tension: 0.3,
                        fill: true,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                },
            });
        </script>
    </x-slot:scripts>
</x-admin-layout>
