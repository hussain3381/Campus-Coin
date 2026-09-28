<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Budget;


class TransactionController extends Controller
{

    public function dashboard(): View
{
    $user = auth()->user();

    $startOfMonth = now()->startOfMonth()->toDateString();
    $endOfMonth = now()->endOfMonth()->toDateString();

    $monthQuery = $user->transactions()
        ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth]);

    $income = (clone $monthQuery)
        ->where('type', 'income')
        ->sum('amount');

    $expenses = (clone $monthQuery)
        ->where('type', 'expense')
        ->sum('amount');

    $topSpending = (clone $monthQuery)
        ->where('type', 'expense')
        ->selectRaw('category_id, SUM(amount) as total')
        ->groupBy('category_id')
        ->orderByDesc('total')
        ->first();

    $topCategory = $topSpending
        ? Category::find($topSpending->category_id)
        : null;

    $topCategoryAmount = $topSpending->total ?? 0;

    $recent = $user->transactions()
        ->with('category')
        ->latest('transaction_date')
        ->latest('id')
        ->take(5)
        ->get();

    $budgets = $user->budgets()
    ->with('category')
    ->whereDate('month', $startOfMonth)
    ->get();

    foreach ($budgets as $budget) {
    $budget->spent = (float) $user->transactions()
        ->where('category_id', $budget->category_id)
        ->where('type', 'expense')
        ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
        ->sum('amount');

    $limit = (float) $budget->budget_limit;
    $budget->percent = $limit > 0
        ? ($budget->spent / $limit) * 100
        : 0;
    }

    $balance = $income - $expenses;

    return view('dashboard', compact(
        'income',
        'expenses',
        'balance',
        'topCategory',
        'topCategoryAmount',
        'budgets',
        'recent'
    ));
}
    public function index()
    {
        $transactions = auth()->user()
            ->transactions()
            ->with('category')
            ->latest('transaction_date')
            ->latest('id')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.form', [
            'transaction' => new Transaction(),
            'categories' => $this->availableCategories(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        // Relationship current logged-in student ko transaction ka owner banati hai.
        auth()->user()->transactions()->create($data);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction successfully added.');
    }

    public function edit(Transaction $transaction)
    {
        $this->checkOwner($transaction);

        return view('transactions.form', [
            'transaction' => $transaction,
            'categories' => $this->availableCategories(),
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->checkOwner($transaction);
        $transaction->update($this->validatedData($request));

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction successfully updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $this->checkOwner($transaction);
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction successfully deleted.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'type' => ['required', 'in:income,expense'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'transaction_date' => ['required', 'date', 'before_or_equal:today'],
            'description' => ['required', 'string', 'max:180'],
            'is_recurring' => ['nullable', 'boolean'],
            'recurring_frequency' => ['nullable', 'in:monthly'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $categoryIsAvailable = Category::query()
            ->whereKey($data['category_id'])
            ->where('type', $data['type'])
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            })
            ->exists();

        if (! $categoryIsAvailable) {
            throw ValidationException::withMessages([
                'category_id' => 'Please select a valid category for this transaction.',
            ]);
        }

        $data['is_recurring'] = $request->boolean('is_recurring');
        $data['recurring_frequency'] = $data['is_recurring']
            ? ($data['recurring_frequency'] ?? 'monthly')
            : null;

        return $data;
    }

    private function availableCategories()
    {
        return Category::query()
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();
    }

    private function checkOwner(Transaction $transaction): void
    {
        abort_unless(
            (int) $transaction->user_id === (int) auth()->id(),
            404
        );
    }
}