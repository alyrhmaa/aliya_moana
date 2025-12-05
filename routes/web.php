<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// =====================
// ROUTE TANPA LOGIN
// =====================

// Halaman login (TIDAK BOLEH PAKAI MIDDLEWARE checkislogin)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Logout (boleh di luar atau dalam middleware)
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


// =====================
// ROUTE WAJIB LOGIN
// =====================

Route::middleware(['checkislogin'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Route bawaan modul
    Route::middleware('auth')->group(function () {

        Route::get('/pcr', function () {
            return 'Selamat Datang di Website Kampus PCR!';
        });

        Route::get('/mahasiswa', function () {
            return 'Halo Mahasiswa';
        })->name('mahasiswa.show');

        Route::get('/nama/{param1}', function ($param1) {
            return 'Nama saya: ' . $param1;
        });

        Route::get('/nim/{param1?}', function ($param1 = '') {
            return 'NIM saya: ' . $param1;
        });

        Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

        Route::get('/about', function () {
            return view('halaman-about');
        });

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/pegawai', [PegawaiController::class, 'index']);

        Route::post('question/store', [QuestionController::class, 'store'])
            ->name('question.store');

        Route::resource('pelanggan', PelangganController::class);

        Route::post('pelanggan/{id}/upload-files', [PelangganController::class, 'uploadFiles'])
            ->name('pelanggan.upload-files');

        Route::delete('pelanggan/{id}/delete-file/{fileId}', [PelangganController::class, 'deleteFile'])
            ->name('pelanggan.delete-file');

        // =====================
        // ROUTE KHUSUS SUPER ADMIN
        // =====================
        Route::middleware(['checkrole:superadmin'])->group(function () {
            Route::resource('user', UserController::class);
        });

    });

});
