<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TransaksiDetailController;

// Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']); // Perbaikan route POST untuk login

// Dashboard (Setelah login)
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Produk Routes
Route::resource('produk', ProdukController::class);

// Petugas Routes
Route::resource('petugas', PetugasController::class);

// Transaksi Routes
Route::resource('transaksi', TransaksiController::class);
Route::get('transaksi/{id}/detail', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::post('/transaksi/detail/create', [TransaksiDetailController::class, 'create']);
Route::get('/transaksi/detail/delete', [TransaksiDetailController::class, 'delete']);
Route::post('/transaksi/{id}/selesai', [TransaksiDetailController::class, 'selesai'])->name('transaksi.selesai');

// Histori Transaksi
Route::get('/history', [TransaksiController::class, 'history'])->name('history.index');

// Pembayaran Routes
Route::resource('pembayaran', PembayaranController::class);

// Admin Routes
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/petugas', [AdminController::class, 'petugas']);
Route::get('/admin/pimpinan', [AdminController::class, 'pimpinan']);
Route::get('/admin/konsumen', [AdminController::class, 'konsumen']);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Menggunakan POST untuk logout
