<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\Kader\LayananController;
use App\Http\Controllers\Kader\PencegahanController;
use App\Http\Controllers\Kader\TentangController;
use App\Http\Controllers\Kader\InformasiController;
use App\Http\Controllers\Kader\DashboardController;
use App\Http\Controllers\Kader\SliderController;
use App\Http\Controllers\Kader\GaleriController as KaderGaleriController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard/kader', [DashboardController::class, 'index'])->name('dashboard.kader');
    Route::get('/dashboard-ortu', [OrangtuaController::class, 'dashboard'])->name('dashboard.orangtua');

    Route::resource('kader/balita', BalitaController::class);
    Route::get('/balita/{id}/download', [BalitaController::class, 'download'])->name('balita.download');
    Route::resource('penimbangan', PenimbanganController::class);

    Route::prefix('kader')->name('kader.')->group(function () {
        Route::resource('tentang', TentangController::class);
        Route::resource('pencegahan', PencegahanController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('informasi', InformasiController::class);
        Route::resource('galeri', KaderGaleriController::class);

        Route::controller(SliderController::class)->prefix('slider')->name('slider.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('delete');
        });
    });
});