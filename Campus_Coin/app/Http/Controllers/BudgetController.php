<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
        ]);

        $selectedMonth = $filters['month'] ?? now()->format('Y-m');
        $monthStart = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $monthDate = $monthStart->toDateString();
        $monthEnd = $monthStart->copy()->endOfMonth()->toDateString();
        $user = auth()->user();

        $categories = Category::query()
            ->where('type', 'expense')
            ->where(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $user->id);
            })
            ->orderBy('name')
            ->get();

        $budgets = $user->budgets()
            ->with('category')
            ->whereDate('month', $monthDate)
            ->get();

        foreach ($budgets as $budget) {
            $budget->spent = (float) $user->transactions()
                ->where('category_id', $budget->category_id)
                ->where('type', 'expense')
                ->whereBetween('transaction_date', [$monthDate, $monthEnd])
                ->sum('amount');

            $limit = (float) $budget->budget_limit;
            $budget->percent = $limit > 0
                ? ($budget->spent / $limit) * 100
                : 0;
        }

        return view('budgets.index', compact(
            'categories',
            'budgets',
            'selectedMonth'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'month' => ['required', 'date_format:Y-m'],
            'budget_limit' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
        ]);

        $categoryIsAvailable = Category::query()
            ->whereKey($data['category_id'])
            ->where('type', 'expense')
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            })
            ->exists();

        if (! $categoryIsAvailable) {
            throw ValidationException::withMessages([
                'category_id' => 'Please select a valid expense category.',
            ]);
        }

        $monthDate = Carbon::createFromFormat('Y-m', $data['month'])
            ->startOfMonth()
            ->toDateString();

        auth()->user()->budgets()->updateOrCreate(
            [
                'category_id' => $data['category_id'],
                'month' => $monthDate,
            ],
            [
                'budget_limit' => $data['budget_limit'],
            ]
            
        );
       $existingBudget = auth()->user()->budgets()
    ->where('category_id', $data['category_id'])
    ->where('month', $monthDate)
    ->first();

if ($existingBudget) {
    $existingBudget->update([
        'budget_limit' => $data['budget_limit'],
    ]);

    $message = 'Existing budget updated for this category and month.';
} else {
    auth()->user()->budgets()->create([
        'category_id' => $data['category_id'],
        'month' => $monthDate,
        'budget_limit' => $data['budget_limit'],
    ]);

    $message = 'New monthly budget created.';
}
       return redirect()
    ->route('budgets.index', ['month' => $data['month']])
    ->with('success', $message);
    }

    public function update(Request $request, Budget $budget)
    {
        $this->checkOwner($budget);

        $data = $request->validate([
            'budget_limit' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
        ]);

        $budget->update($data);

        return redirect()
            ->route('budgets.index', ['month' => $budget->month->format('Y-m')])
            ->with('success', 'Budget limit updated.');
    }

    public function destroy(Budget $budget)
    {
        $this->checkOwner($budget);
        $month = $budget->month->format('Y-m');
        $budget->delete();

        return redirect()
            ->route('budgets.index', ['month' => $month])
            ->with('success', 'Budget removed.');
    }

    private function checkOwner(Budget $budget): void
    {
        abort_unless((int) $budget->user_id === (int) auth()->id(), 404);
    }
}