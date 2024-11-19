<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, CategoryController, FileController};

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::prefix('dashboard')->group(function(){
    Route::resource('category', CategoryController::class);
    Route::resource('file', FileController::class);
});