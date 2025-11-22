<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;

Route::get('/', [LaporanController::class, 'index']);

Route::post('/laporan', [LaporanController::class, 'store']);
Route::get('/buat-laporan', function () {
    return view('buat_laporan');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/buat-laporan', function () {
    return view('buat_laporan');
});

Route::patch('/laporan/{id}/verifikasi', [AdminController::class, 'verifikasi'])
    ->middleware(['auth', 'verified']);

    
Route::get('/laporan/{id}', [LaporanController::class, 'show']);

Route::post('/laporan/{id}/komentar', [LaporanController::class, 'storeKomentar']);

Route::delete('/komentar/{id}', [AdminController::class, 'hapusKomentar'])
    ->middleware(['auth', 'verified']);

Route::patch('/laporan/{id}/selesai', [AdminController::class, 'selesai'])
    ->middleware(['auth', 'verified']);

Route::get('/setup-migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return 'Migrasi Database Sukses!';
});
    
require __DIR__.'/auth.php';
