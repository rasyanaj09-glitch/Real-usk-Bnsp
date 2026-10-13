<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;


// 1. Landing Page / Halaman Utama Publik (Memanggil resources/views/home.blade.php)
Route::get('/', function () {
    return view('home');
})->name('home');

// 2. Guest Routes (Hanya untuk Pengguna yang Belum Login)
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register Peserta Mandiri
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. Authenticated Routes (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- DASHBOARD ADMIN ---
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    // --- DASHBOARD PESERTA (Khusus Hak Akses Peserta) ---
    Route::get('/peserta/dashboard', [AuthController::class, 'pesertaDashboard'])->name('peserta.dashboard');
    Route::put('/peserta/profile/update', [AuthController::class, 'updateProfile'])->name('peserta.profile.update');

    // --- FITUR KELOLA DATA UNTUK ADMIN ---
    // Mengakses file di resources/views/peserta (index, create, edit, show)
    Route::resource('peserta', PesertaController::class);

    // Mengakses file di resources/views/skema (index, create, edit)
    Route::resource('skema', SkemaController::class);
});