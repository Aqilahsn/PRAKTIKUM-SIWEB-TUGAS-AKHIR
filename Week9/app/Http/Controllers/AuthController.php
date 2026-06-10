<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Verifikasi reCAPTCHA ke Google
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaData = $recaptcha->json();

        if (!$recaptcha->successful() || !($recaptchaData['success'] ?? false)) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal! Anda robot?'])
                ->withInput();
        }

        // 2. Cek hardcoded admin (backward compatible)
        if ($request->username == 'admin' && $request->password == 'admin123') {
            session(['login' => true]);
            session(['user'  => 'admin']);
            session()->save();
            return redirect()->route('products')->with('success', 'Login berhasil! Selamat datang, Admin.');
        }

        // 3. Cek user dari database (email + password)
        $user = User::where('email', $request->username)->first();
        if ($user && $user->password && Hash::check($request->password, $user->password)) {
            session(['login' => true]);
            session(['user'  => $user->name]);
            session()->save();
            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang, ' . $user->name . '.');
        }

        return back()->with('error', 'Username/Email atau password salah')->withInput();
    }

    public function register(Request $request)
    {
        // 1. Verifikasi reCAPTCHA
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaData = $recaptcha->json();

        if (!$recaptcha->successful() || !($recaptchaData['success'] ?? false)) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal! Anda robot?'])
                ->withInput();
        }

        // 2. Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // 3. Simpan ke database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}