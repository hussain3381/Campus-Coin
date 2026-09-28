@extends('layouts.student')

@section('title', 'Saving tips')

@section('content')
<div class="mb-4">
    <div class="small text-primary fw-bold">STUDENT MONEY GUIDE</div>
    <h1 class="h2 fw-bold mb-1">Saving tips</h1>
    <p class="muted mb-0">
        Database tips are shown when they match your recorded spending.
        No AI-generated advice is used.
    </p>
</div>

@if ($tips->isEmpty())
    <section class="pa
    <div class="row g-3">
        @foreach ($tips as $tip)
            <div class="col-12">
                <section class="panel">
                    <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                        <div>
                            <div class="d-flex gap-2 align-items-center flex-wrap mb-2">
                                <span class="badge text-bg-primary">
                                    {{ $tip->category?->name ?? 'Student basics' }}
                                </span>

                                @if ($tip->is_pinned)
                                    <span class="badge text-bg-warning">Pinned</span>
                                @endif
                            </div>

                            <h2 class="h5 fw-bold mb-2">{{ $tip->title }}</h2>
                            <p class="mb-2">{{ $tip->description }}</p>
                            <p class="small muted mb-0">{{ $tip->context }}</p>

                            @if ($tip->category)
                                <div class="small mt-2">
                                    This month in {{ $tip->category->name }}:
                                    <strong>PKR {{ number_format($tip->current_spend, 2) }}</strong>
                                    @if ($tip->budget_limit)
                                        of PKR {{ number_format($tip->budget_limit, 2) }}
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('saving-tips.pin', $tip) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">
                                    {{ $tip->is_pinned ? 'Unpin' : 'Pin' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('saving-tips.dismiss', $tip) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-secondary">
                                    Dismiss
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
@endif
@endsection