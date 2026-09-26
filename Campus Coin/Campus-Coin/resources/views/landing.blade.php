{{--
|--------------------------------------------------------------------------
| Campus Coin — Landing / Index Page (Frontend only)
|--------------------------------------------------------------------------
| File   : resources/views/landing.blade.php
| Route  : routes/web.php  ->  Route::get('/', ...)->name('home');
| Stack  : Laravel 12 + Tailwind CSS 4 (Vite) + vanilla JS
|
| NOTE: Is page ko chalane ke liye:
|       composer install
|       npm install && npm run build     (ya npm run dev)
|       php artisan serve
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Campus Coin — The digital coin for your campus</title>
    <meta name="description" content="Campus Coin is the digital wallet built for campuses. Top up once and pay for canteen meals, printing, laundry and events with a single QR tap. No cash, no queues.">

    {{-- Favicon (inline SVG, koi file upload karne ki zaroorat nahi) --}}
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%234f46e5'/%3E%3Ccircle cx='16' cy='16' r='8' fill='none' stroke='%23fbbf24' stroke-width='2.5'/%3E%3Cpath d='M16 11v10M13.5 13.5h4a2 2 0 010 4h-3a2 2 0 000 4h4' stroke='%23fbbf24' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet">

    {{-- Vite (yaad rakhein: npm run build / npm run dev zaroori hai) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom CSS: sirf is page ke liye (fonts, animations, glass effect) --}}
    <style>
        :root { --cc-indigo: #4f46e5; --cc-violet: #7c3aed; --cc-amber: #f59e0b; }

        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ---------- Hero background blobs + grid ---------- */
        .cc-hero-bg::before,
        .cc-hero-bg::after {
            content: ''; position: absolute; border-radius: 9999px; filter: blur(90px); z-index: 0;
            animation: cc-float 14s ease-in-out infinite;
        }
        .cc-hero-bg::before { width: 34rem; height: 34rem; top: -14rem; left: -10rem; background: rgba(79,70,229,.28); }
        .cc-hero-bg::after  { width: 30rem; height: 30rem; top: -8rem;  right: -8rem; background: rgba(245,158,11,.22); animation-delay: -6s; }
        .cc-grid {
            background-image: linear-gradient(to right, rgba(15,23,42,.055) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(15,23,42,.055) 1px, transparent 1px);
            background-size: 46px 46px;
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 0%, #000 55%, transparent 100%);
                    mask-image: radial-gradient(ellipse 70% 60% at 50% 0%, #000 55%, transparent 100%);
        }
        @keyframes cc-float {
            0%,100% { transform: translate3d(0,0,0) scale(1); }
            50%     { transform: translate3d(0,2.5rem,0) scale(1.06); }
        }

        /* ---------- Gradient text ---------- */
        .cc-grad-text {
            background: linear-gradient(100deg, #4f46e5 0%, #7c3aed 45%, #f59e0b 100%);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }

        /* ---------- Glass card ---------- */
        .cc-glass {
            background: rgba(255,255,255,.72);
            backdrop-filter: blur(14px) saturate(150%);
            -webkit-backdrop-filter: blur(14px) saturate(150%);
        }

        /* ---------- Scroll reveal ---------- */
        .cc-reveal { opacity: 0; transform: translateY(26px); transition: opacity .7s ease, transform .7s cubic-bezier(.22,1,.36,1); }
        .cc-reveal.is-in { opacity: 1; transform: none; }
        @media (prefers-reduced-motion: reduce) {
            .cc-reveal { opacity: 1; transform: none; transition: none; }
            .cc-hero-bg::before, .cc-hero-bg::after { animation: none; }
        }

        /* ---------- Phone mockup floating cards ---------- */
        .cc-bob { animation: cc-bob 5s ease-in-out infinite; }
        .cc-bob-slow { animation: cc-bob 7s ease-in-out infinite; animation-delay: -2s; }
        @keyframes cc-bob { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }

        /* ---------- FAQ accordion ---------- */
        details.cc-faq summary::-webkit-details-marker { display: none; }
        details.cc-faq summary { list-style: none; }
        details.cc-faq[open] .cc-faq-icon { transform: rotate(45deg); }
        details.cc-faq[open] .cc-faq-q { color: #4f46e5; }

        /* ---------- Bar chart (vendor mockup) ---------- */
        .cc-bar { background: linear-gradient(180deg, #818cf8, #4f46e5); border-radius: 6px 6px 2px 2px; }

        ::selection { background: #c7d2fe; }
    </style>
</head>

<body class="bg-white text-slate-900 antialiased selection:bg-indigo-200">

{{-- ============================================================
     1. TOP ANNOUNCEMENT BAR
     ============================================================ --}}
<div class="relative z-50 bg-slate-950 px-4 py-2.5 text-center text-[13px] font-medium text-slate-300">
    <span class="inline-flex items-center gap-2">
        <span class="inline-flex h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-400"></span>
        Campus Coin 2.0 is live — QR payments ab <span class="font-semibold text-white">1 second</span> mein.
        <a href="#features" class="hidden underline decoration-slate-600 underline-offset-4 hover:text-white sm:inline">Dekhein kya naya hai →</a>
    </span>
</div>

{{-- ============================================================
     2. NAVBAR
     ============================================================ --}}
<header id="site-header" class="sticky top-0 z-50 border-b border-slate-200/70 cc-glass transition-shadow duration-300">
    <nav class="mx-auto flex h-18 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="Main">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2.5">
            <span class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 shadow-lg shadow-indigo-600/30">
                <svg class="h-5 w-5 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 6.5v11M15 9.2a3 3 0 00-3-1.2h-1a2 2 0 000 4h1.8a2 2 0 010 4H11a3 3 0 01-3-1.2" />
                </svg>
            </span>
            <span class="text-[19px] font-extrabold tracking-tight text-slate-900">Campus<span class="text-indigo-600">Coin</span></span>
        </a>

        {{-- Desktop links --}}
        <div class="hidden items-center gap-1 lg:flex">
            @foreach ([
                ['Features', '#features'],
                ['How it works', '#how-it-works'],
                ['For vendors', '#vendors'],
                ['Security', '#security'],
                ['FAQ', '#faq'],
            ] as [$label, $anchor])
                <a href="{{ $anchor }}" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">{{ $label }}</a>
            @endforeach
        </div>

        {{-- Desktop CTA --}}
        <div class="hidden items-center gap-2 lg:flex">
            <a href="#" class="rounded-full px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Sign in</a>
            <a href="#cta" class="group inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-600/25 transition hover:shadow-xl hover:shadow-indigo-600/35">
                Get started
                <svg class="h-4 w-4 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Mobile burger --}}
        <button id="menu-btn" type="button" aria-controls="mobile-menu" aria-expanded="false"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-700 lg:hidden">
            <span class="sr-only">Menu kholain</span>
            <svg id="icon-open" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            <svg id="icon-close" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white px-4 pb-5 pt-2 lg:hidden">
        <div class="flex flex-col">
            @foreach ([
                ['Features', '#features'],
                ['How it works', '#how-it-works'],
                ['For vendors', '#vendors'],
                ['Security', '#security'],
                ['FAQ', '#faq'],
            ] as [$label, $anchor])
                <a href="{{ $anchor }}" class="rounded-xl px-3 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100">{{ $label }}</a>
            @endforeach
        </div>
        <div class="mt-3 grid gap-2">
            <a href="#" class="rounded-xl border border-slate-200 px-4 py-3 text-center text-sm font-semibold text-slate-800">Sign in</a>
            <a href="#cta" class="rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-3 text-center text-sm font-bold text-white">Get started free</a>
        </div>
    </div>
</header>

<main>
{{-- ============================================================
     3. HERO
     ============================================================ --}}
<section class="cc-hero-bg relative overflow-hidden bg-white pt-14 pb-20 sm:pt-20 lg:pt-24 lg:pb-28">
    <div class="cc-grid absolute inset-0 z-0"></div>

    <div class="relative z-10 mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:gap-10 lg:px-8">
        {{-- Left: copy --}}
        <div class="cc-reveal">
            <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50/80 px-4 py-1.5 text-[13px] font-bold text-indigo-700">
                <span class="grid h-5 w-5 place-items-center rounded-full bg-indigo-600 text-[10px] text-white">★</span>
                Now live on 40+ campuses
            </span>

            <h1 class="mt-6 text-4xl font-extrabold leading-[1.08] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                Ek wallet.<br>
                Poora campus <span class="cc-grad-text">cashless.</span>
            </h1>

            <p class="mt-6 max-w-xl text-[17px] leading-relaxed text-slate-600">
                Campus Coin se canteen ka khana, printing, laundry aur events — sab kuch ek QR tap se pay karein.
                Top-up ek dafa, phir na cash, na change, na lambi lines.
            </p>

            {{-- CTAs --}}
            <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
                <a href="#cta" class="group inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-7 py-3.5 text-[15px] font-bold text-white shadow-xl shadow-indigo-600/30 transition hover:-translate-y-0.5 hover:shadow-2xl hover:shadow-indigo-600/40">
                    Create free account
                    <svg class="h-4.5 w-4.5 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
                <a href="#how-it-works" class="inline-flex items-center justify-center gap-2.5 rounded-full border border-slate-200 bg-white px-6 py-3.5 text-[15px] font-bold text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                    <span class="grid h-6 w-6 place-items-center rounded-full bg-slate-900 text-white">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.5v13l11-6.5z"/></svg>
                    </span>
                    See how it works
                </a>
            </div>

            {{-- Social proof --}}
            <div class="mt-9 flex flex-wrap items-center gap-x-5 gap-y-3">
                <div class="flex -space-x-2.5">
                    @foreach ([['A','bg-indigo-500'],['B','bg-emerald-500'],['H','bg-amber-500'],['S','bg-rose-500']] as [$initial, $color])
                        <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white {{ $color }} text-xs font-bold text-white">{{ $initial }}</span>
                    @endforeach
                    <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-slate-900 text-[10px] font-bold text-white">12k+</span>
                </div>
                <div>
                    <div class="flex items-center gap-1 text-amber-400">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8-5.2-2.7-5.2 2.7 1-5.8L1.5 7.7l5.9-.9z"/></svg>
                        @endfor
                        <span class="ml-1 text-xs font-bold text-slate-700">4.9/5</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500">12,000+ students already paying with coins</p>
                </div>
            </div>
        </div>

        {{-- Right: phone mockup --}}
        <div class="cc-reveal relative mx-auto w-full max-w-md lg:max-w-none" style="transition-delay:.12s">
            {{-- glow --}}
            <div class="absolute left-1/2 top-1/2 -z-10 h-[26rem] w-[26rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-br from-indigo-300/50 via-violet-300/40 to-amber-200/50 blur-3xl"></div>

            {{-- phone frame --}}
            <div class="relative mx-auto w-[19rem] rounded-[2.75rem] border border-slate-800/10 bg-slate-900 p-2.5 shadow-2xl shadow-slate-900/40">
                <div class="overflow-hidden rounded-[2.25rem] bg-slate-50">
                    {{-- status bar --}}
                    <div class="flex items-center justify-between bg-white px-5 pt-3 text-[10px] font-bold text-slate-500">
                        <span>9:41</span>
                        <span class="flex items-center gap-1">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="M2 17h3v4H2zM8 12h3v9H8zM14 7h3v14h-3zM20 3h3v18h-3z"/></svg>
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="7" width="18" height="10" rx="3"/><rect x="21" y="10" width="2" height="4" rx="1"/></svg>
                        </span>
                    </div>

                    {{-- app header --}}
                    <div class="flex items-center justify-between bg-white px-5 pb-4 pt-3">
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400">Assalam-o-Alaikum 👋</p>
                            <p class="text-sm font-extrabold text-slate-900">Ayesha Khan</p>
                        </div>
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 text-xs font-bold text-white">AK</span>
                    </div>

                    {{-- balance card --}}
                    <div class="px-4">
                        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-indigo-700 p-5 text-white shadow-lg shadow-indigo-600/30">
                            <div class="absolute -right-8 -top-10 h-28 w-28 rounded-full bg-white/10"></div>
                            <div class="absolute -bottom-12 -left-6 h-28 w-28 rounded-full bg-amber-400/20"></div>
                            <p class="relative text-[11px] font-semibold uppercase tracking-widest text-indigo-100">Coin balance</p>
                            <p class="relative mt-1 flex items-end gap-2">
                                <span class="text-3xl font-extrabold tracking-tight">1,250</span>
                                <span class="pb-1 text-xs font-bold text-amber-300">CC</span>
                            </p>
                            <p class="relative mt-1 text-[11px] font-medium text-indigo-100">≈ PKR 1,250 · Valid till Jun 2027</p>
                            <div class="relative mt-4 flex gap-2">
                                <span class="rounded-full bg-white/95 px-3 py-1 text-[10px] font-extrabold text-indigo-700">+ Top up</span>
                                <span class="rounded-full bg-white/15 px-3 py-1 text-[10px] font-bold text-white ring-1 ring-inset ring-white/25">Scan QR</span>
                            </div>
                        </div>
                    </div>

                    {{-- quick actions --}}
                    <div class="grid grid-cols-4 gap-2 px-4 pt-4">
                        @foreach ([
                            ['Pay', 'M4 4h16v6H4zM4 14h7v6H4zM15 14h5v6h-5z'],
                            ['Send', 'M22 2L11 13M22 2l-7 20-4-9-9-4z'],
                            ['History', 'M3 12a9 9 0 109-9M3 12H1m2 0V9'],
                            ['More', 'M12 6h.01M12 12h.01M12 18h.01'],
                        ] as [$label, $path])
                            <div class="rounded-2xl bg-white p-2.5 text-center shadow-sm ring-1 ring-slate-100">
                                <svg class="mx-auto h-4 w-4 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $path }}"/></svg>
                                <p class="mt-1 text-[9px] font-bold text-slate-600">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- transactions --}}
                    <div class="mt-4 rounded-t-3xl bg-white px-4 pb-5 pt-4">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-extrabold text-slate-900">Recent activity</p>
                            <p class="text-[10px] font-bold text-indigo-600">See all</p>
                        </div>
                        <div class="mt-3 divide-y divide-slate-100">
                            @foreach ([
                                ['Campus Canteen', 'Today · 1:12 PM', '-45', 'bg-amber-50 text-amber-600'],
                                ['Main Library — Print', 'Today · 10:04 AM', '-12', 'bg-indigo-50 text-indigo-600'],
                                ['Wallet top-up', 'Yesterday · 6:30 PM', '+500', 'bg-emerald-50 text-emerald-600'],
                            ] as [$title, $meta, $amount, $tone])
                                <div class="flex items-center justify-between py-2.5">
                                    <div class="flex items-center gap-2.5">
                                        <span class="grid h-8 w-8 place-items-center rounded-xl {{ $tone }}">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                                        </span>
                                        <div>
                                            <p class="text-[11px] font-bold text-slate-800">{{ $title }}</p>
                                            <p class="text-[9px] font-medium text-slate-400">{{ $meta }}</p>
                                        </div>
                                    </div>
                                    <p class="text-[11px] font-extrabold {{ str_starts_with($amount, '+') ? 'text-emerald-600' : 'text-slate-700' }}">{{ $amount }} CC</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- floating: payment success --}}
            <div class="cc-bob absolute -left-2 top-24 hidden w-44 rounded-2xl border border-slate-100 bg-white/95 p-3 shadow-xl shadow-slate-900/10 backdrop-blur sm:block lg:-left-6">
                <div class="flex items-center gap-2">
                    <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                    </span>
                    <div>
                        <p class="text-[11px] font-extrabold text-slate-900">Payment successful</p>
                        <p class="text-[9px] font-medium text-slate-500">Campus Canteen · 45 CC</p>
                    </div>
                </div>
            </div>

            {{-- floating: cashback --}}
            <div class="cc-bob-slow absolute -right-2 bottom-28 hidden w-40 rounded-2xl border border-slate-100 bg-white/95 p-3 shadow-xl shadow-slate-900/10 backdrop-blur sm:block lg:-right-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Cashback earned</p>
                <p class="mt-0.5 flex items-center gap-1 text-lg font-extrabold text-slate-900">
                    <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                    +5 coins
                </p>
            </div>
        </div>
    </div>

    {{-- trust strip --}}
    <div class="relative z-10 mx-auto mt-16 max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 rounded-[2rem] border border-slate-200/80 bg-white/70 px-8 py-7 shadow-sm backdrop-blur sm:grid-cols-2 lg:grid-cols-4 lg:divide-x lg:divide-slate-200">
            @foreach ([
                ['12,000+', 'Active students'],
                ['40+', 'Partner campuses'],
                ['250+', 'Campus vendors'],
                ['1.2M', 'Coins spent / month'],
            ] as [$value, $label])
                <div class="text-center lg:px-4">
                    <p class="text-3xl font-extrabold tracking-tight text-slate-900" data-cc-count="{{ $value }}">{{ $value }}</p>
                    <p class="mt-1 text-[13px] font-semibold text-slate-500">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     4. FEATURES
     ============================================================ --}}
<section id="features" class="relative scroll-mt-24 bg-slate-50 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cc-reveal mx-auto max-w-2xl text-center">
            <p class="text-[13px] font-extrabold uppercase tracking-[0.18em] text-indigo-600">Features</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Sab kuch ek wallet mein</h2>
            <p class="mt-4 text-[16px] leading-relaxed text-slate-600">
                Campus ke andar hone wale har chhote bade payment ke liye ek hi app — students ke liye simple, admin ke liye control.
            </p>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                [
                    'Instant top-up',
                    'Campus counter, bank transfer ya parent card — balance foran add ho jata hai aur receipt app mein aa jati hai.',
                    'M12 5v14M5 12h14',
                    'from-indigo-500 to-violet-500',
                ],
                [
                    '1-second QR payments',
                    'Vendor ka QR scan karein, amount confirm karein — payment ek second mein ho jati hai, offline bhi.',
                    'M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z',
                    'from-amber-500 to-orange-500',
                ],
                [
                    'Spending limits',
                    'Students aur parents apni daily/monthly limit set kar sakte hain — overspending ki tension khatam.',
                    'M12 3a9 9 0 100 18 9 9 0 000-18zM12 7v5l3.5 2',
                    'from-emerald-500 to-teal-500',
                ],
                [
                    'Vendor dashboard',
                    'Canteens aur shops real-time sales, fees aur daily settlement ek simple dashboard mein dekhte hain.',
                    'M4 20h16M6 16V9m4 7V4m4 12v-5m4 5V7',
                    'from-sky-500 to-blue-600',
                ],
                [
                    'Cashback & rewards',
                    'Har purchase par coins wapas milte hain, aur attendance ya grades par bonus coins — padhai ka faida.',
                    'M12 3l2.6 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.3 2.9 1-6.1L3.3 9.5l6.1-.9z',
                    'from-fuchsia-500 to-pink-500',
                ],
                [
                    'Fees, fines & events',
                    'Semester fee, library fine, society tickets — sab kuch ek hi balance se, cash counter ki line ke bina.',
                    'M4 6h16v12H4zM4 10h16M8 15h4',
                    'from-slate-700 to-slate-900',
                ],
            ] as [$title, $desc, $icon, $tone])
                <article class="cc-reveal group relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-transparent hover:shadow-2xl hover:shadow-slate-900/10">
                    <span class="pointer-events-none absolute inset-x-0 -top-px h-px bg-gradient-to-r from-transparent via-indigo-500/60 to-transparent opacity-0 transition group-hover:opacity-100"></span>
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-gradient-to-br {{ $tone }} shadow-lg shadow-slate-900/10">
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold tracking-tight text-slate-900">{{ $title }}</h3>
                    <p class="mt-2.5 text-[14.5px] leading-relaxed text-slate-600">{{ $desc }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     5. HOW IT WORKS
     ============================================================ --}}
<section id="how-it-works" class="relative scroll-mt-24 overflow-hidden bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cc-reveal mx-auto max-w-2xl text-center">
            <p class="text-[13px] font-extrabold uppercase tracking-[0.18em] text-indigo-600">How it works</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Teen step, aur kaam khatam</h2>
            <p class="mt-4 text-[16px] leading-relaxed text-slate-600">Setup mein sirf 2 minute lagte hain — na koi paperwork, na koi fees.</p>
        </div>

        <div class="relative mt-16">
            {{-- dashed connector (desktop) --}}
            <div class="pointer-events-none absolute left-[16%] right-[16%] top-10 hidden border-t-2 border-dashed border-slate-200 lg:block"></div>

            <div class="grid gap-10 lg:grid-cols-3 lg:gap-8">
                @foreach ([
                    [
                        '01',
                        'Account banayein',
                        'Student ID ya university email se sign up karein. Verification ke baad wallet 30 second mein active.',
                        'M16 20v-1a4 4 0 00-4-4H8a4 4 0 00-4 4v1M10 11a4 4 0 100-8 4 4 0 000 8zM20 8v6M17 11h6',
                    ],
                    [
                        '02',
                        'Coins top-up karein',
                        'Campus counter, bank transfer ya parent card se balance add karein. Har top-up ki receipt app mein save hoti hai.',
                        'M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6',
                    ],
                    [
                        '03',
                        'Tap aur pay',
                        'Vendor ke QR par scan karein aur confirm. Payment instant, receipt automatic — chahe canteen ho ya library.',
                        'M12 3v3M12 18v3M3 12h3M18 12h3M7.5 7.5l2 2M14.5 14.5l2 2M16.5 7.5l-2 2M9.5 14.5l-2 2M12 9a3 3 0 100 6 3 3 0 000-6z',
                    ],
                ] as [$step, $title, $desc, $icon])
                    <div class="cc-reveal relative text-center">
                        <div class="relative mx-auto grid h-20 w-20 place-items-center rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5">
                            <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                            <span class="absolute -right-2 -top-2 grid h-8 w-8 place-items-center rounded-full bg-gradient-to-br from-indigo-600 to-violet-600 text-[11px] font-extrabold text-white shadow-lg shadow-indigo-600/30">{{ $step }}</span>
                        </div>
                        <h3 class="mt-6 text-lg font-extrabold tracking-tight text-slate-900">{{ $title }}</h3>
                        <p class="mx-auto mt-2.5 max-w-sm text-[14.5px] leading-relaxed text-slate-600">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     6. FOR VENDORS (dark section)
     ============================================================ --}}
