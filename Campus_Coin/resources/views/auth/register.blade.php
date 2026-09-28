<x-guest-layout>
    <div class="auth-kicker">Student access</div>
    <h1>Create your student account</h1>
    <p class="text-secondary mb-4">Start with your student details and add your own records.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Full name</label>
            <input id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email address</label>
            <input id="email" name="email" type="email" class="form-control"
                   value="{{ old('email') }}" required autocomplete="username">
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="academic_year" class="form-label fw-semibold">Academic year</label>
            <select id="academic_year" name="academic_year" class="form-select" required>
                <option value="">Select your year</option>
                @foreach (['Year 1 (Freshman)', 'Year 2 (Sophomore)', 'Year 3 (Junior)', 'Year 4 (Senior)', 'Postgraduate'] as $year)
                    <option value="{{ $year }}" @selected(old('academic_year') === $year)>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            @error('academic_year') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label for="allowance_baseline" class="form-label fw-semibold">Monthly allowance (PKR)</label>
                <input id="allowance_baseline" name="allowance_baseline"
                       type="number" min="0" step="0.01" class="form-control"
                       value="{{ old('allowance_baseline', 0) }}" required>
                @error('allowance_baseline') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="col-sm-6">
                <label for="savings_goal" class="form-label fw-semibold">Savings goal (PKR)</label>
                <input id="savings_goal" name="savings_goal" type="number"
                       min="0" step="0.01" class="form-control"
                       value="{{ old('savings_goal', 0) }}" required>
                @error('savings_goal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" name="password" type="password"
                   class="form-control" required autocomplete="new-password">
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="form-control" required autocomplete="new-password">
        </div>

        <button class="btn auth-submit w-100" type="submit">Create account</button>
    </form>

    <p class="text-center small text-secondary mt-4 mb-0">
        Already registered?
        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">Log in</a>
    </p>
</x-guest-layout>