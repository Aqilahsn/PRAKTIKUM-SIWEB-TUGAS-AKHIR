@extends('layouts.app')

@section('title', 'Produk - E-Commerce')

@section('content')

<!-- Hero Section -->
<div class="hero">
    <h1>Toko Online Modern</h1>
    <p>Belanja produk berkualitas dengan harga terbaik</p>
</div>

<!-- Products Section -->
<div style="margin-bottom: 40px;">
    <h2 class="section-title">Produk Unggulan</h2>
    <p class="section-subtitle">Temukan produk favorit Anda dari koleksi lengkap kami</p>

    @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        {{ Str::limit($product->name, 30) }}
                    </div>
                    <div class="product-body">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        
                        @if($product->description)
                            <p class="product-description">{{ $product->description }}</p>
                        @endif

                        @if($product->categories->count() > 0)
                            <div class="product-categories">
                                @foreach($product->categories as $category)
                                    <span class="category-badge">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="product-footer">
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            
                            <div class="product-stock">
                                @if($product->stock > 5)
                                    <span class="stock-badge stock-available">Stok: {{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="stock-badge stock-warning">Stok Terbatas: {{ $product->stock }}</span>
                                @else
                                    <span class="stock-badge stock-unavailable">Stok Habis</span>
                                @endif
                            </div>

                            @if(auth()->check() && auth()->user()->role === 'user')
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" style="margin-top: 12px;">
                                        @csrf
                                        <div style="display: flex; gap: 8px; margin-bottom: 10px;">
                                            <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" style="max-width: 60px; padding: 8px;">
                                            <button type="submit" class="btn-add-cart">Keranjang</button>
                                        </div>
                                    </form>
                                @else
                                    <button class="btn-add-cart" disabled style="opacity: 0.5; cursor: not-allowed;">Stok Habis</button>
                                @endif
                            @elseif(!auth()->check())
                                <a href="{{ route('login') }}" class="btn-add-cart">Login untuk Membeli</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon"></div>
            <h3 class="empty-state-title">Tidak Ada Produk</h3>
            <p class="empty-state-text">Belum ada produk yang tersedia saat ini. Silakan cek kembali nanti.</p>
        </div>
    @endif
</div>

@endsection