<section id="vendors" class="relative scroll-mt-24 overflow-hidden bg-slate-950 py-24 text-white">
    <div class="pointer-events-none absolute -left-24 top-10 h-80 w-80 rounded-full bg-indigo-600/25 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-amber-500/15 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        {{-- copy --}}
        <div class="cc-reveal">
            <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-1.5 text-[13px] font-bold text-indigo-200">
                For canteens & campus vendors
            </span>
            <h2 class="mt-5 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">
                Zyada customers,<br>zero cash handling.
            </h2>
            <p class="mt-5 max-w-lg text-[16px] leading-relaxed text-slate-300">
                Counter par change dhoondne ka kaam khatam. Vendors ko har payment ka receipt, daily settlement aur
                sales report automatically mil jati hai.
            </p>

            <ul class="mt-8 grid gap-3.5">
                @foreach ([
                    'Payment direct aap ke bank account mein — next-day settlement',
                    'Koi POS machine ya extra hardware nahi, sirf ek QR code',
                    'Real-time sales, refund aur refund-report dashboard',
                    'Sirf 1.5% transaction fee — koi monthly charge nahi',
                ] as $point)
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 grid h-5.5 w-5.5 shrink-0 place-items-center rounded-full bg-emerald-500/15 text-emerald-400 ring-1 ring-inset ring-emerald-500/30">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        <span class="text-[15px] font-medium text-slate-200">{{ $point }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-9 flex flex-wrap items-center gap-3">
                <a href="#cta" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-[15px] font-bold text-slate-900 transition hover:-translate-y-0.5 hover:bg-slate-100">
                    Become a partner
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
                <a href="#" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 text-[15px] font-bold text-white transition hover:bg-white/10">
                    Fee structure dekhein
                </a>
            </div>
        </div>

        {{-- dashboard mockup --}}
        <div class="cc-reveal" style="transition-delay:.1s">
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-2.5 shadow-2xl backdrop-blur">
                <div class="rounded-[1.6rem] bg-white p-6 text-slate-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Today's revenue</p>
                            <p class="mt-1 text-2xl font-extrabold tracking-tight">PKR 18,450</p>
                        </div>
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-extrabold text-emerald-600">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
                            12.4%
                        </span>
                    </div>

                    {{-- bar chart --}}
                    <div class="mt-6 flex h-32 items-end gap-2.5">
                        @foreach ([38, 55, 42, 70, 88, 62, 96] as $index => $height)
                            <div class="flex flex-1 flex-col items-center gap-2">
                                <div class="cc-bar w-full {{ $index === 6 ? '' : 'opacity-45' }}" style="height: {{ $height }}%"></div>
                                <span class="text-[9px] font-bold text-slate-400">{{ ['M','T','W','T','F','S','S'][$index] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-5">
                        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Live orders</p>
                        <div class="mt-3 grid gap-2.5">
                            @foreach ([
                                ['#CC-9041', 'Chicken roll × 2', '120 CC', 'Paid'],
                                ['#CC-9040', 'Tea + samosa', '55 CC', 'Paid'],
                                ['#CC-9039', 'Photocopy 24 pages', '48 CC', 'Pending'],
                            ] as [$id, $item, $amount, $status])
                                <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                                    <div>
                                        <p class="text-[12px] font-extrabold text-slate-800">{{ $item }}</p>
                                        <p class="text-[10px] font-medium text-slate-400">{{ $id }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[12px] font-extrabold text-slate-900">{{ $amount }}</p>
                                        <p class="text-[10px] font-bold {{ $status === 'Paid' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $status }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     7. SECURITY
     ============================================================ --}}
<section id="security" class="scroll-mt-24 bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cc-reveal mx-auto max-w-2xl text-center">
            <p class="text-[13px] font-extrabold uppercase tracking-[0.18em] text-indigo-600">Security & control</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Paisa safe, control aap ke haath mein</h2>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-3">
            @foreach ([
                ['Bank-grade encryption', 'Har transaction 256-bit encryption aur tokenised QR se hoti hai. Card details hum store nahi karte.'],
                ['Limits, alerts & PIN', 'Daily limit, per-transaction PIN aur instant SMS/email alert — kuch ghalat ho to foran pata chal jata hai.'],
                ['Instant freeze', 'Wallet gum ho jaye? App se ek tap mein freeze karein aur balance agli subah tak wapas mil jata hai.'],
            ] as [$title, $desc])
                <div class="cc-reveal rounded-3xl border border-slate-200/80 bg-slate-50/70 p-7">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3l7.5 3v6c0 4.5-3.1 8.3-7.5 9.5C7.6 20.3 4.5 16.5 4.5 12V6z"/><path d="M9.2 12.2l2 2 3.6-3.9"/>
                        </svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold tracking-tight text-slate-900">{{ $title }}</h3>
                    <p class="mt-2.5 text-[14.5px] leading-relaxed text-slate-600">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     8. TESTIMONIALS
     ============================================================ --}}
