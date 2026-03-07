<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenimbanganController;

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
    Route::get('/dashboard/kader', [DashboardController::class, 'index'])
        ->name('dashboard.kader');
});

Route::middleware(['auth'])->group(function () {

    // Balita Manual Routes
    Route::get('/kader/balita', [BalitaController::class, 'index'])
        ->name('balita.index');

    Route::get('/kader/balita/create', [BalitaController::class, 'create'])
        ->name('balita.create');

    Route::resource('kader/balita', BalitaController::class);
        
    Route::post('/kader/balita/store', [BalitaController::class, 'store'])
        ->name('balita.store');

    Route::get('/kader/balita/{id}', [BalitaController::class, 'show'])
        ->name('balita.show');

    // Resource Routes
    Route::resource('balita', BalitaController::class);
    Route::resource('penimbangan', PenimbanganController::class);
});

// halaman orang tua
Route::get('/dashboard-ortu', function () {
    return "Login orang tua berhasil";
})->name('dashboard.orangtua');

Route::get('/dashboard-ortu', function () {
    return view('orangtua.dashboard');
})->name('dashboard.orangtua');

use App\Http\Controllers\OrangtuaController;

Route::get('/dashboard-ortu', [OrangtuaController::class, 'dashboard'])
    ->name('dashboard.orangtua')
    ->middleware('auth');

// =====================
// HOME ROUTE
// =====================
Route::get('/', function () {
    return view('pages.home');
});