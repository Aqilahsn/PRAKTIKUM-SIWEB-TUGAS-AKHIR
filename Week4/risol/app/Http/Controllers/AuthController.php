<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->username == 'admin' && $request->password == 'admin123') {
            session(['login' => true]);
            session(['user' => $request->username]);
            session()->save();
            return redirect('/')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}