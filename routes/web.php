<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Masyarakat
Route::get('/', [UserController::class, 'index'])->name('laporma.index');

Route::middleware(['isMasyarakat'])->group(function () {
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('laporma.store');
    Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('laporma.laporan');
    Route::get('/logout', [UserController::class, 'logout'])->name('laporma.logout');

});

Route::middleware(['guest'])->group(function () {
    //login
    Route::get('/login', [UserController::class, 'formLogin'])->name('laporma.formLogin');
    Route::post('/login/auth', [UserController::class, 'login'])->name('laporma.login');
    //register
    Route::get('/register', [UserController::class, 'formRegister'])->name('laporma.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('laporma.register');
});

//Petugas
Route::prefix('admin')->group(function () {

    Route::middleware(['isAdmin'])->group(function () {

        // petugas
        Route::resource('petugas', PetugasController::class);

        //masyarakat
        Route::resource('masyarakat', MasyarakatController::class);

        //laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');
    });

    Route::middleware(['isPetugas'])->group(function () {
        //Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        //pengaduan
        Route::resource('pengaduan', PengaduanController::class);

        //Tanggapan
        Route::post('tanggapan/createOrUpdate', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');

        //logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });
});
