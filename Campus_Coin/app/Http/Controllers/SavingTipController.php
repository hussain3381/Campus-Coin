<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\SavingTip;
use Illuminate\Support\Facades\DB;

class SavingTipController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $monthStart = now()->startOfMonth()->toDateString();
        $monthEnd = now()->endOfMonth()->toDateString();

        $spending = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$monthStart, $monthEnd])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $historyStart = now()->copy()->subMonths(3)->startOfMonth()->toDateString();
        $historyEnd = now()->copy()->subMonth()->endOfMonth()->toDateString();

        $historyTotals = $user->transactions()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$historyStart, $historyEnd])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $budgets = $user->budgets()
            ->whereDate('month', $monthStart)
            ->get()
            ->keyBy('category_id');

        $preferences = DB::table('user_saving_tips')
            ->where('user_id', $user->id)
            ->get()
            ->keyBy('tip_id');

        $preparedTips = [];

        $activeTips = SavingTip::query()
            ->with('category')
            ->where('is_active', true)
            ->get();

        foreach ($activeTips as $tip) {
            $preference = $preferences->get($tip->id);
            $isPinned = (bool) ($preference->is_pinned ?? false);
            $isDismissed = (bool) ($preference->is_dismissed ?? false);

            if ($isDismissed) {
                continue;
            }

            $spent = $tip->category_id
                ? (float) ($spending[$tip->category_id] ?? 0)
                : 0;

            // Category-specific tip tabhi dikhayein jab student ne us category mein expense kiya ho,
            // ya usne pehle se tip pin ki ho.
            if ($tip->category_id && $spent <= 0 && ! $isPinned) {
                continue;
            }

            $averageMonthly = $tip->category_id
                ? ((float) ($historyTotals[$tip->category_id] ?? 0) / 3)
                : 0;

            $budget = $tip->category_id
                ? $budgets->get($tip->category_id)
                : null;

            $budgetLimit = $budget ? (float) $budget->budget_limit : null;
            $budgetPercent = $budgetLimit > 0
                ? ($spent / $budgetLimit) * 100
                : null;

            if ($budgetPercent !== null && $budgetPercent >= 100) {
                $context = 'Your category budget has been exceeded.';
            } elseif ($budgetPercent !== null && $budgetPercent >= 75) {
                $context = 'Your category budget is near its limit.';
            } elseif ($averageMonthly > 0 && $spent > $averageMonthly) {
                $context = 'Your current spending is above your previous 3-month monthly average.';
            } elseif ($tip->category_id) {
                $context = 'Based on your spending in this category this month.';
            } else {
                $context = 'General student budgeting tip.';
            }

            $tip->is_pinned = $isPinned;
            $tip->current_spend = $spent;
            $tip->average_monthly_spend = $averageMonthly;
            $tip->budget_limit = $budgetLimit;
            $tip->budget_percent = $budgetPercent;
            $tip->context = $context;

            $tip->relevance_score = $spent;

            if ($budgetPercent !== null && $budgetPercent >= 75) {
                $tip->relevance_score += $spent;
            }

            if ($averageMonthly > 0 && $spent > $averageMonthly) {
                $tip->relevance_score += $spent - $averageMonthly;
            }

            $preparedTips[] = $tip;
        }

        $tips = collect($preparedTips)
            ->sortByDesc(fn ($tip) =>
                ($tip->is_pinned ? 1000000000 : 0) + $tip->relevance_score
            )
            ->take(5)
            ->values();

        return view('saving-tips.index', compact('tips'));
    }

    public function togglePin(SavingTip $tip)
    {
        abort_unless($tip->is_active, 404);

        $userId = auth()->id();
        $existing = DB::table('user_saving_tips')
            ->where('user_id', $userId)
            ->where('tip_id', $tip->id)
            ->first();

        $pin = ! (bool) ($existing->is_pinned ?? false);

        DB::table('user_saving_tips')->updateOrInsert(
            ['user_id' => $userId, 'tip_id' => $tip->id],
            [
                'is_pinned' => $pin,
                'is_dismissed' => false,
                'created_at' => $existing->created_at ?? now(),
                'updated_at' => now(),
            ]
        );

        return back()->with('success', $pin ? 'Tip pinned.' : 'Tip unpinned.');
    }

    public function dismiss(SavingTip $tip)
    {
        abort_unless($tip->is_active, 404);

        $userId = auth()->id();
        $existing = DB::table('user_saving_tips')
            ->where('user_id', $userId)
            ->where('tip_id', $tip->id)
            ->first();

        DB::table('user_saving_tips')->updateOrInsert(
            ['user_id' => $userId, 'tip_id' => $tip->id],
            [
                'is_pinned' => false,
                'is_dismissed' => true,
                'created_at' => $existing->created_at ?? now(),
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Tip dismissed.');
    }
}