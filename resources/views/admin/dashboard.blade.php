<x-admin-layout title="Dashboard" active="dashboard">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPurchases }}</h3>
                    <p>Total Purchases</p>
                </div>
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>${{ number_format($totalRevenue, 2) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalDownloads }}</h3>
                    <p>Total Downloads</p>
                </div>
                <div class="icon"><i class="fas fa-download"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $uniqueCustomers }}</h3>
                    <p>Unique Customers</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Welcome to the SemanticFuture admin dashboard</h3>
        </div>
        <div class="card-body">
            <p>Use <strong>Digital Products</strong> to manage the e-book (file, cover, price, publish status) and see who's bought it. Use <strong>Analytics</strong> for a full breakdown of purchases, revenue, and downloads over time.</p>
            <a href="{{ route('admin.analytics') }}" class="btn btn-primary">Open full analytics</a>
            <a href="{{ route('admin.ebooks.index') }}" class="btn btn-default">Manage digital products</a>
        </div>
    </div>
</x-admin-layout>
