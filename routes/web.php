<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfilePerusahaanController; // ← BARU

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES — siapa saja bisa akses
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('beranda'));

Route::get('/beranda',          [PublicController::class,          'beranda'])      ->name('beranda');
Route::get('/profil',           [ProfilePerusahaanController::class,'profilPublik']) ->name('profil');           // ← BARU
Route::get('/tentang',          [PublicController::class,          'tentang'])      ->name('tentang');
Route::get('/katalog',          [PublicController::class,          'katalog'])      ->name('katalog');
Route::get('/katalog/{produk}', [PublicController::class,          'detailProduk']) ->name('katalog.detail');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES — hanya untuk guest (belum login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Halaman login
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');

    // Proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES — harus sudah login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |------------------------------------------------------------------
    | DASHBOARD
    |------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |------------------------------------------------------------------
    | PROFILE — ganti password (semua role)
    |------------------------------------------------------------------
    */
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    /*
    |------------------------------------------------------------------
    | PROFILE PERUSAHAAN — semua role bisa akses          ← BARU
    |------------------------------------------------------------------
    */
    Route::get('/profile-perusahaan', [ProfilePerusahaanController::class, 'index'])
        ->name('profile-perusahaan.index');
    Route::put('/profile-perusahaan', [ProfilePerusahaanController::class, 'update'])
        ->name('profile-perusahaan.update');

    /*
    |------------------------------------------------------------------
    | KATEGORI — semua role bisa akses
    |------------------------------------------------------------------
    */
    Route::get   ('/kategori',            [KategoriController::class, 'index'])  ->name('kategori.index');
    Route::post  ('/kategori',            [KategoriController::class, 'store'])  ->name('kategori.store');
    Route::put   ('/kategori/{kategori}', [KategoriController::class, 'update']) ->name('kategori.update');
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    /*
    |------------------------------------------------------------------
    | PRODUK — semua role bisa akses
    |------------------------------------------------------------------
    */
    Route::get   ('/produk-admin',                 [ProdukController::class, 'index'])  ->name('produk.index');
    Route::post  ('/produk-admin',                 [ProdukController::class, 'store'])  ->name('produk.store');
    Route::get   ('/produk-admin/{produk}',        [ProdukController::class, 'show'])   ->name('produk.show');
    Route::get   ('/produk-admin/{produk}/detail', [ProdukController::class, 'show'])   ->name('produk.detail');
    Route::put   ('/produk-admin/{produk}',        [ProdukController::class, 'update']) ->name('produk.update');
    Route::delete('/produk-admin/{produk}',        [ProdukController::class, 'destroy'])->name('produk.destroy');

    /*
    |------------------------------------------------------------------
    | ADMIN MANAGEMENT — khusus superadmin
    |------------------------------------------------------------------
    */
    Route::middleware('superadmin')->group(function () {

        Route::get   ('/admins',        [AdminController::class, 'index'])  ->name('admins.index');
        Route::post  ('/admins',        [AdminController::class, 'store'])  ->name('admins.store');
        Route::put   ('/admins/{user}', [AdminController::class, 'update']) ->name('admins.update');
        Route::delete('/admins/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');

    });

    /*
    |------------------------------------------------------------------
    | LOGOUT
    |------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
