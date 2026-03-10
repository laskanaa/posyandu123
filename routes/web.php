<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\Kader\SliderController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Kader\TentangController;
use App\Http\Controllers\Kader\SpmController;
use App\Http\Controllers\Kader\LayananController;

Route::prefix('kader')->middleware(['auth'])->group(function () {

    Route::resource('tentang', TentangController::class)->names('kader.tentang');

    Route::resource('spm', SpmController::class)->names('kader.spm');

    Route::resource('layanan', LayananController::class)->names('kader.layanan');

});


// =====================
// HOME
// =====================
Route::get('/', [HomeController::class, 'index']);


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

    // BALITA
    Route::resource('kader/balita', BalitaController::class);

    // PENIMBANGAN
    Route::resource('penimbangan', PenimbanganController::class);

    // SLIDER
    Route::prefix('kader')->name('kader.')->group(function () {

        Route::get('/slider', [SliderController::class,'index'])->name('slider.index');
        Route::get('/slider/create', [SliderController::class,'create'])->name('slider.create');
        Route::post('/slider/store', [SliderController::class,'store'])->name('slider.store');
        Route::get('/slider/edit/{id}', [SliderController::class,'edit'])->name('slider.edit');
        Route::put('/slider/update/{id}', [SliderController::class,'update'])->name('slider.update');
        Route::delete('/slider/delete/{id}', [SliderController::class,'destroy'])->name('slider.delete');

    });

    // DASHBOARD ORANG TUA
    Route::get('/dashboard-ortu', [OrangtuaController::class, 'dashboard'])
        ->name('dashboard.orangtua');

});