<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GantiPasswordController as AdminGantiPasswordController;
use App\Http\Controllers\Admin\NonAdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NonAdmin\AuthorController as NonAdminAuthorController;
use App\Http\Controllers\NonAdmin\BukuController as NonAdminBukuController;
use App\Http\Controllers\NonAdmin\DashboardController as NonAdminDashboardController;
use App\Http\Controllers\NonAdmin\GantiPasswordController as NonAdminGantiPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->middleware(['middleware' => 'auth:admin'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('index');
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('index');
        Route::post('', [AdminController::class, 'store'])->name('store');
        Route::get('/{adminId}', [AdminController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminController::class, 'update'])->name('update');
    });
    Route::prefix('non_admin')->name('non_admin.')->group(function () {
        Route::get('', [NonAdminController::class, 'index'])->name('index');
        Route::post('', [NonAdminController::class, 'store'])->name('store');
        Route::get('/{nonAdminId}', [NonAdminController::class, 'edit'])->name('edit');
        Route::put('/update', [NonAdminController::class, 'update'])->name('update');
        Route::get('/hapus/{nonAdminId}', [NonAdminController::class, 'hapus'])->name('hapus'); 
    });
    Route::prefix('author')->name('author.')->group(function () {
        Route::get('', [AuthorController::class, 'index'])->name('index');
        Route::post('', [AuthorController::class, 'store'])->name('store');
        Route::get('/{authorId}', [AuthorController::class, 'edit'])->name('edit');
        Route::put('/update', [AuthorController::class, 'update'])->name('update');
        Route::get('/hapus/{authorId}', [AuthorController::class, 'hapus'])->name('hapus');
    });
    Route::prefix('buku')->name('buku.')->group(function () {
        Route::get('', [BukuController::class, 'index'])->name('index');
        Route::post('', [BukuController::class, 'store'])->name('store');
        Route::get('/{bukuId}', [BukuController::class, 'edit'])->name('edit');
        Route::put('/update', [BukuController::class, 'update'])->name('update');
        Route::get('/hapus/{bukuId}', [BukuController::class, 'hapus'])->name('hapus');
    });
    Route::prefix('ganti_password')->name('ganti_password.')->group(function () {
        Route::get('', [AdminGantiPasswordController::class, 'index'])->name('index');
        Route::put('', [AdminGantiPasswordController::class, 'ganti_password'])->name('ganti_password');
    });
    
});


Route::prefix('non_admin')->name('non_admin.')->middleware(['middleware' => 'auth:non_admin'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('', [NonAdminDashboardController::class, 'index'])->name('index');
    });

    Route::prefix('author')->name('author.')->group(function () {
        Route::get('', [NonAdminAuthorController::class, 'index'])->name('index');
        Route::post('', [NonAdminAuthorController::class, 'store'])->name('store');
        Route::get('/{authorId}', [NonAdminAuthorController::class, 'edit'])->name('edit');
        Route::put('/update', [NonAdminAuthorController::class, 'update'])->name('update');
        Route::get('/hapus/{authorId}', [NonAdminAuthorController::class, 'hapus'])->name('hapus');
    });
    Route::prefix('buku')->name('buku.')->group(function () {
        Route::get('', [NonAdminBukuController::class, 'index'])->name('index');
        Route::post('', [NonAdminBukuController::class, 'store'])->name('store');
        Route::get('/{bukuId}', [NonAdminBukuController::class, 'edit'])->name('edit');
        Route::put('/update', [NonAdminBukuController::class, 'update'])->name('update');
        Route::get('/hapus/{bukuId}', [NonAdminBukuController::class, 'hapus'])->name('hapus');
    });
    Route::prefix('ganti_password')->name('ganti_password.')->group(function () {
        Route::get('', [NonAdminGantiPasswordController::class, 'index'])->name('index');
        Route::put('', [NonAdminGantiPasswordController::class, 'ganti_password'])->name('ganti_password');
    });
});