<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MinyakController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Mengambil data produk dinamis untuk tampilan Dashboard User
Route::get('/dashboard', [MinyakController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute untuk Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Operasional Minyak Jelantah
    // Catatan: Rute setor-minyak kini digunakan Admin untuk menambah poin nasabah
    Route::post('/setor-minyak', [MinyakController::class, 'setor'])->name('minyak.setor');
    Route::post('/tukar-barang', [MinyakController::class, 'tukarBarang'])->name('minyak.tukarBarang');
    Route::get('/riwayat', [MinyakController::class, 'riwayat'])->name('minyak.riwayat');

    // Rute Khusus Admin (Grup /admin)
    Route::prefix('admin')->group(function () {
        // Dashboard Admin & Riwayat Global
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Membatalkan transaksi (Balik poin)
        Route::delete('/transaksi/{id}', [AdminController::class, 'destroy'])->name('admin.transaksi.destroy');
        
        // Manajemen Katalog Produk (CRUD)
        Route::post('/product', [AdminController::class, 'storeProduct'])->name('admin.product.store'); // Tambah
        Route::patch('/product/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update'); // Perbarui/Edit
        Route::delete('/product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.destroy'); // Hapus
    });
});

require __DIR__.'/auth.php';