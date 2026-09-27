<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Transactions') | Campus Coin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f8f9ff; color:#172033; }
        .navbar-brand { color:#1e40af; font-weight:700; }
        .page-wrap { max-width:1250px; }
        .panel, .stat-card {
            background:#fff; border:1px solid #e2e8f0;
            border-radius:14px; box-shadow:0 3px 14px #1d2b4d08;
        }
        .panel { padding:24px; }
        .muted { color:#728097; }
        .btn-primary { background:#2450cb; border-color:#2450cb; }
        .form-control, .form-select { border-radius:9px; padding:.65rem .8rem; }
        @media(max-width:576px) { .panel { padding:16px; } }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container page-wrap">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Campus Coin</a>

        <div class="ms-auto d-flex align-items-center gap-3">
            <a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a>
            <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
            <span class="small text-secondary">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-secondary">Log out</button>
            </form>
        </div>
    </div>
</nav>

<main class="container page-wrap py-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>