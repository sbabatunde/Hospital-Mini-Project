<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Public routes
    Route::get('/', fn() => view('welcome'));
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    // Authenticated
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    });

    Route::middleware(['role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', fn() => view('doctor.dashboard'))->name('doctor.dashboard');
    });

    Route::middleware(['role:client'])->group(function () {
        Route::get('/client/dashboard', fn() => view('client.dashboard'))->name('client.dashboard');
    });
});

require __DIR__ . '/auth.php';
