<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/manage', function () {
    if (!session()->has('login')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
    }
    return view('manage');
});

Route::post('/manage', function () {
    if (!session()->has('login')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
    }
    return redirect('/manage')->with('success', 'Produk berhasil disimpan!');
});

Route::get('/logout', [AuthController::class, 'logout']);