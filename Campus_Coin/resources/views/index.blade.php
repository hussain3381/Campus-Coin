<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Coin — Smart Spending, Student Style</title>
    <meta name="description"
        content="A student-first place to record income, track spending, and plan monthly budgets. No bank connection required.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue: #1749c8;
            --navy: #12245f;
            --ink: #142039;
            --muted: #67758c;
            --canvas: #f5f8ff;
            --line: #e2e8f3;
        }

        body {
            color: var(--ink);
            background: #fff;
            font-family: Inter, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
        }

        .site-nav {
            min-height: 76px;
            background: rgba(255, 255, 255, .96);
            border-bottom: 1px solid #edf0f6;
        }

        .brand {
            color: var(--navy);
            text-decoration: none;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .brand-icon {
            display: inline-grid;
            place-items: center;
            width: 40px;
            height: 40px;
            margin-right: 9px;
            color: #fff;
            background: var(--blue);
            border-radius: 13px;
            box-shadow: 0 6px 16px #1749c833;
        }

        .nav-link-clean {
            color: #536178;
            text-decoration: none;
            font-size: .92rem;
            font-weight: 600;
        }

        .nav-link-clean:hover {
            color: var(--blue);
        }

        .hero {
            overflow: hidden;
            padding: 76px 0 82px;
            background:
                radial-gradient(circle at 82% 42%, #e4efff 0, transparent 34%),
                linear-gradient(180deg, #f8faff 0%, #f2f7ff 100%);
        }

        .eyebrow {
            color: var(--blue);
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 650px;
            margin: 14px 0 18px;
            color: var(--blue);
            font-size: clamp(3.3rem, 7vw, 5.8rem);
            font-weight: 850;
            line-height: .98;
            letter-spacing: -.065em;
        }

        .hero h2 {
            max-width: 600px;
            margin-bottom: 16px;
            font-size: clamp(1.45rem, 3vw, 2.2rem);
            font-weight: 760;
            line-height: 1.13;
            letter-spacing: -.04em;
        }

        .hero-copy {
            max-width: 560px;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.75;
        }

        .btn-brand {
            padding: 12px 19px;
            color: #fff;
            background: var(--blue);
            border: 1px solid var(--blue);
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-brand:hover {
            color: #fff;
            background: #123ba8;
            border-color: #123ba8;
        }

        .btn-quiet {
            padding: 12px 16px;
            color: var(--ink);
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
        }

        .trust-note {
            max-width: 510px;
            margin-top: 25px;
            padding: 14px 16px;
            color: #58667e;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            font-size: .88rem;
        }

        .preview-wrap {
            position: relative;
            max-width: 540px;
            margin: 24px auto;
        }

        .preview-window {
            overflow: hidden;
            background: #fff;
            border: 1px solid #dce5f4;
            border-radius: 18px;
            box-shadow: 0 24px 70px #243e751c;
            transform: rotate(1deg);
        }

        .preview-top {
            display: flex;
            justify-content: space-between;
            padding: 15px 18px;
            border-bottom: 1px solid var(--line);
        }

        .preview-sidebar {
            width: 58px;
            min-height: 235px;
            padding: 16px 12px;
            color: #fff;
            background: var(--navy);
        }

        .preview-main {
            padding: 22px;
        }

        .preview-kpi {
            padding: 13px 9px;
            background: #fbfcff;
            border: 1px solid var(--line);
            border-radius: 10px;
            text-align: center;
        }

        .preview-kpi strong {
            display: block;
            margin-top: 6px;
            font-size: .95rem;
        }

        .preview-empty {
            margin-top: 14px;
            padding: 27px 15px;
            color: var(--muted);
            background: #fafbff;
            border: 1px dashed #d5deee;
            border-radius: 12px;
            text-align: center;
        }

        .float-tag {
            position: absolute;
            padding: 10px 14px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 10px 28px #243e7518;
            font-size: .8rem;
            font-weight: 700;
        }

        .float-income {
            top: 16%;
            right: -3%;
            color: #078257;
        }

        .float-goal {
            bottom: 11%;
            left: -5%;
            color: var(--blue);
        }

        .section {
            padding: 78px 0;
        }

        .section-tint {
            background: var(--canvas);
        }

        .section-title {
            max-width: 700px;
            margin: 10px auto 12px;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 760;
            letter-spacing: -.045em;
        }

        .section-copy {
            max-width: 680px;
            margin: 0 auto;
            color: var(--muted);
            line-height: 1.7;
        }

        .feature-card,
        .step-card {
            height: 100%;
            padding: 24px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 15px;
            box-shadow: 0 5px 20px #20365e08;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .feature-card:hover,
        .step-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px #20365e12;
        }

        .feature-icon {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            margin-bottom: 17px;
            color: var(--blue);
            background: #eaf0ff;
            border-radius: 12px;
            font-size: 1.2rem;
        }

        .feature-card p,
        .step-card p {
            margin-bottom: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .category-strip {
            padding: 16px 18px;
            color: #33435e;
            background: #edf3ff;
            border-radius: 12px;
            font-size: .9rem;
            font-weight: 650;
        }

        .site-footer {
            padding: 48px 0 22px;
            color: #fff;
            background: var(--navy);
        }

        .site-footer a {
            display: block;
            margin: 9px 0;
            color: #d6def4;
            text-decoration: none;
            font-size: .9rem;
        }

        .site-footer a:hover {
            color: #fff;
        }

        .footer-note {
            color: #b9c5e4;
            font-size: .85rem;
        }

        @media (max-width: 767px) {
            .hero {
                padding: 54px 0 58px;
            }

            .section {
                padding: 58px 0;
            }

            .preview-wrap {
                margin-top: 38px;
            }

            .float-income {
                right: 0;
            }

            .float-goal {
                left: 0;
            }
        }
    </style>
</head>

<body>
    <nav class="site-nav navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="brand navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('images/campus-coin-logo.svg') }}" alt="Campus Coin — Student Budget Tracker"
                    width="240" height="56">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav"
                aria-label="Open navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="landingNav">
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-4 py-3 py-lg-0">
                    <a class="nav-link-clean" href="#features">Features</a>
                    <a class="nav-link-clean" href="#how-it-works">How it works</a>
                    <a class="nav-link-clean" href="#sitemap">Sitemap</a>

                    @auth
                        <a class="btn-brand text-center" href="{{ route('dashboard') }}">Open dashboard</a>
                    @else
                        <a class="nav-link-clean" href="{{ route('login') }}">Log in</a>
                        <a class="btn-brand text-center" href="{{ route('register') }}">Get started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="eyebrow">✦ Built around student life</div>
                    <h1>Campus<br>Coin</h1>
                    <h2>Know where your allowance goes—without linking a bank account.</h2>
                    <p class="hero-copy">
                        Manually record student income and expenses, plan category budgets,
                        and understand your spending in one simple campus-friendly workspace.
                    </p>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        @auth
                            <a class="btn-brand" href="{{ route('dashboard') }}">Open your workspace →</a>
                        @else
                            <a class="btn-brand" href="{{ route('register') }}">Create free account →</a>
                            <a class="btn-quiet" href="{{ route('login') }}">Log in</a>
                        @endauth
                    </div>

                    <div class="trust-note">
                        <strong><i class="fa-solid fa-shield-halved me-2"></i>No bank connection.</strong>
                        Campus Coin is a budgeting record keeper, not a payment service.
                        Transactions are entered manually or imported by the student.
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="preview-wrap">
                        <div class="float-tag float-income"><i class="fa-solid fa-arrow-trend-up me-2"></i>Income</div>

                        <div class="preview-window">
                            <div class="preview-top">
                                <div><span class="text-primary fw-bold">Campus Coin</span>
                                    <span class="small text-secondary ms-2">New account preview</span>
                                </div>
                                <span class="small text-secondary">PKR</span>
                            </div>

                            <div class="d-flex">
                                <div class="preview-sidebar">
                                    <div class="mb-4"><i class="fa-solid fa-wallet"></i></div>
                                    <div class="mb-3"><i class="fa-solid fa-table-cells-large"></i></div>
                                    <div class="mb-3"><i class="fa-solid fa-right-left"></i></div>
                                    <div><i class="fa-solid fa-chart-pie"></i></div>
                                </div>

                                <div class="preview-main flex-grow-1">
                                    <div class="small text-primary fw-bold">YOUR MONTH STARTS HERE</div>
                                    <h3 class="h5 mt-2">A clearer view of your money</h3>

                                    <div class="row g-2 mt-3">
                                        <div class="col-4">
                                            <div class="preview-kpi">
                                                <span class="small text-secondary">Income</span>
                                                <strong>PKR 0</strong>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="preview-kpi">
                                                <span class="small text-secondary">Expenses</span>
                                                <strong>PKR 0</strong>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="preview-kpi">
                                                <span class="small text-secondary">Balance</span>
                                                <strong>PKR 0</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="preview-empty">
                                        <div class="fs-4 mb-2"><i class="fa-solid fa-box-archive"></i></div>
                                        <strong>No records shown</strong>
                                        <div class="small mt-1">Add your first income or expense after signing in.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="float-tag float-goal"><i class="fa-solid fa-piggy-bank me-2"></i>Savings goal</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="section" id="features">
        <div class="container text-center">
            <div class="eyebrow">Everything in one place</div>
            <h2 class="section-title">A calmer way to manage student money</h2>
            <p class="section-copy">
                Simple tools designed for allowance, campus spending, study costs,
                transport, rent and the everyday choices students make.
            </p>

            <div class="row g-3 text-start mt-4">
                <div class="col-sm-6 col-lg-3">
                    <article class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <h3 class="h5 fw-bold">Track manually</h3>
                        <p>Record allowance, part-time income, food, transport, rent and more.</p>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <article class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-table-list"></i></div>
                        <h3 class="h5 fw-bold">Plan category budgets</h3>
                        <p>Set monthly limits and monitor spending against each category.</p>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <article class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-chart-column"></i></div>
                        <h3 class="h5 fw-bold">Review clear reports</h3>
                        <p>Understand monthly totals and category patterns from your records.</p>
                    </article>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <article class="feature-card">
                        <div class="feature-icon"><i class="fa-solid fa-file-csv"></i></div>
                        <h3 class="h5 fw-bold">Import a CSV</h3>
                        <p>Review rows and errors before confirming an import.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-tint" id="how-it-works">
        <div class="container">
            <div class="text-center">
                <div class="eyebrow">Three simple steps</div>
                <h2 class="section-title">From first entry to a clearer month</h2>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <article class="step-card">
                        <div class="eyebrow mb-3">01</div>
                        <h3 class="h5 fw-bold">Set your baseline</h3>
                        <p>Add your academic year, monthly allowance and savings goal.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="step-card">
                        <div class="eyebrow mb-3">02</div>
                        <h3 class="h5 fw-bold">Log as you go</h3>
                        <p>Record each income or expense and choose a student-relevant category.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="step-card">
                        <div class="eyebrow mb-3">03</div>
                        <h3 class="h5 fw-bold">Review your month</h3>
                        <p>Check budgets and reports to understand your spending habits.</p>
                    </article>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="category-strip"><i class="fa-solid fa-arrow-trend-up me-2"></i>Income: Allowance ·
                        Part-time Job · Scholarship · Gift</div>
                </div>
                <div class="col-md-6">
                    <div class="category-strip"><i class="fa-solid fa-arrow-trend-down me-2"></i>Expenses: Food ·
                        Transport · Academics · Hostel/Rent</div>
                </div>
            </div>

            <p class="text-center small text-secondary mt-4 mb-0">
                Optional AI features are not connected yet and will remain marked Coming Soon.
            </p>
        </div>
    </section>

    <section class="site-footer" id="sitemap">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a class="brand text-white" href="{{ route('index') }}">
                        <img src="{{ asset('images/campus-coin-logo.svg') }}" alt="Campus Coin — Student Budget Tracker"
                            width="240" height="56">
                    </a>
                    <p class="footer-note mt-3">
                        Smart Spending, Student Style.<br>
                        No banking, cards, loans, investments or payment services.
                    </p>
                </div>

                <div class="col-6 col-lg-2">
                    <strong>Product</strong>
                    <a href="#features">Features</a>
                    <a href="#how-it-works">How it works</a>
                    <a href="#sitemap">Sitemap</a>
                </div>

                <div class="col-6 col-lg-2">
                    <strong>Access</strong>
                    <a href="{{ route('login') }}">Student login</a>
                    <a href="{{ route('register') }}">Student registration</a>
                    <span class="footer-note d-block mt-2">Admin access is separate.</span>
                </div>

                <div class="col-lg-3">
                    <strong>Sitemap</strong>
                    <p class="footer-note mt-2 mb-0">
                        Public: Home, Login, Register<br>
                        Student: Dashboard, Transactions, Categories, Budgets, Reports, Saving Tips, Profile<br>
                        Admin: Dashboard, Students, Categories, Tips, Announcements, Statistics
                    </p>
                </div>
            </div>

            <hr class="border-light opacity-25 my-4">
            <div class="footer-note">© {{ now()->year }} Campus Coin · Student budgeting workspace</div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>