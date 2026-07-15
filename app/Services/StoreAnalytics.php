<?php

namespace App\Services;

use App\Models\CustomerEbookAccess;
use App\Models\Order;
use App\Models\ProductEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Shared read-model for the admin dashboard + analytics screens. Grouping
 * by day/week/month is done in PHP (via Carbon) rather than raw SQL date
 * functions, since those differ between the in-memory SQLite test database
 * and MySQL used by the application — for a single-product store the row counts
 * involved are small enough that this costs nothing meaningful.
 */
class StoreAnalytics
{
    public function totalPurchases(): int
    {
        return Order::paid()->count();
    }

    public function totalRevenue(): float
    {
        return (float) Order::paid()->sum('total');
    }

    public function totalDownloads(): int
    {
        return (int) CustomerEbookAccess::sum('download_count');
    }

    public function uniqueCustomers(): int
    {
        return Order::paid()->whereNotNull('user_id')->distinct('user_id')->count('user_id');
    }

    public function purchasesThisMonth(): int
    {
        return Order::paid()
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();
    }

    public function revenueThisMonth(): float
    {
        return (float) Order::paid()
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total');
    }

    /**
     * @return Collection<int, array{label: string, purchases: int, revenue: float}>
     */
    public function purchasesAndRevenueByDay(int $days = 30): Collection
    {
        $orders = Order::paid()
            ->where('paid_at', '>=', now()->subDays($days - 1)->startOfDay())
            ->get(['paid_at', 'total']);

        $buckets = collect(range(0, $days - 1))->mapWithKeys(function ($i) use ($days) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');

            return [$date => ['label' => $date, 'purchases' => 0, 'revenue' => 0.0]];
        });

        foreach ($orders as $order) {
            $day = Carbon::parse($order->paid_at)->format('Y-m-d');
            if ($buckets->has($day)) {
                $buckets[$day]['purchases']++;
                $buckets[$day]['revenue'] += (float) $order->total;
            }
        }

        return $buckets->values();
    }

    /**
     * @return Collection<int, array{label: string, purchases: int, revenue: float}>
     */
    public function purchasesAndRevenueByWeek(int $weeks = 12): Collection
    {
        $orders = Order::paid()
            ->where('paid_at', '>=', now()->subWeeks($weeks)->startOfWeek())
            ->get(['paid_at', 'total']);

        $buckets = collect(range(0, $weeks - 1))->mapWithKeys(function ($i) use ($weeks) {
            $weekStart = now()->subWeeks($weeks - 1 - $i)->startOfWeek();
            $key = $weekStart->format('Y-\WW');

            return [$key => ['label' => $weekStart->format('M j'), 'purchases' => 0, 'revenue' => 0.0]];
        });

        foreach ($orders as $order) {
            $key = Carbon::parse($order->paid_at)->startOfWeek()->format('Y-\WW');
            if ($buckets->has($key)) {
                $buckets[$key]['purchases']++;
                $buckets[$key]['revenue'] += (float) $order->total;
            }
        }

        return $buckets->values();
    }

    /**
     * @return Collection<int, array{label: string, purchases: int, revenue: float}>
     */
    public function purchasesAndRevenueByMonth(int $months = 12): Collection
    {
        $orders = Order::paid()
            ->where('paid_at', '>=', now()->subMonths($months - 1)->startOfMonth())
            ->get(['paid_at', 'total']);

        $buckets = collect(range(0, $months - 1))->mapWithKeys(function ($i) use ($months) {
            $monthStart = now()->subMonths($months - 1 - $i)->startOfMonth();

            return [$monthStart->format('Y-m') => ['label' => $monthStart->format('M Y'), 'purchases' => 0, 'revenue' => 0.0]];
        });

        foreach ($orders as $order) {
            $key = Carbon::parse($order->paid_at)->format('Y-m');
            if ($buckets->has($key)) {
                $buckets[$key]['purchases']++;
                $buckets[$key]['revenue'] += (float) $order->total;
            }
        }

        return $buckets->values();
    }

    /**
     * @return Collection<int, array{label: string, downloads: int}>
     */
    public function downloadsByDay(int $days = 30): Collection
    {
        $events = ProductEvent::whereIn('event_type', [ProductEvent::DOWNLOAD_COMPLETED, ProductEvent::DOWNLOAD_REPEATED])
            ->where('created_at', '>=', now()->subDays($days - 1)->startOfDay())
            ->get(['created_at']);

        $buckets = collect(range(0, $days - 1))->mapWithKeys(function ($i) use ($days) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');

            return [$date => ['label' => $date, 'downloads' => 0]];
        });

        foreach ($events as $event) {
            $day = Carbon::parse($event->created_at)->format('Y-m-d');
            if ($buckets->has($day)) {
                $buckets[$day]['downloads']++;
            }
        }

        return $buckets->values();
    }

    /**
     * @return Collection<int, array{title: string, downloads: int}>
     */
    public function mostDownloaded(int $limit = 5): Collection
    {
        return CustomerEbookAccess::query()
            ->selectRaw('ebook_id, SUM(download_count) as downloads')
            ->groupBy('ebook_id')
            ->orderByDesc('downloads')
            ->with('ebook:id,title')
            ->take($limit)
            ->get()
            ->map(fn ($row) => [
                'title' => $row->ebook?->title ?? 'Unknown',
                'downloads' => (int) $row->downloads,
            ]);
    }

    /**
     * @return Collection<int, Order>
     */
    public function recentActivity(int $limit = 25): Collection
    {
        return Order::with(['user:id,name,email', 'items.ebook:id,title', 'items.access'])
            ->latest()
            ->take($limit)
            ->get();
    }
}
