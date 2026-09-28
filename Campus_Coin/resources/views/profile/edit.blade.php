@extends('layouts.student')

@section('title', 'Profile & preferences')

@section('content')
<div class="mb-4">
    <div class="small text-primary fw-bold">YOUR ACCOUNT</div>
    <h1 class="h2 fw-bold mb-1">Profile & preferences</h1>
    <p class="muted mb-0">Apni student details aur savings goals manage karein.</p>
</div>

@if (session('status') === 'profile-updated')
    <div class="alert alert-success">Profile successfully updated.</div>
@endif

<div class="row g-3">
    <div class="col-lg-8">
        <section class="panel">
            <h2 class="h5 fw-bold">Personal information</h2>
            <p class="muted small">Yeh information aapke Campus Coin account ke saath save hogi.</p>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="name">Full name</label>
                        <input id="name" name="name" class="form-control"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="email">Email address</label>
                        <input id="email" name="email" type="email" class="form-control"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="academic_year">Academic year</label>
                        <select id="academic_year" name="academic_year" class="form-select" required>
                            <option value="">Select your year</option>
                            @foreach (['Year 1 (Freshman)', 'Year 2 (Sophomore)', 'Year 3 (Junior)', 'Year 4 (Senior)', 'Postgraduate'] as $year)
                                <option value="{{ $year }}"
                                    @selected(old('academic_year', $user->academic_year) === $year)>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="allowance_baseline">
                            Monthly allowance (PKR)
                        </label>
                        <input id="allowance_baseline" name="allowance_baseline"
                               type="number" min="0" step="0.01" class="form-control"
                               value="{{ old('allowance_baseline', $user->allowance_baseline ?? 0) }}" required>
                        @error('allowance_baseline') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="savings_goal">Monthly savings goal (PKR)</label>
                        <input id="savings_goal" name="savings_goal" type="number"
                               min="0" step="0.01" class="form-control"
                               value="{{ old('savings_goal', $user->savings_goal ?? 0) }}" required>
                        @error('savings_goal') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button class="btn btn-primary">Save profile</button>
                </div>
            </form>
        </section>
    </div>

    <div class="col-lg-4">
        <section class="panel h-100">
            <div class="small text-primary fw-bold mb-2">PRIVACY</div>
            <h2 class="h5 fw-bold">Your account, your records</h2>
            <p class="muted mb-0">
                Campus Coin does not connect to a bank. Your allowance and savings goal
                are profile information; transactions are records you enter yourself.
            </p>
        </section>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-6">
        <section class="panel">
            <h2 class="h5 fw-bold">Update password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="current_password">Current password</label>
                    <input id="current_password" name="current_password" type="password"
                           class="form-control" required autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">New password</label>
                    <input id="password" name="password" type="password"
                           class="form-control" required autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirm new password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="form-control" required autocomplete="new-password">
                </div>

                <button class="btn btn-outline-primary">Update password</button>
            </form>
        </section>
    </div>

    <div class="col-lg-6">
        <section class="panel border-danger-subtle">
            <h2 class="h5 fw-bold text-danger">Delete account</h2>
            <p class="muted">Account delete karne se aapke records bhi permanently remove ho jayenge.</p>

            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('Account aur uske records permanently delete karne hain?')">
                @csrf
                @method('DELETE')

                <label class="form-label" for="delete_password">Confirm with your password</label>
                <input id="delete_password" name="password" type="password"
                       class="form-control mb-3" required>

                <button class="btn btn-outline-danger">Delete account</button>
            </form>
        </section>
    </div>
</div>
@endsection