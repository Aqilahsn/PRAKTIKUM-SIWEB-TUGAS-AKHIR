@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div style="display: flex; align-items: center; justify-content: center; min-height: 60vh; padding: 20px;">
    <div style="width: 100%; max-width: 450px;">
        <!-- Logo/Brand -->
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 700; color: #1a202c; margin-bottom: 10px;">E-Commerce</h1>
            <p style="color: #718096; font-size: 16px;">Bergabunglah dengan ribuan pembeli kami!</p>
        </div>

        <!-- Form Card -->
        <div style="background: white; border-radius: 12px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0;">
            <h2 style="font-size: 24px; font-weight: 700; color: #1a202c; margin-bottom: 10px;">Daftar Akun</h2>
            <p style="color: #718096; margin-bottom: 30px;">Buat akun baru untuk memulai berbelanja</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block;">Nama Lengkap</label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Nama Anda"
                        required
                        style="padding: 12px 15px; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 14px; transition: all 0.3s;"
                    >
                    @error('name')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Minimal 8 karakter"
                        required
                        style="padding: 12px 15px; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 14px; transition: all 0.3s;"
                    >
                    @error('password')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="form-group">
                    <label for="password_confirmation" style="font-weight: 600; color: #2d3748; margin-bottom: 8px; display: block;">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulangi password"
                        required
                        style="padding: 12px 15px; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 14px; transition: all 0.3s;"
                    >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="btn btn-primary w-100" 
                    style="padding: 12px; font-weight: 600; font-size: 16px; border-radius: 8px; margin-top: 20px; background: linear-gradient(135deg, #D38C9D 0%, #A55166 100%); border: none;"
                >
                    Daftar Sekarang
                </button>

                <hr style="border-color: #e2e8f0; margin: 25px 0;">

                <!-- Login Link -->
                <div style="text-align: center;">
                    <p style="color: #718096; margin: 0;">Sudah punya akun? </p>
                    <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 10px;">Login di sini →</a>
                </div>

                <!-- Terms Info -->
                <div style="background: #edf2f7; border-radius: 8px; padding: 12px; margin-top: 20px; font-size: 12px; color: #4a5568;">
                    <p style="margin: 0;">Dengan mendaftar, Anda setuju dengan <a href="#" style="color: #667eea;">Syarat & Ketentuan</a> kami</p>
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
