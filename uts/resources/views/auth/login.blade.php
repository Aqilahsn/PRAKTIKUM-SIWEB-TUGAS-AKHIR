@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="font-heading text-3xl font-bold text-gray-900 mb-2">Sistem Gudang</h1>
            <p class="text-gray-600 text-sm">Login sebagai Administrator</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 px-4 py-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
                <strong>Login Gagal!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-semibold mb-2 text-sm">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-3 bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="admin@admin.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2 text-sm">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full btn-primary py-3 rounded-lg font-semibold shadow-md mb-4">
                Login
            </button>
            
            <p class="text-center text-gray-600 text-sm">
                <strong>Demo:</strong> admin@admin.com / password
            </p>
        </form>
    </div>
</div>
@endsection
