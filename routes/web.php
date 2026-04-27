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
use App\Http\Controllers\Kader\PencegahanController;
use App\Http\Controllers\Kader\LayananController;
use App\Http\Controllers\Kader\InformasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Kader\GaleriController as KaderGaleriController;


// =====================
// FRONTEND (PUBLIC)
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔥 WAJIB ADA & DI LUAR SEMUA GROUP
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');


// =====================
// AUTH
// =====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================
// PROTECTED (LOGIN)
// =====================
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard/kader', [DashboardController::class, 'index'])->name('dashboard.kader');
    Route::get('/dashboard-ortu', [OrangtuaController::class, 'dashboard'])->name('dashboard.orangtua');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // =====================
    // BALITA
    // =====================
    Route::resource('kader/balita', BalitaController::class);
    Route::get('/balita/{id}/download', [BalitaController::class, 'download'])->name('balita.download');


    // =====================
    // PENIMBANGAN
    // =====================
    Route::resource('penimbangan', PenimbanganController::class);


    // =====================
    // KADER AREA
    // =====================
    Route::prefix('kader')->name('kader.')->group(function () {

        // TENTANG
        Route::resource('tentang', TentangController::class);

        // PENCEGAHAN
        Route::resource('pencegahan', PencegahanController::class);

        // LAYANAN
        Route::resource('layanan', LayananController::class);

        // INFORMASI
        Route::resource('informasi', InformasiController::class);

        // 🔥 GALERI (INI SAJA, JANGAN DUPLIKAT)
        Route::resource('galeri', KaderGaleriController::class);

        // =====================
        // SLIDER
        // =====================
        Route::get('/slider', [SliderController::class,'index'])->name('slider.index');
        Route::get('/slider/create', [SliderController::class,'create'])->name('slider.create');
        Route::post('/slider/store', [SliderController::class,'store'])->name('slider.store');
        Route::get('/slider/edit/{id}', [SliderController::class,'edit'])->name('slider.edit');
        Route::put('/slider/update/{id}', [SliderController::class,'update'])->name('slider.update');
        Route::delete('/slider/delete/{id}', [SliderController::class,'destroy'])->name('slider.delete');

    });

});