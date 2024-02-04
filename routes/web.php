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

Route::middleware(['auth', 'checkRole:Administrator'])->group(function () {
    // Administrator
    Route::get('/admin/barang', [AdminController::class, 'barang'])->name('admin.barang');
    Route::post('/admin/barang/insert', [AdminController::class, 'insert'])->name('admin.barang.insert');
    Route::delete('/admin/barang/{id}', [AdminController::class, 'hapus'])->name('admin.barang.hapus');
    Route::get('/admin/barang/{id}', [AdminController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/admin/barang/{id}', [AdminController::class, 'update'])->name('admin.barang.update');

    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/admin/user/insert', [AdminController::class, 'insertUser'])->name('admin.user.insert');
    Route::delete('/admin/user/{id}', [AdminController::class, 'hapusUser'])->name('admin.user.hapus');
    Route::get('/admin/user/{id}', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
});

Route::middleware(['auth', 'checkRole:Petugas'])->group(function () {
    // Petugas
    Route::get('/petugas', function () {
        return "Petugas";
    })->name('dashboard-petugas');
});
