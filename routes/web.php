<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminDataDosenController;
use App\Http\Controllers\SuperAdminDataJurusanController;
use App\Http\Controllers\SuperAdminDataProdiController;
use App\Http\Controllers\SuperAdminDataMahasiswaController;
use App\Http\Controllers\SuperAdminJurusanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Dosen2Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDataDosenController;
use App\Http\Controllers\AdminDataJurusanController;
use App\Http\Controllers\AdminDataProdiController;
use App\Http\Controllers\AdminDataSuratController;
use App\Http\Controllers\AdminDataMahasiswaController;
use App\Http\Controllers\MahasiswaController;

// Example Routes
Route::view('/', 'landing');

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);

Route::get('/register',[registerController::class, 'index'])->middleware('guest');
Route::post('/register',[registerController::class, 'store']);

// Middleware untuk pengguna yang terautentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman dashboard umum untuk semua pengguna
    Route::get('/dashboard', function () {
        return view('dashboard'); // Halaman umum untuk semua pengguna
    });
    
    // Middleware untuk super admin
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/super_admin/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::resource('/super_admin/data-dosen', SuperAdminDataDosenController::class)->names('super_admin.data-dosen');
        Route::resource('/super_admin/data-jurusan', SuperAdminDataJurusanController::class)->names('super_admin.data-jurusan');
        Route::resource('/super_admin/data-prodi', SuperAdminDataProdiController::class)->names('super_admin.data-prodi');
        Route::resource('/super_admin/data-mahasiswa', SuperAdminDataMahasiswaController::class)->names('super_admin.data-mahasiswa');
        Route::resource('/super_admin/admin-jurusan', SuperAdminJurusanController::class)->names('super_admin.admin-jurusan');
    });

    // Middleware untuk mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/mahasiswa/dashboard/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa/dashboard', [MahasiswaController::class, 'store'])->name('mahasiswa.dashboard.store');
        Route::get('/mahasiswa/{username}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{username}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::get('/mahasiswa/dashboard/{id}/edit', [MahasiswaController::class, 'editSurat'])->name('mahasiswa.surat.edit');
        Route::put('/mahasiswa/dashboard/{id}', [MahasiswaController::class, 'updateSurat'])->name('mahasiswa.surat.update');
        Route::delete('/mahasiswa/dashboard/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.dashboard.destroy');
    });

    // Middleware untuk dosen
    Route::middleware(['role:dosen'])->group(function () {
        Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::get('/dosen/dashboard-2', [Dosen2Controller::class, 'index'])->name('dosen.dashboard-2');
        Route::get('/dosen/dashboard/{letter}', [DosenController::class, 'show'])->name('dosen.dashboard.show');
        Route::post('/dosen/dashboard/{letter}/approve', [DosenController::class, 'approve'])->name('dosen.dashboard.approve');
        Route::post('/dosen/dashboard/{letter}/reject', [DosenController::class, 'reject'])->name('dosen.dashboard.reject');
        Route::get('/dosen/{username}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/dosen/{username}', [DosenController::class, 'update'])->name('dosen.update');
    });

    // Middleware untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('/admin/data-dosen', AdminDataDosenController::class)->names('admin.data-dosen');
        Route::resource('/admin/data-jurusan', AdminDataJurusanController::class)->names('admin.data-jurusan');
        Route::resource('/admin/data-prodi', AdminDataProdiController::class)->names('admin.data-prodi');
        Route::resource('/admin/data-surat', AdminDataSuratController::class)->names('admin.data-surat');
        Route::resource('/admin/data-mahasiswa', AdminDataMahasiswaController::class)->names('admin.data-mahasiswa');
        // Route untuk meng-update status pejabat dosen
        Route::post('/admin/data-dosen/{id}/update-status', [AdminDataDosenController::class, 'updateStatus'])->name('admin.data-dosen.update-status');
    });
});

// Tambahkan route untuk logout jika perlu
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Route::view('/pages/slick', 'pages.slick');
// Route::view('/pages/datatables', 'pages.datatables');
// Route::view('/pages/blank', 'pages.blank');
