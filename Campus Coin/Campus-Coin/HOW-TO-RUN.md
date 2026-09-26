# Campus Coin — Landing (Index) Page kaise chalayein

Is page ka poora code Laravel 12 + Blade + Tailwind CSS 4 mein hai.

## Kya kya files add / change hui hain

| File | Kaam |
|------|------|
| `resources/views/landing.blade.php` | Poora landing (index) page — HTML + Tailwind + JS, sab isi ek file mein |
| `routes/web.php` | `/` route ab `landing` view return karta hai |

---

## 1. Project folder mein jayein

```bash
cd "Campus Coin/Campus-Coin"
```

## 2. PHP dependencies install karein (sirf pehli baar)

```bash
composer install
```

## 3. `.env` file banayein (sirf pehli baar)

```bash
cp .env.example .env
php artisan key:generate
```

> Windows (XAMPP) par: `copy .env.example .env`

## 4. Frontend assets (Tailwind) build karein — zaroori hai

```bash
npm install
npm run build
```

Dev ke waqt live changes dekhne ke liye (recommended):

```bash
npm run dev
```

## 5. Server chalayein

```bash
php artisan serve
```

Ya XAMPP mein: project ko `htdocs` mein rakhein aur browser mein `http://localhost/Campus-Coin/public` kholein.

Ab browser mein kholein 👉 `http://127.0.0.1:8000`

---

## Roz-marra ka kaam (development)

Do terminal kholein:

```bash
# Terminal 1
php artisan serve

# Terminal 2  (Tailwind watch mode — CSS turant update hoti hai)
npm run dev
```

Agar aap ne `npm run dev` chalaya hua hai to page par koi bhi class ya text change karein, refresh par nazar aa jayega.

---

## Text / colour / content edit karna

Sab kuch `resources/views/landing.blade.php` mein hai:

- **Headings aur text**: file ke andar seedha text badal dein.
- **Features / steps / reviews / FAQ**: in sab ki list ek `@foreach ([ ... ])` array mein hai — bas us array ke andar strings badal dein, page automatically update ho jata hai.
- **Colours / theme**: file ke `<style>` block mein top par ye variables hain:

```css
:root { --cc-indigo: #4f46e5; --cc-violet: #7c3aed; --cc-amber: #f59e0b; }
```

- **Logo text**: navbar aur footer mein `Campus<span>Coin</span>` likha hai.

---

## Page ke sections (order)

1. Top announcement bar
2. Sticky navbar (mobile menu ke saath)
3. Hero — headline, CTA buttons, students ka social proof
4. Phone mockup (wallet balance, recent activity, floating "payment successful" cards)
5. Stats strip (12,000+ students etc.)
6. Features grid (6 cards)
7. How it works (3 steps)
8. For vendors (dark section + dashboard mockup)
9. Security & control
10. Testimonials
11. FAQ (accordion)
12. Final CTA — email signup form
13. Footer + back-to-top button

---

## Signup form ko backend se jodna (baad mein)

Abhi form ka `action="#"` hai (frontend only). Jab controller banayein:

```php
// routes/web.php
Route::post('/signup', [SignupController::class, 'store'])->name('signup');
```

```html
<!-- landing.blade.php mein -->
<form action="{{ route('signup') }}" method="POST">
```

`@csrf` pehle se form ke andar mojood hai, is liye CSRF ka masla nahi aayega.

---

## Agar `npm run build` kaam na kare (emergency fallback)

Tab CSS ke liye Tailwind ka browser version use kar sakte hain — `</head>` se just pehle ye line daal dein aur `@vite(...)` line comment kar dein:

```html
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
```

> Ye sirf testing ke liye hai. Production mein hamesha `npm run build` hi use karein, warna page slow load hoga.

---

## Aage kya

- Baaki pages (login, dashboard, vendor panel) ke liye `resources/views/` mein naye `.blade.php` files banayein.
- Navbar/footer ko har page par repeat karne ki bajaye `resources/views/components/` ya `resources/views/layouts/app.blade.php` mein nikaal dein.
