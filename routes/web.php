<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, CategoryController, FileController, AuthController};

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginPros');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('file', FileController::class);
    });
});
