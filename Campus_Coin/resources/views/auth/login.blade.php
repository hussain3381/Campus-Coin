<x-guest-layout>
    <div class="auth-kicker">Student access</div>
    <h1>Welcome back</h1>
    <p class="text-secondary mb-4">Continue to your Campus Coin workspace.</p>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email address</label>
            <input id="email" name="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" name="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" name="remember">
                <span class="form-check-label small">Remember me</span>
            </label>

            <a href="{{ route('password.request') }}" class="small text-decoration-none">
                Forgot password?
            </a>
        </div>

        <button class="btn auth-submit w-100" type="submit">Log in</button>
    </form>

    <p class="text-center small text-secondary mt-4 mb-0">
        New to Campus Coin?
        <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">
            Create account
        </a>
    </p>
</x-guest-layout>