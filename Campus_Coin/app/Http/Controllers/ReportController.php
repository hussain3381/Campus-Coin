<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'type' => ['nullable', 'in:income,expense'],
            'period' => ['nullable', 'in:15d,1m,3m,6m'],
        ]);

        $from = $filters['from'] ?? now()->startOfMonth()->toDateString();
        $to = $filters['to'] ?? now()->endOfMonth()->toDateString();
        $period = $filters['period'] ?? '6m';

        if (Carbon::parse($from)->gt(Carbon::parse($to))) {
            throw ValidationException::withMessages([
                'to' => 'End date must be on or after the start date.',
            ]);
        }

        $user = auth()->user();

        $categories = Category::query()
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $user->id);
            })
            ->orderBy('name')
            ->get();

        // Date/category/type filters se summary calculate hoti hai.
        $query = $user->transactions()
            ->with('category')
            ->whereBetween('transaction_date', [$from, $to]);

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        $records = $query->get();

        $income = (float) $records->where('type', 'income')->sum('amount');
        $expenses = (float) $records->where('type', 'expense')->sum('amount');
        $net = $income - $expenses;

        $days = max(
            1,
            Carbon::parse($from)->diffInDays(Carbon::parse($to)) + 1
        );

        $dailyAverage = $expenses / $days;
        $savingsRate = $income > 0 ? ($net / $income) * 100 : 0;

        $largestExpense = $records
            ->where('type', 'expense')
            ->sortByDesc('amount')
            ->first();

        $categoryBreakdown = $records
            ->where('type', 'expense')
            ->groupBy(fn ($transaction) => $transaction->category->name)
            ->map(fn ($group) => (float) $group->sum('amount'))
            ->sortDesc();

        $daily = $records
            ->groupBy(fn ($transaction) => $transaction->transaction_date->format('Y-m-d'))
            ->map(function ($group, $date) {
                return [
                    'label' => Carbon::parse($date)->format('d M'),
                    'income' => (float) $group->where('type', 'income')->sum('amount'),
                    'expenses' => (float) $group->where('type', 'expense')->sum('amount'),
                ];
            })
            ->sortKeys();

        $weekly = $records
            ->groupBy(fn ($transaction) => $transaction->transaction_date
                ->copy()->startOfWeek()->toDateString())
            ->sortKeys()
            ->map(function ($group, $weekStart) {
                return [
                    'label' => 'Week of '.Carbon::parse($weekStart)->format('d M'),
                    'income' => (float) $group->where('type', 'income')->sum('amount'),
                    'expenses' => (float) $group->where('type', 'expense')->sum('amount'),
                ];
            });

        // Chart ke liye selected period ka real transaction data.
        $isDailyChart = in_array($period, ['15d', '1m'], true);

        if ($isDailyChart) {
            $windowDays = $period === '15d' ? 15 : 30;
            $chartStart = now()->copy()->subDays($windowDays - 1)->startOfDay();
        } else {
            $windowMonths = $period === '3m' ? 3 : 6;
            $chartStart = now()->copy()
                ->subMonths($windowMonths - 1)
                ->startOfMonth();
        }

        $chartEnd = now()->endOfDay();

        $trendQuery = $user->transactions()
            ->whereBetween('transaction_date', [
                $chartStart->toDateString(),
                $chartEnd->toDateString(),
            ]);

        if (!empty($filters['category_id'])) {
            $trendQuery->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['type'])) {
            $trendQuery->where('type', $filters['type']);
        }

        $trendRecords = $trendQuery->get();
        $trend = collect();

        if ($isDailyChart) {
            $windowDays = $period === '15d' ? 15 : 30;

            for ($i = $windowDays - 1; $i >= 0; $i--) {
                $date = now()->copy()->subDays($i);
                $key = $date->format('Y-m-d');

                $dayRecords = $trendRecords->filter(
                    fn ($transaction) =>
                        $transaction->transaction_date->format('Y-m-d') === $key
                );

                $trend->push([
                    'label' => $date->format('d M'),
                    'income' => (float) $dayRecords->where('type', 'income')->sum('amount'),
                    'expenses' => (float) $dayRecords->where('type', 'expense')->sum('amount'),
                ]);
            }
        } else {
            $windowMonths = $period === '3m' ? 3 : 6;

            for ($i = $windowMonths - 1; $i >= 0; $i--) {
                $month = now()->copy()->subMonths($i)->startOfMonth();
                $key = $month->format('Y-m');

                $monthRecords = $trendRecords->filter(
                    fn ($transaction) =>
                        $transaction->transaction_date->format('Y-m') === $key
                );

                $trend->push([
                    'label' => $month->format('M Y'),
                    'income' => (float) $monthRecords->where('type', 'income')->sum('amount'),
                    'expenses' => (float) $monthRecords->where('type', 'expense')->sum('amount'),
                ]);
            }
        }

        $maxTrend = max(
            1,
            (float) $trend->flatMap(
                fn ($point) => [$point['income'], $point['expenses']]
            )->max()
        );

        return view('reports.index', compact(
            'categories',
            'filters',
            'from',
            'to',
            'period',
            'income',
            'expenses',
            'net',
            'dailyAverage',
            'savingsRate',
            'largestExpense',
            'categoryBreakdown',
            'daily',
            'weekly',
            'trend',
            'maxTrend'
        ));
    }
}