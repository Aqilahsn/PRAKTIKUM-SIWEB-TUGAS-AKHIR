@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div style="display: flex; align-items: center; justify-content: center; min-height: 60vh; padding: 20px;">
    <div style="width: 100%; max-width: 450px;">
        <!-- Logo/Brand -->
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 700; color: #1a202c; margin-bottom: 10px;">E-Commerce</h1>
            <p style="color: #718096; font-size: 16px;">Selamat datang kembali!</p>
        </div>

        <!-- Form Card -->
        <div style="background: white; border-radius: 12px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0;">
            <h2 style="font-size: 24px; font-weight: 700; color: #1a202c; margin-bottom: 10px;">Login</h2>
            <p style="color: #718096; margin-bottom: 30px;">Masuk dengan akun Anda untuk melanjutkan</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block;">Email Address</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="contoh@email.com"
                        required
                        style="padding: 12px 15px; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 14px; transition: all 0.3s;"
                    >
                    @error('email')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block;">Password</label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••"
                        required
                        style="padding: 12px 15px; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 14px; transition: all 0.3s;"
                    >
                    @error('password')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn btn-primary w-100" 
                    style="padding: 12px; font-weight: 600; font-size: 16px; border-radius: 8px; margin-top: 20px; background: linear-gradient(135deg, #D38C9D 0%, #A55166 100%); border: none;"
                >
                    Login
                </button>

                <hr style="border-color: #e2e8f0; margin: 25px 0;">

                <!-- Register Link -->
                <div style="text-align: center;">
                    <p style="color: #718096; margin: 0;">Belum punya akun? </p>
                    <a href="{{ route('register') }}" style="color: #D38C9D; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 10px;">Daftar sekarang</a>
                </div>

                <!-- Demo Account Info -->
                <div style="background: #edf2f7; border-radius: 8px; padding: 15px; margin-top: 20px; font-size: 12px;">
                    <p style="color: #4a5568; margin: 0; font-weight: 600;">Akun Demo</p>
                    <p style="color: #4a5568; margin: 5px 0;">User: <code style="background: white; padding: 2px 6px; border-radius: 4px;">user@example.com</code></p>
                    <p style="color: #4a5568; margin: 0;">Pass: <code style="background: white; padding: 2px 6px; border-radius: 4px;">password123</code></p>
                </div>
            </form>
        </div>

        <!-- Footer Link -->
        <p style="text-align: center; color: #cbd5e0; font-size: 12px; margin-top: 20px;">
            <a href="{{ route('home') }}" style="color: #667eea; text-decoration: none;">← Kembali ke beranda</a>
        </p>
    </div>
</div>

@endsection
