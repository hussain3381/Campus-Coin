<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Coin · Student Access</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            color: #142039;
            background: linear-gradient(135deg, #f6f8ff 0%, #e8f3ff 100%);
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .auth-top {
            position: absolute;
            top: 22px;
            left: max(22px, calc((100% - 1180px) / 2));
        }

        .auth-top a {
            color: #536178;
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
        }

        .auth-screen {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 76px 16px 28px;
        }

        .auth-card {
            width: 100%;
            max-width: 470px;
            padding: 32px;
            background: #fff;
            border: 1px solid #e2e8f3;
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(30, 64, 175, .12);
        }

        .auth-logo {
            display: block;
            width: 220px;
            max-width: 100%;
            height: auto;
            margin-bottom: 26px;
        }

        .auth-kicker {
            margin-bottom: 8px;
            color: #2450cb;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .auth-card h1 {
            font-size: 1.7rem;
            font-weight: 750;
            letter-spacing: -.04em;
        }

        .auth-card .form-control,
        .auth-card .form-select {
            min-height: 44px;
            border-color: #dce3ef;
            border-radius: 9px;
        }

        .auth-card .form-control:focus,
        .auth-card .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
        }

        .auth-submit {
            min-height: 45px;
            color: #fff;
            background: #1e40af;
            border: 0;
            border-radius: 9px;
            font-weight: 700;
        }

        .auth-submit:hover {
            background: #17358f;
        }

        @media (max-width: 575px) {
            .auth-card {
                padding: 24px 20px;
            }

            .auth-logo {
                width: 195px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-top">
        <a href="{{ route('index') }}">← Back to Campus Coin</a>
    </div>

    <main class="auth-screen">
        <section class="auth-card">
            <a href="{{ route('index') }}">
                <img class="auth-logo" src="{{ asset('images/campus-coin-logo.svg') }}"
                    alt="Campus Coin — Student Budget Tracker" width="240" height="56">
            </a>

            {{ $slot }}
        </section>
    </main>
</body>

</html>