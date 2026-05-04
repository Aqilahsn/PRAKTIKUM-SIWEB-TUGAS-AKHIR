@extends('layouts.app')

@section('content')
<div class="bg-secondary rounded-3xl overflow-hidden mb-16 flex flex-col md:flex-row items-center relative shadow-lg">
    <div class="p-10 md:p-16 md:w-1/2 z-10">
        <h1 class="font-heading text-5xl md:text-6xl font-bold text-gray-900 mb-4 leading-tight">
            Weightless Hydration.<br>Pillow-Soft Skin.
        </h1>
        <p class="text-xl text-gray-800 mb-6 font-medium tracking-wide">COMING SOON</p>
        <a href="#products" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-full font-bold border-2 border-gray-900 hover:bg-gray-900 hover:text-white transition duration-300">
            Shop All Best Sellers
        </a>
    </div>
    <div class="md:w-1/2 h-64 md:h-full min-h-[400px] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1617897903246-719242758050?q=80&w=1000&auto=format&fit=crop');">
        <!-- Placeholder for hero image -->
    </div>
</div>

<div class="flex justify-between items-end mb-8" id="products">
    <h2 class="font-heading text-3xl md:text-4xl text-gray-900">New Arrivals & Best Sellers</h2>
    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('items.create') }}" class="text-sm bg-primary text-white px-4 py-2 rounded-full font-medium hover:bg-opacity-80 transition shadow-sm">
            + Tambah Produk (Admin)
        </a>
    @endif
</div>

@if($items->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($items as $item)
        <div class="group relative flex flex-col bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <!-- Product Image Area -->
            <a href="{{ route('items.show', $item->id) }}" class="aspect-square bg-[#fff5f7] p-6 flex justify-center items-center relative cursor-pointer block">
                <!-- Badge -->
                <span class="absolute top-3 right-3 bg-white text-xs font-bold px-2 py-1 rounded shadow-sm tracking-wider">NEW</span>
                <!-- Dummy Product Image -->
                <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=400&auto=format&fit=crop" alt="{{ $item->name }}" class="object-cover w-4/5 h-4/5 rounded-full shadow-lg group-hover:scale-105 transition-transform duration-500">
            </a>
            
            <!-- Product Info -->
            <div class="p-5 flex flex-col flex-grow text-center">
                <a href="{{ route('items.show', $item->id) }}" class="hover:text-primary transition">
                    <h3 class="font-bold text-gray-900 text-lg mb-1 leading-tight">{{ $item->name }}</h3>
                </a>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">{{ $item->description ?: 'Skincare Essentials' }}</p>
                <p class="text-gray-400 text-xs mb-4">Stok: {{ $item->stock }}</p>
                
                <!-- Action Buttons -->
                <div class="mt-auto flex flex-col space-y-3">
                    <form action="{{ route('cart.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2.5 rounded-full border border-gray-900 text-gray-900 font-semibold text-sm hover:bg-gray-900 hover:text-white transition duration-300">
                            Add To Bag Rp {{ number_format($item->price, 0, ',', '.') }}
                        </button>
                    </form>
                    
                    <!-- Admin Controls (Edit & Delete) -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <div class="flex space-x-2 pt-3 border-t border-gray-100 justify-center">
                        <a href="{{ route('items.edit', $item->id) }}" class="text-yellow-600 text-xs font-medium hover:underline">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs font-medium hover:underline">Hapus</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
        <h3 class="text-2xl font-heading text-gray-800 mb-2">Belum ada produk</h3>
        <p class="text-gray-500 mb-6">Toko Anda masih kosong. Nantikan produk skincare terbaik dari kami.</p>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('items.create') }}" class="bg-primary text-white px-6 py-2 rounded-full inline-block font-medium">Tambah Sekarang</a>
        @endif
    </div>
@endif
@endsection
