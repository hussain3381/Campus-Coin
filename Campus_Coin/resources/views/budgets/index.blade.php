@extends('layouts.student')

@section('title', 'Budgets')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h1 class="h2 fw-bold mb-1">Monthly budgets</h1>
        <p class="muted mb-0">Expense categories ke monthly limits set karein.</p>
    </div>

    <form method="GET" action="{{ route('budgets.index') }}" class="d-flex gap-2">
        <input type="month" name="month" class="form-control"
               value="{{ $selectedMonth }}" required>
        <button class="btn btn-outline-primary">View</button>
    </form>
</div>

<section class="panel mb-4">
    <h2 class="h5 fw-bold mb-3">Set a category budget</h2>

    <form method="POST" action="{{ route('budgets.store') }}" class="row g-3 align-items-end">
        @csrf

        <div class="col-md-4">
            <label class="form-label">Expense category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Choose category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Month</label>
            <input type="month" name="month" class="form-control"
                   value="{{ old('month', $selectedMonth) }}" required>
        </div>

        <div class="col-md-3">
            <label class="form-label">Budget limit (PKR)</label>
            <input type="number" name="budget_limit" class="form-control"
                   min="0.01" step="0.01" value="{{ old('budget_limit') }}" required>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Save budget</button>
        </div>
    </form>
</section>

<section class="panel">
    <h2 class="h5 fw-bold mb-3">Budgets for {{ \Illuminate\Support\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') }}</h2>

    @forelse ($budgets as $budget)
        @php
            $percent = (float) $budget->percent;
            $width = min($percent, 100);
            $status = $percent >= 100 ? 'Exceeded' : ($percent >= 75 ? 'Near limit' : 'On track');
            $barColor = $percent >= 100 ? 'bg-danger' : ($percent >= 75 ? 'bg-warning' : 'bg-primary');
        @endphp

        <div class="border rounded-3 p-3 mb-3">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div>
                    <strong>{{ $budget->category->name }}</strong>
                    <span class="badge text-bg-light">{{ $status }}</span>
                    <div class="small muted mt-1">
                        Spent PKR {{ number_format($budget->spent, 2) }}
                        of PKR {{ number_format($budget->budget_limit, 2) }}
                        · {{ number_format($percent, 0) }}%
                    </div>
                </div>

                <div class="d-flex gap-2 align-items-start">
                    <form method="POST" action="{{ route('budgets.update', $budget) }}"
                          class="d-flex gap-2">
                        @csrf
                        @method('PUT')
                        <input type="number" name="budget_limit" class="form-control"
                               style="max-width:150px" min="0.01" step="0.01"
                               value="{{ $budget->budget_limit }}" required>
                        <button class="btn btn-sm btn-outline-primary">Update</button>
                    </form>

                    <form method="POST" action="{{ route('budgets.destroy', $budget) }}"
                          onsubmit="return confirm('Remove this budget?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>

            <div class="progress mt-3" role="progressbar"
                 aria-valuenow="{{ $width }}" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar {{ $barColor }}"
                     style="width: {{ $width }}%"></div>
            </div>
        </div>
    @empty
        <p class="muted mb-0">Is month ka koi budget nahi. Upar form se pehla budget set karein.</p>
    @endforelse
</section>
@endsection