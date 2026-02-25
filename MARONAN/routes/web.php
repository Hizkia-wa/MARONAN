<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    Route::get('/admin/petani',[AdminController::class,'petaniIndex']);
    Route::post('/admin/petani/{id}/approve',[AdminController::class,'approvePetani']);
    Route::post('/admin/petani/{id}/reject',[AdminController::class,'rejectPetani']);
    Route::get('/petani', [AdminController::class, 'petaniIndex'])
            ->name('admin.petani.index');

        Route::post('/petani/{id}/approve', [AdminController::class, 'approvePetani'])
            ->name('admin.petani.approve');

        Route::post('/petani/{id}/reject', [AdminController::class, 'rejectPetani'])
            ->name('admin.petani.reject');
        Route::get('/produk', [AdminController::class,'produkIndex'])
            ->name('admin.produk.index');

        Route::delete('/produk/{id}', [AdminController::class,'destroyProduk'])
            ->name('admin.produk.destroy');
});