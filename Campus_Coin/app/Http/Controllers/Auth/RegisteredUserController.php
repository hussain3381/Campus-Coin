<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
        'academic_year' => [
            'required',
            'in:Year 1 (Freshman),Year 2 (Sophomore),Year 3 (Junior),Year 4 (Senior),Postgraduate',
        ],
        'allowance_baseline' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        'savings_goal' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'academic_year' => $data['academic_year'],
        'allowance_baseline' => $data['allowance_baseline'],
        'savings_goal' => $data['savings_goal'],
        'password' => Hash::make($data['password']),
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