<section class="bg-slate-50 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cc-reveal mx-auto max-w-2xl text-center">
            <p class="text-[13px] font-extrabold uppercase tracking-[0.18em] text-indigo-600">Loved on campus</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Students aur vendors kya kehte hain</h2>
        </div>

        <div class="mt-14 grid gap-6 lg:grid-cols-3">
            @foreach ([
                ['"Canteen ki line se meri 15 minute ki class nikal jati thi. Ab QR scan karke 5 second mein chalay jata hoon — aur cashback bhi milta hai."', 'Ayesha K.', 'BSCS 4th semester', 'bg-indigo-500'],
                ['"Monthly budget app mein set kar diya hai, is liye mahine ke aakhir mein paise khatam nahi hote. Parents ko bhi alert jata hai."', 'Hassan R.', 'BBA 2nd semester', 'bg-emerald-500'],
                ['"Pehle din ke 500 ka change sambhalna parta tha. Ab counter par sirf QR hai — sales report bhi automatic aa jati hai."', 'Uncle Imran', 'Campus canteen owner', 'bg-amber-500'],
            ] as [$quote, $name, $role, $tone])
                <figure class="cc-reveal flex flex-col rounded-3xl border border-slate-200/80 bg-white p-7 shadow-sm">
                    <div class="flex gap-1 text-amber-400">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8-5.2-2.7-5.2 2.7 1-5.8L1.5 7.7l5.9-.9z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="mt-5 flex-1 text-[15px] font-medium leading-relaxed text-slate-700">{{ $quote }}</blockquote>
                    <figcaption class="mt-6 flex items-center gap-3 border-t border-slate-100 pt-5">
                        <span class="grid h-10 w-10 place-items-center rounded-full {{ $tone }} text-sm font-bold text-white">{{ substr($name, 0, 1) }}</span>
                        <span>
                            <span class="block text-sm font-extrabold text-slate-900">{{ $name }}</span>
                            <span class="block text-xs font-medium text-slate-500">{{ $role }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     9. FAQ
     ============================================================ --}}
