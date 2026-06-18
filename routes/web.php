<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\RentalController;

// Admin
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;

// user
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/barang/{barang}', [HomeController::class, 'show'])->name('barang.show');


//auth 
Route::middleware(['auth'])->group(function () {

    //keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('keranjang.add');
    Route::get('/keranjang/remove/{id}', [KeranjangController::class, 'remove'])->name('keranjang.remove');
    Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');

    //rental
    Route::get('/rental/buat/{barang}', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rental/store', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/riwayat', [RentalController::class, 'riwayat'])->name('riwayat');
});


//admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('barang', BarangController::class);
        Route::resource('kategori', KategoriController::class)->except(['show']);

        Route::get('/rental', [AdminRentalController::class, 'index'])->name('rental.index');
        Route::get('/rental/{rental}', [AdminRentalController::class, 'show'])->name('rental.show');
        Route::post('/rental/{rental}/approve', [AdminRentalController::class, 'approve'])->name('rental.approve');
        Route::post('/rental/{rental}/tolak', [AdminRentalController::class, 'tolak'])->name('rental.tolak');

        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian/{rental}/proses', [PengembalianController::class, 'proses'])->name('pengembalian.proses');
        Route::post('/pengembalian/{pengembalian}/lunas', [PengembalianController::class, 'konfirmasiPembayaran'])->name('pengembalian.lunas');
    });


require __DIR__.'/auth.php';