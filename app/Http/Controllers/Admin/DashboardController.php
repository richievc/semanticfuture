<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StoreAnalytics;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, StoreAnalytics $analytics)
    {
        return view('admin.dashboard', [
            'totalPurchases' => $analytics->totalPurchases(),
            'totalRevenue' => $analytics->totalRevenue(),
            'totalDownloads' => $analytics->totalDownloads(),
            'uniqueCustomers' => $analytics->uniqueCustomers(),
        ]);
    }
}