<section id="faq" class="scroll-mt-24 bg-white py-24">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="cc-reveal text-center">
            <p class="text-[13px] font-extrabold uppercase tracking-[0.18em] text-indigo-600">FAQ</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Aksar poochhe jane wale sawalat</h2>
        </div>

        <div class="mt-12 grid gap-3">
            @foreach ([
                ['Campus Coin use karne ki fees kitni hai?', 'Students ke liye app bilkul free hai — account kholna, top-up karna aur pay karna, sab free. Vendors se sirf 1.5% transaction fee li jati hai, koi monthly charge nahi.'],
                ['Balance add karne ke kaunse tareeqe hain?', 'Campus top-up counter, bank transfer / Raast, parent card aur selected campuses mein auto top-up. Har top-up ki receipt app mein aur email par aa jati hai.'],
                ['Internet na ho to payment ho sakti hai?', 'Ji haan. Offline mode mein QR ek signed voucher ban jata hai, jo internet wapas aane par automatically settle ho jata hai.'],
                ['Wallet gum ho jaye ya phone chori ho jaye?', 'Kisi bhi device se sign in karke wallet turant freeze karein. Verified complaint ke baad remaining balance 24 ghante mein recover ho jata hai.'],
                ['Kya meri university Campus Coin support karti hai?', '40+ campuses already live hain. Apni university ka naam signup form mein likh dein — hum onboarding team ko forward kar dete hain.'],
            ] as [$question, $answer])
                <details class="cc-faq cc-reveal group rounded-2xl border border-slate-200 bg-white px-5 py-4 transition hover:border-indigo-200 open:border-indigo-200 open:bg-indigo-50/30">
                    <summary class="flex cursor-pointer items-center justify-between gap-4">
                        <span class="cc-faq-q text-[15px] font-extrabold text-slate-900 transition">{{ $question }}</span>
                        <span class="cc-faq-icon grid h-7 w-7 shrink-0 place-items-center rounded-full bg-slate-100 text-slate-600 transition group-open:bg-indigo-600 group-open:text-white">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                        </span>
                    </summary>
                    <p class="mt-3 pr-8 text-[14.5px] leading-relaxed text-slate-600">{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     10. FINAL CTA
     ============================================================ --}}
