<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\AuthController;

// =====================
// AUTH ROUTES
// =====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// ROUTES MIDDLEWARE AUTH
// =====================
Route::middleware(['auth'])->group(function () {

    // Dashboard Kader
    Route::get('/dashboard/kader', [DashboardController::class, 'index'])->name('dashboard.kader');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kader/balita', [BalitaController::class, 'index'])->name('balita.index');
    Route::get('/kader/balita/create', [BalitaController::class, 'create'])->name('balita.create');
    Route::post('/kader/balita/store', [BalitaController::class, 'store'])->name('balita.store');
    Route::get('/kader/balita/{id}', [BalitaController::class, 'show'])->name('balita.show');
});

// =====================
// HOME ROUTE
// =====================
Route::get('/', function () {
    return view('pages.home');
});