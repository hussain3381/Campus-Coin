@extends('layouts.student')

@section('title', 'Reports')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <div class="small text-primary fw-bold">REVIEW YOUR RECORDS</div>
            <h1 class="h2 fw-bold mb-1">Reports</h1>
            <p class="muted mb-0">Summaries are calculated from your saved transactions.</p>
        </div>

        <button class="btn btn-outline-primary no-print" onclick="window.print()">
            Print / Save as PDF
        </button>
    </div>

    <form method="GET" action="{{ route('reports.index') }}" class="panel mb-4 no-print">
        <div class="row g-3 align-items-end">
            <div class="col-sm-6 col-lg-3">
                <label class="form-label">From</label>
                <input type="date" name="from" class="form-control" value="{{ $from }}">
            </div>

            <div class="col-sm-6 col-lg-3">
                <label class="form-label">To</label>
                <input type="date" name="to" class="form-control" value="{{ $to }}">
            </div>

            <div class="col-sm-6 col-lg-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-2">
                <label class="form-label">Type</label>
                <select name="type" class="form-select">
                    <option value="">Income & expenses</option>
                    <option value="income" @selected(($filters['type'] ?? '') === 'income')>Income</option>
                    <option value="expense" @selected(($filters['type'] ?? '') === 'expense')>Expense</option>
                </select>
            </div>
            <div class="col-sm-6 col-lg-2">
                <label class="form-label">Chart period</label>
                <select name="period" class="form-select">
                    <option value="15d" @selected($period === '15d')>Last 15 days</option>
                    <option value="1m" @selected($period === '1m')>Last 1 month</option>
                    <option value="3m" @selected($period === '3m')>Last 3 months</option>
                    <option value="6m" @selected($period === '6m')>Last 6 months</option>
                </select>
            </div>
            <div class="col-lg-1 d-grid">
                <button class="btn btn-primary">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="muted">Income</div>
                <div class="h4 fw-bold text-success mt-2">PKR {{ number_format($income, 2) }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="muted">Expenses</div>
                <div class="h4 fw-bold text-danger mt-2">PKR {{ number_format($expenses, 2) }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="muted">Net balance</div>
                <div class="h4 fw-bold mt-2">PKR {{ number_format($net, 2) }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="muted">Average expense per day</div>
                <div class="h4 fw-bold mt-2">PKR {{ number_format($dailyAverage, 2) }}</div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-lg-8">
            <section class="panel h-100">
                <h2 class="h5 fw-bold">
                    Income vs expenses —
                    {{ $period === '15d' ? 'last 15 days' : ($period === '1m' ? 'last month' : ($period === '3m' ? 'last 3 months' : 'last 6 months')) }}
                </h2>

                @if ($trend->sum('income') == 0 && $trend->sum('expenses') == 0)
                    <p class="muted mt-3 mb-0">No transaction data for this trend yet.</p>
                @else
                    <div style="height:340px">
                        <canvas id="incomeExpenseChart" role="img"
                            aria-label="Income compared with expenses for the selected period"></canvas>
                    </div>
                @endif
            </section>
        </div>

        <div class="col-lg-4">
            <section class="panel h-100">
                <h2 class="h5 fw-bold">Spending by category</h2>

                @forelse ($categoryBreakdown as $name => $amount)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $name }}</span>
                        <strong>PKR {{ number_format($amount, 2) }}</strong>
                    </div>
                @empty
                    <p class="muted mt-3 mb-0">No expense records in this date range.</p>
                @endforelse
            </section>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <section class="panel h-100">
                <h2 class="h5 fw-bold">Daily summary</h2>

                @forelse ($daily as $day)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $day['label'] }}</span>
                        <span>
                            <span class="text-success">+{{ number_format($day['income'], 2) }}</span>
                            /
                            <span class="text-danger">−{{ number_format($day['expenses'], 2) }}</span>
                        </span>
                    </div>
                @empty
                    <p class="muted mt-3 mb-0">No records for this date range.</p>
                @endforelse
            </section>
        </div>

        <div class="col-lg-6">
            <section class="panel h-100">
                <h2 class="h5 fw-bold">Weekly summary</h2>

                @forelse ($weekly as $week)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $week['label'] }}</span>
                        <span>
                            <span class="text-success">+{{ number_format($week['income'], 2) }}</span>
                            /
                            <span class="text-danger">−{{ number_format($week['expenses'], 2) }}</span>
                        </span>
                    </div>
                @empty
                    <p class="muted mt-3 mb-0">No records for this date range.</p>
                @endforelse
            </section>
        </div>
    </div>

    <section class="panel mt-3">
        <h2 class="h5 fw-bold">Savings rate and largest expense</h2>
        <p class="mb-2">Savings rate: <strong>{{ number_format($savingsRate, 1) }}%</strong></p>

        @if ($largestExpense)
            <p class="muted mb-0">
                Largest expense: {{ $largestExpense->description }}
                · PKR {{ number_format($largestExpense->amount, 2) }}
            </p>
        @else
            <p class="muted mb-0">No expense record in this date range.</p>
        @endif
    </section>

    <style>
        @media print {

            .app-sidebar,
            .topbar,
            .no-print {
                display: none !important;
            }

            .content-area {
                max-width: none !important;
                padding: 0 !important;
            }

            body {
                background: #fff !important;
            }

            .panel,
            .stat-card {
                box-shadow: none !important;
                break-inside: avoid;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const points = @json($trend);

    new Chart(document.getElementById('incomeExpenseChart'), {
        type: 'bar',
        data: {
            labels: points.map(point => point.label),
            datasets: [
                {
                    label: 'Income (PKR)',
                    data: points.map(point => point.income),
                    backgroundColor: '#10b981',
                    borderRadius: 5
                },
                {
                    label: 'Expenses (PKR)',
                    data: points.map(point => point.expenses),
                    backgroundColor: '#ef4444',
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'PKR ' + Number(value).toLocaleString()
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: context =>
                            context.dataset.label + ': PKR ' +
                            Number(context.raw).toLocaleString()
                    }
                }
            }
        }
    });
</script>
@endsection