<section id="cta" class="scroll-mt-24 bg-white px-4 pb-24 sm:px-6 lg:px-8">
    <div class="cc-reveal relative mx-auto max-w-7xl overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-indigo-600 via-violet-600 to-indigo-700 px-8 py-16 text-center shadow-2xl shadow-indigo-600/25 sm:px-14">
        <div class="pointer-events-none absolute -left-16 -top-20 h-72 w-72 rounded-full bg-white/10"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-10 h-80 w-80 rounded-full bg-amber-400/20"></div>

        <div class="relative mx-auto max-w-2xl">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-[12px] font-extrabold uppercase tracking-widest text-white ring-1 ring-inset ring-white/25">
                Free for students
            </span>
            <h2 class="mt-6 text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl">
                Aaj hi apna Campus Coin wallet banayein
            </h2>
            <p class="mt-4 text-[16px] leading-relaxed text-indigo-100">
                2 minute ka setup. Na koi paperwork, na koi hidden charge. Sign up karein aur pehle top-up par 100 bonus coins paayein.
            </p>

            <form class="mx-auto mt-9 flex max-w-lg flex-col gap-3 sm:flex-row" action="#" method="POST" onsubmit="return false;">
                @csrf
                <label class="sr-only" for="email">University email</label>
                <input id="email" name="email" type="email" required placeholder="aapka.naam@university.edu.pk"
                       class="w-full rounded-full border-0 bg-white/95 px-5 py-3.5 text-[15px] font-medium text-slate-900 placeholder:text-slate-400 shadow-lg focus:ring-4 focus:ring-white/40">
                <button type="submit" class="shrink-0 rounded-full bg-slate-950 px-7 py-3.5 text-[15px] font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-slate-800">
                    Get started
                </button>
            </form>

            <p class="mt-4 text-[13px] font-medium text-indigo-200">No credit card required · Cancel anytime</p>
        </div>
    </div>
