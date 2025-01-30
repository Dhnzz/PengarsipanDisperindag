<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, CategoryController, FileController, AuthController};

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginPros');
});

Route::middleware(['auth'])->group(function () {
    Route::get('change_password_view', [AuthController::class, 'change_password_view'])->name('change_password_view');
    Route::post('change_password', [AuthController::class, 'change_password'])->name('change_password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('file', FileController::class);
    });
});
