<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('login');
// });

// Login
Route::get('/', [LoginController::class, 'index'])->name('viewLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Administrator
Route::get('/dahboard-admin/barang', [AdminController::class, 'barang'])->name('admin.barang');
Route::get('/dahboard-admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
Route::post('/dahboard-admin/barang/insert', [AdminController::class, 'insert'])->name('admin.barang.insert');
Route::delete('/dahboard-admin/barang/{id}', [AdminController::class, 'hapus'])->name('admin.barang.hapus');
Route::get('/dahboard-admin/barang/{id}', [AdminController::class, 'edit'])->name('admin.barang.edit');
Route::put('/dahboard-admin/barang/{id}', [AdminController::class, 'update'])->name('admin.barang.update');
// Route::get('/dahboard-admin', function () {
//     return "Administrator";
// })->name('dashboard-admin');


Route::get('/dahboard-petugas', function () {
    return "Petugas";
})->name('dashboard-petugas');
