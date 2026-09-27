@extends('layouts.student')

@section('title', $transaction->exists ? 'Edit transaction' : 'Add transaction')

@section('content')
<div class="mb-4">
    <a href="{{ route('transactions.index') }}" class="text-decoration-none">
        ← Transactions
    </a>
    <h1 class="h2 fw-bold mt-2 mb-1">
        {{ $transaction->exists ? 'Edit transaction' : 'Add transaction' }}
    </h1>
    <p class="muted mb-0">Income ya expense ki details fill karein.</p>
</div>

<section class="panel" style="max-width:850px">
    <form method="POST"
          action="{{ $transaction->exists
              ? route('transactions.update', $transaction)
              : route('transactions.store') }}">
        @csrf
        @if ($transaction->exists)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Transaction type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="expense" @selected(old('type', $transaction->type ?? 'expense') === 'expense')>
                        Expense
                    </option>
                    <option value="income" @selected(old('type', $transaction->type) === 'income')>
                        Income
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                data-type="{{ $category->type }}"
                                @selected(old('category_id', $transaction->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Amount (PKR)</label>
                <input name="amount" type="number" min="0.01" step="0.01"
                       class="form-control" value="{{ old('amount', $transaction->amount) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Date</label>
                <input name="transaction_date" type="date"
                       max="{{ now()->toDateString() }}" class="form-control"
                       value="{{ old('transaction_date', $transaction->transaction_date?->format('Y-m-d') ?? now()->toDateString()) }}"
                       required>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <input name="description" maxlength="180" class="form-control"
                       placeholder="Misal: Campus cafe lunch"
                       value="{{ old('description', $transaction->description) }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Notes (optional)</label>
                <textarea name="notes" rows="3" maxlength="2000"
                          class="form-control">{{ old('notes', $transaction->notes) }}</textarea>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="is_recurring" value="1"
                           id="is_recurring" class="form-check-input"
                           @checked(old('is_recurring', $transaction->is_recurring))>
                    <label class="form-check-label" for="is_recurring">
                        Mark as recurring monthly
                    </label>
                </div>
                <input type="hidden" name="recurring_frequency" value="monthly">
            </div>

            <div class="col-12 d-flex gap-2">
                <button class="btn btn-primary">
                    {{ $transaction->exists ? 'Save changes' : 'Save transaction' }}
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</section>

<script>
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category_id');

    function filterCategories() {
        const selected = categorySelect.value;

        [...categorySelect.options].forEach(option => {
            if (!option.dataset.type) return;

            option.hidden = option.dataset.type !== typeSelect.value;

            if (option.value === selected && option.hidden) {
                categorySelect.value = '';
            }
        });
    }

    typeSelect.addEventListener('change', filterCategories);
    filterCategories();
</script>
@endsection