</section>
</main>

{{-- ============================================================
     11. FOOTER
     ============================================================ --}}
<footer class="bg-slate-950 pt-16 text-slate-400">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 pb-14 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
            {{-- brand --}}
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600">
                        <svg class="h-5 w-5 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 6.5v11M15 9.2a3 3 0 00-3-1.2h-1a2 2 0 000 4h1.8a2 2 0 010 4H11a3 3 0 01-3-1.2" />
                        </svg>
                    </span>
                    <span class="text-[19px] font-extrabold tracking-tight text-white">Campus<span class="text-indigo-400">Coin</span></span>
                </div>
                <p class="mt-5 max-w-xs text-[14.5px] leading-relaxed">
                    Campus ka apna digital currency — students, canteens aur universities ke liye banaya gaya ek simple cashless system.
                </p>

                <div class="mt-6 flex gap-2.5">
                    @foreach (['facebook', 'instagram', 'x', 'linkedin'] as $social)
                        <a href="#" aria-label="{{ $social }}" class="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/5 text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white">
                            @if ($social === 'facebook')
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 9H16V6h-2.5A4.5 4.5 0 009 10.5V13H7v3h2v6h3v-6h2.2l.6-3H12v-2.2c0-.5.3-.8.8-.8z"/></svg>
                            @elseif ($social === 'instagram')
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>
                            @elseif ($social === 'x')
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h4l4 5.5L16.5 4H20l-6.4 8.1L20.5 20h-4l-4.3-5.9L7.5 20H4l6.7-8.5z"/></svg>
                            @else
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6.5 8.5H3.8V20h2.7zM5.1 3.6a1.6 1.6 0 100 3.2 1.6 1.6 0 000-3.2zM20.2 20h-2.7v-6c0-1.5-.6-2.3-1.7-2.3-1 0-1.6.7-1.6 2.3v6H11.5V8.5h2.7v1.2a3 3 0 012.7-1.4c2 0 3.3 1.3 3.3 4z"/></svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- link columns --}}
            @foreach ([
                ['Product', [['Features', '#features'], ['How it works', '#how-it-works'], ['For vendors', '#vendors'], ['Security', '#security']]],
                ['Company', [['About us', '#'], ['Careers', '#'], ['Campus partners', '#'], ['Press kit', '#']]],
                ['Support', [['Help centre', '#'], ['Contact', '#'], ['FAQ', '#faq'], ['Terms & privacy', '#']]],
            ] as [$heading, $links])
                <div>
                    <p class="text-[13px] font-extrabold uppercase tracking-wider text-white">{{ $heading }}</p>
                    <ul class="mt-5 grid gap-3">
                        @foreach ($links as [$label, $href])
                            <li><a href="{{ $href }}" class="text-[14.5px] font-medium transition hover:text-white">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="flex flex-col items-center justify-between gap-4 border-t border-white/10 py-7 sm:flex-row">
            <p class="text-[13.5px] font-medium">© {{ date('Y') }} Campus Coin. All rights reserved.</p>
            <p class="flex items-center gap-2 text-[13.5px] font-medium">
                Made with <span class="text-rose-500">♥</span> in Pakistan
                <span class="text-slate-700">·</span>
                <a href="mailto:hello&#64;campuscoin.app" class="transition hover:text-white">hello&#64;campuscoin.app</a>
            </p>
        </div>
    </div>
