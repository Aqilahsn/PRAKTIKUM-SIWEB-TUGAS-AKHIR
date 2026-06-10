@extends('layouts.app')

@section('content')
<div class="mb-10">
    <a href="{{ route('items.index') }}" class="inline-flex items-center text-primary hover:text-gray-900 transition mb-6 font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
    <h1 class="font-heading text-5xl md:text-6xl italic tracking-wide text-gray-900">Edit Produk</h1>
    <p class="text-gray-600 mt-2 text-lg">Perbarui informasi produk skincare yang sudah ada.</p>
</div>

<div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100">
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-8">
            <label for="name" class="block text-gray-700 font-semibold mb-3 text-lg">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" 
                class="w-full px-5 py-4 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                placeholder="Misal: Serum Vitamin C..." required>
            @error('name')
                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label for="description" class="block text-gray-700 font-semibold mb-3 text-lg">Manfaat & Kandungan <span class="text-gray-400 font-normal text-sm">(Opsional)</span></label>
            <textarea name="description" id="description" rows="5" 
                class="w-full px-5 py-4 bg-gray-50 border @error('description') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                placeholder="Jelaskan manfaat dan kandungan utama produk...">{{ old('description', $item->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div>
                <label for="price" class="block text-gray-700 font-semibold mb-3 text-lg">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" min="0"
                    class="w-full px-5 py-4 bg-gray-50 border @error('price') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    required>
                @error('price')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-gray-700 font-semibold mb-3 text-lg">Stok Produk</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $item->stock) }}" min="0"
                    class="w-full px-5 py-4 bg-gray-50 border @error('stock') border-red-500 @else border-gray-200 @enderror rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-800"
                    required>
                @error('stock')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-10 py-4 rounded-xl font-semibold text-lg shadow-lg">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection
