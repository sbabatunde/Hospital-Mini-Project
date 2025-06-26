<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on user role
        $role = auth()->user()->role;
        $name = auth()->user()->name;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard')->with('success', 'Login successful! Welcome' . $name),
            'doctor' => redirect()->route('doctor.dashboard')->with('success', 'Login successful! Welcome. <br> Dr. ' . $name),
            'client' => redirect()->route('client.dashboard')->with('success', 'Login successful! Welcome' . $name),
            default => redirect('/'),
        };
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