</footer>

{{-- Back to top --}}
<button id="to-top" type="button" aria-label="Back to top"
        class="fixed bottom-6 right-6 z-40 hidden h-11 w-11 place-items-center rounded-full bg-slate-900 text-white shadow-xl transition hover:-translate-y-0.5 hover:bg-slate-800">
    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>

{{-- ============================================================
     PAGE SCRIPTS (mobile menu, reveal on scroll, counter, back-to-top)
     ============================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* 1) Mobile menu toggle */
    var btn = document.getElementById('menu-btn');
    var menu = document.getElementById('mobile-menu');
    var iconOpen = document.getElementById('icon-open');
    var iconClose = document.getElementById('icon-close');

    if (btn && menu) {
        btn.addEventListener('click', function () {
            var isOpen = !menu.classList.contains('hidden');
            menu.classList.toggle('hidden', isOpen);
            iconOpen.classList.toggle('hidden', !isOpen);
            iconClose.classList.toggle('hidden', isOpen);
            btn.setAttribute('aria-expanded', String(!isOpen));
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.add('hidden');
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* 2) Reveal on scroll */
    var revealItems = document.querySelectorAll('.cc-reveal');
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        revealItems.forEach(function (item) { observer.observe(item); });
    } else {
        revealItems.forEach(function (item) { item.classList.add('is-in'); });
    }

    /* 3) Animated stat counters */
    var stats = document.querySelectorAll('[data-cc-count]');
    var animate = function (el) {
        var raw = el.textContent.trim();
        var number = parseFloat(raw.replace(/[^0-9.]/g, ''));
        if (!number) { return; }

        var suffix = raw.replace(/[0-9.,]/g, '').trim();   // like '+' or 'M'
        var decimals = (raw.split('.')[1] || '').replace(/[^0-9]/g, '').length;
        var start = null;
        var duration = 1400;

        var tick = function (timestamp) {
            if (!start) { start = timestamp; }
            var progress = Math.min((timestamp - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = number * eased;
            var text = decimals ? current.toFixed(decimals) : Math.round(current).toLocaleString('en-US');
            el.textContent = text + (suffix ? suffix : '');
            if (progress < 1) { requestAnimationFrame(tick); }
        };
        requestAnimationFrame(tick);
    };

    if ('IntersectionObserver' in window) {
        var statObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    statObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.6 });
        stats.forEach(function (stat) { statObserver.observe(stat); });
    }

    /* 4) Header shadow + back-to-top visibility */
    var header = document.getElementById('site-header');
    var toTop = document.getElementById('to-top');

    var onScroll = function () {
        var y = window.scrollY;
        if (header) { header.classList.toggle('shadow-lg', y > 8); header.classList.toggle('shadow-slate-900/5', y > 8); }
        if (toTop) { toTop.classList.toggle('hidden', y < 600); toTop.classList.toggle('grid', y >= 600); }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (toTop) {
        toTop.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }
});
</script>
</body>
</html>
