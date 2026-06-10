<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// =============================================
// Halaman Publik
// =============================================
Route::get('/', function () {
    $products = \App\Models\Product::latest()->get();
    return view('index', compact('products'));
})->name('home');

// =============================================
// Google OAuth Routes
// =============================================
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// =============================================
// Route yang Dilindungi Middleware auth
// =============================================
Route::middleware(['auth'])->group(function () {

    // Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD & Kelola produk: hanya Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/manage', [ProductController::class, 'index'])->name('products');
        Route::post('/manage', [ProductController::class, 'store'])->name('products.store');
        Route::put('/manage/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/manage/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

// =============================================
// Breeze Auth Routes (Login, Register, Logout)
// =============================================
require __DIR__.'/auth.php';
