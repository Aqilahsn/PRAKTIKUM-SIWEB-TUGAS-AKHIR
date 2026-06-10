@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[70vh]">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-10 border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="font-heading text-4xl italic tracking-wide text-gray-900 mb-2">Buat Akun</h1>
            <p class="text-gray-600">Daftarkan diri Anda untuk mulai.</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="name" class="block text-gray-700 font-semibold mb-2 text-sm">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="w-full px-5 py-4 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="Nama lengkap..." required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-semibold mb-2 text-sm">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    class="w-full px-5 py-4 bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="Masukkan email..." required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-gray-700 font-semibold mb-2 text-sm">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-5 py-4 bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="Minimal 6 karakter..." required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2 text-sm">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="Ulangi password..." required>
            </div>

            <button type="submit" class="w-full btn-primary px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg mb-6">
                Register
            </button>
            
            <p class="text-center text-gray-600 text-sm">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Login di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
