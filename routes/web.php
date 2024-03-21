<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Meja;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login
Route::get('/', [LoginController::class, 'index'])->name('viewLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('user', UserController::class);
Route::resource('meja', MejaController::class);
Route::resource('produk', ProdukController::class);
Route::resource('transaksi', TransaksiController::class);
Route::get('pdf', [TransaksiController::class, 'pdf'])->name('transaksi.pdf');
Route::resource('pelanggan', PelangganController::class);
Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::post('detail-transaksi/create', [DetailTransaksiController::class, 'create'])->name('detail-transaksi.create');
Route::get('detail-transaksi/destroy', [DetailTransaksiController::class, 'destroy'])->name('detail-transaksi.destroy');
