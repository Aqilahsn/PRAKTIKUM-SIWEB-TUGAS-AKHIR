@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-6">
            <span>←</span>
            <span>Kembali ke Daftar Produk</span>
        </a>
        <h1 class="font-heading text-3xl font-bold text-gray-900">Edit Produk</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi produk: <strong>{{ $product->nama_produk }}</strong></p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}"
                    class="w-full px-4 py-3 border @error('nama_produk') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Monitor LED 24 inch" required>
                @error('nama_produk')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kode Produk -->
            <div>
                <label for="kode_produk" class="block text-gray-700 font-semibold mb-2">Kode Produk</label>
                <input type="text" name="kode_produk" id="kode_produk" value="{{ old('kode_produk', $product->kode_produk) }}"
                    class="w-full px-4 py-3 border @error('kode_produk') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: MON-001" required>
                @error('kode_produk')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Kode produk harus unik di dalam sistem</p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', $product->stok) }}"
                        class="w-full px-4 py-3 border @error('stok') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="0" min="0" required>
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $product->harga) }}"
                        class="w-full px-4 py-3 border @error('harga') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="0" min="0" required>
                    @error('harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Info Produk -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-blue-900 text-sm">
                    <strong>Informasi Produk:</strong><br>
                    <span>Total Nilai Stok: Rp {{ number_format($product->stok * $product->harga, 0, ',', '.') }}</span>
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="btn-primary flex-1 py-3 rounded-lg font-semibold">
                    Perbarui Produk
                </button>
                <a href="{{ route('products.index') }}" class="flex-1 px-4 py-3 bg-gray-300 hover:bg-gray-400 text-gray-900 rounded-lg font-semibold text-center transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
