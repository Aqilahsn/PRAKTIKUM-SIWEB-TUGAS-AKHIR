@extends('layouts.app')

@section('content')
<div class="mb-10">
    <a href="{{ route('items.index') }}" class="inline-flex items-center text-primary hover:text-gray-900 transition mb-6 font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Katalog
    </a>
</div>

<div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">
    <!-- Product Image -->
    <div class="md:w-1/2 bg-[#fff5f7] p-10 flex justify-center items-center">
        <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=800&auto=format&fit=crop" alt="{{ $item->name }}" class="object-cover w-3/4 h-3/4 rounded-full shadow-2xl">
    </div>

    <!-- Product Details -->
    <div class="md:w-1/2 p-10 md:p-16 flex flex-col justify-center">
        <div class="uppercase tracking-widest text-xs font-bold text-gray-400 mb-2">Skincare</div>
        <h1 class="font-heading text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $item->name }}</h1>
        <p class="text-3xl font-light text-gray-900 mb-8">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
        
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Manfaat & Kandungan</h3>
            <p class="text-gray-600 leading-relaxed">{{ $item->description ?: 'Produk perawatan kulit terbaik untuk Anda.' }}</p>
        </div>

        <div class="mb-8 flex items-center">
            <span class="w-3 h-3 rounded-full {{ $item->stock > 0 ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
            <span class="text-gray-600 font-medium">Stok tersedia: {{ $item->stock }} pcs</span>
        </div>

        <!-- Add to Cart Form -->
        <form action="{{ route('cart.store', $item->id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-gray-900 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-800 hover:shadow-lg transition duration-300 transform hover:-translate-y-1" {{ $item->stock < 1 ? 'disabled' : '' }}>
                {{ $item->stock > 0 ? 'Add To Bag' : 'Habis Terjual' }}
            </button>
        </form>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="mt-6 pt-6 border-t border-gray-100 flex space-x-4">
            <a href="{{ route('items.edit', $item->id) }}" class="text-yellow-600 font-medium hover:underline text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Produk
            </a>
            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 font-medium hover:underline text-sm flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
