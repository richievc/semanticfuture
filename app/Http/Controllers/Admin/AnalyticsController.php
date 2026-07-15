<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StoreAnalytics;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __invoke(Request $request, StoreAnalytics $analytics)
    {
        return view('admin.analytics.index', [
            'totalPurchases' => $analytics->totalPurchases(),
            'totalRevenue' => $analytics->totalRevenue(),
            'totalDownloads' => $analytics->totalDownloads(),
            'uniqueCustomers' => $analytics->uniqueCustomers(),
            'purchasesThisMonth' => $analytics->purchasesThisMonth(),
            'revenueThisMonth' => $analytics->revenueThisMonth(),
            'byDay' => $analytics->purchasesAndRevenueByDay(30),
            'byWeek' => $analytics->purchasesAndRevenueByWeek(12),
            'byMonth' => $analytics->purchasesAndRevenueByMonth(12),
            'downloadsByDay' => $analytics->downloadsByDay(30),
            'mostDownloaded' => $analytics->mostDownloaded(5),
            'recentActivity' => $analytics->recentActivity(25),
        ]);
    }
}
