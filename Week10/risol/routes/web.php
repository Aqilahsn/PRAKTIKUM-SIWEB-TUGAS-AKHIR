<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleAuthController;

// =============================================
// Halaman Publik
// =============================================
Route::get('/', function () {
    return view('index');
})->name('home');

// =============================================
// Auth Routes (Belum Login)
// =============================================
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// =============================================
// Google OAuth Routes
// =============================================
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// =============================================
// Route yang Dilindungi Middleware check.login
// =============================================
Route::middleware(['check.login'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/manage', [ProductController::class, 'index'])->name('products');
    Route::post('/manage', [ProductController::class, 'store'])->name('products.store');
    Route::put('/manage/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/manage/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});