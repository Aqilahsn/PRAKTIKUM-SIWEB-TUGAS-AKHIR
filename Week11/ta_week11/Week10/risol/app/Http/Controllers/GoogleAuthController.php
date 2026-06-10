<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleAuthController extends Controller
{
    /**
     * Redirect user ke halaman login Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback setelah user login via Google
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada, jika belum buat baru
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                ]
            );

            // Set session manual (sesuai CheckLogin middleware)
            session(['login' => true]);
            session(['user'  => $user->name]);
            session()->save();

            return redirect()->route('home')->with('success', 'Login dengan Google berhasil! Selamat datang, ' . $user->name . '.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
