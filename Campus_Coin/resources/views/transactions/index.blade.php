@extends('layouts.student')

@section('title', 'Transactions')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h1 class="h2 fw-bold mb-1">Transactions</h1>
        <p class="muted mb-0">Apni income aur expenses yahan manage karein.</p>
    </div>

    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
        + Add transaction
    </a>
</div>

<section class="panel">
    @if ($transactions->isEmpty())
        <div class="text-center py-5">
            <h2 class="h5 fw-bold">Abhi koi transaction nahi</h2>
            <p class="muted">Pehli income ya expense record karke shuru karein.</p>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                Add first transaction
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th class="text-end">Amount</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ ucfirst($transaction->type) }}</td>
                            <td class="text-end">
                                PKR {{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="text-end text-nowrap">
                                <a class="btn btn-sm btn-outline-secondary"
                                   href="{{ route('transactions.edit', $transaction) }}">Edit</a>

                                <form class="d-inline" method="POST"
                                      action="{{ route('transactions.destroy', $transaction) }}"
                                      onsubmit="return confirm('Is transaction ko delete karna hai?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $transactions->links() }}
    @endif
</section>
@endsection