<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'role'      => 'user', // default role untuk user Google
                ]
            );

            // Login menggunakan Auth bawaan Laravel (kompatibel dengan Breeze)
            Auth::login($user);

            return redirect()->route('products')->with('success', 'Login dengan Google berhasil! Selamat datang, ' . $user->name . '.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
