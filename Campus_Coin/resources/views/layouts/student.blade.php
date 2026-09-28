<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · Campus Coin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --brand: #1e40af;
            --brand-light: #eef2ff;
            --canvas: #f5f7fc;
            --ink: #172033;
            --muted: #77839a;
            --line: #e6eaf2;
        }

        body {
            min-height: 100vh;
            background: var(--canvas);
            color: var(--ink);
            font-family: Inter, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
        }

        .app-shell {
            min-height: 100vh;
        }

        .app-sidebar {
            width: 258px;
            min-width: 258px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid var(--line);
            padding: 24px 16px;
        }

        .brand {
            color: var(--brand);
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 750;
            letter-spacing: -.4px;
        }

        .brand-mark {
            display: inline-grid;
            place-items: center;
            width: 36px;
            height: 36px;
            margin-right: 8px;
            border-radius: 11px;
            background: var(--brand-light);
        }

        .section-label {
            margin: 28px 10px 8px;
            color: #98a2b3;
            font-size: .69rem;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .side-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            margin: 4px 0;
            border-radius: 10px;
            color: #58657a;
            text-decoration: none;
            font-size: .94rem;
            font-weight: 550;
        }

        .side-link:hover {
            background: #f5f7fc;
            color: var(--brand);
        }

        .side-link.active {
            background: var(--brand-light);
            color: var(--brand);
            font-weight: 700;
        }

        .side-icon {
            width: 22px;
            text-align: center;
            font-size: 1.05rem;
        }

        .planned-link {
            display: flex;
            justify-content: space-between;
            padding: 11px 13px;
            color: #8a94a6;
            font-size: .92rem;
        }

        .planned-badge {
            border-radius: 20px;
            background: #f0f2f6;
            padding: 3px 7px;
            font-size: .65rem;
        }

        .main-column {
            min-width: 0;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 72px;
            padding: 12px 30px;
            background: rgba(255, 255, 255, .94);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(10px);
        }

        .topbar-label {
            color: var(--muted);
            font-size: .82rem;
        }

        .user-avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--brand-light);
            color: var(--brand);
            font-weight: 700;
        }

        .content-area {
            width: 100%;
            max-width: 1500px;
            margin: auto;
            padding: 30px;
        }

        .panel,
        .stat-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(25, 42, 82, .04);
        }

        .panel {
            padding: 24px;
        }

        .stat-card {
            height: 100%;
            padding: 22px;
        }

        .muted {
            color: var(--muted);
        }

        .btn-primary {
            background: #2450cb;
            border-color: #2450cb;
        }

        .btn-primary:hover {
            background: #183da9;
            border-color: #183da9;
        }

        .form-control,
        .form-select {
            border-color: #dfe4ef;
            border-radius: 9px;
            padding: .68rem .82rem;
        }

        @media (max-width: 991.98px) {
            .topbar {
                min-height: 64px;
                padding: 10px 16px;
            }

            .content-area {
                padding: 20px 16px;
            }
        }

        @media (max-width: 575.98px) {

            .panel,
            .stat-card {
                padding: 17px;
            }
        }
    </style>
</head>

<body>
    <div class="app-shell d-flex">
        <aside class="app-sidebar d-none d-lg-flex flex-column">
            <a class="brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/campus-coin-logo.svg') }}" alt="Campus Coin — Student Budget Tracker"
                    width="240" height="56">
            </a>

            <div class="section-label">Workspace</div>

            <a class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span class="side-icon"><i class="fa-solid fa-house"></i></span> Dashboard
            </a>

            <a class="side-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}"
                href="{{ route('transactions.index') }}">
                <span class="side-icon"><i class="fa-solid fa-right-left"></i></span> Transactions
            </a>

            <a class="side-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}">
                <span class="side-icon"><i class="fa-solid fa-table-cells-large"></i></span> Categories
            </a>

            <a class="side-link {{ request()->routeIs('budgets.*') ? 'active' : '' }}"
                href="{{ route('budgets.index') }}">
                <span class="side-icon"><i class="fa-solid fa-wallet"></i></span> Budgets
            </a>

            <a class="side-link {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                href="{{ route('reports.index') }}">
                <span class="side-icon"><i class="fa-solid fa-chart-column"></i></span> Reports
            </a>
            <a class="side-link {{ request()->routeIs('saving-tips.*') ? 'active' : '' }}"
                href="{{ route('saving-tips.index') }}">
                <span class="side-icon"><i class="fa-solid fa-hand-holding-dollar"></i></span> Saving tips
            </a>
            <div class="section-label">Coming next</div>
            <div class="mt-auto pt-4 border-top">
                <a class="side-link" href="{{ route('profile.edit') }}">
                    <span class="side-icon"><i class="fa-solid fa-user-gear"></i></span> Profile settings
                </a>
                <div class="small muted px-3">Student workspace · PKR</div>
            </div>
        </aside>

        <div class="main-column flex-grow-1">
            <header class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileMenu" aria-label="Open navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <div class="topbar-label">CAMPUS COIN</div>
                        <div class="fw-semibold">@yield('title', 'Student workspace')</div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="small d-none d-sm-inline">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary">Log out</button>
                    </form>
                </div>
            </header>

            <main class="content-area">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-warning">{{ session('error') }}</div>
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
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">
            <a class="brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/campus-coin-logo.svg') }}" alt="Campus Coin — Student Budget Tracker"
                    width="240" height="56">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <a class="side-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
            <a class="side-link" href="{{ route('transactions.index') }}"><i
                    class="fa-solid fa-right-left me-2"></i>Transactions</a>
            <a class="side-link" href="{{ route('categories.index') }}"><i
                    class="fa-solid fa-table-cells-large me-2"></i>Categories</a>
            <a class="side-link" href="{{ route('budgets.index') }}"><i class="fa-solid fa-wallet me-2"></i>Budgets</a>
            <a class="side-link" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2"></i>Profile
                settings</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>