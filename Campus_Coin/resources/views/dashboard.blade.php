@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <p class="muted mb-1">{{ now()->format('d F Y') }}</p>
    <h1 class="h2 fw-bold mb-1">Welcome back, {{ auth()->user()->name }}</h1>
    <p class="muted mb-0">Your summary for {{ now()->format('F Y') }}.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card p-4">
            <div class="muted">Income this month</div>
            <h2 class="h3 text-success mt-2 mb-0">PKR {{ number_format($income, 2) }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card p-4">
            <div class="muted">Expenses this month</div>
            <h2 class="h3 text-danger mt-2 mb-0">PKR {{ number_format($expenses, 2) }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card p-4">
            <div class="muted">Balance this month</div>
            <h2 class="h3 mt-2 mb-0">PKR {{ number_format($balance, 2) }}</h2>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <section class="panel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 fw-bold mb-0">Recent transactions</h2>
                <a href="{{ route('transactions.index') }}">View all</a>
            </div>

            @if ($recent->isEmpty())
                <p class="muted mb-0">Abhi koi transaction nahi. Pehli transaction add karein.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->category->name }}</td>
                                    <td class="text-end">
                                        {{ $transaction->type === 'income' ? '+' : '−' }}
                                        PKR {{ number_format($transaction->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>

    <div class="col-lg-4">
        <section class="panel">
            <h2 class="h5 fw-bold">Top spending category</h2>

            @if ($topCategory)
                <p class="mb-1">{{ $topCategory->name }}</p>
                <strong>PKR {{ number_format($topCategoryAmount, 2) }}</strong>
            @else
                <p class="muted mb-0">Is mahine abhi koi expense record nahi hua.</p>
            @endif
        </section>
    </div>
</div>
@endsection