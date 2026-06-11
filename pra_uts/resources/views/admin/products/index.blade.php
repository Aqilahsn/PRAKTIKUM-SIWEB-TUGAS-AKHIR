@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div>
        <h2 class="section-title">Daftar Produk</h2>
        <p class="section-subtitle">Kelola semua produk di toko Anda</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary" style="padding: 12px 24px;">Tambah Produk Baru</a>
</div>

@if($products->count() > 0)
    <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <div class="table-responsive">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <strong style="color: #D38C9D;">{{ $product->id }}</strong>
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                            </td>
                            <td>
                                <strong style="color: #D38C9D;">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="stock-badge stock-available">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="stock-badge stock-warning">{{ $product->stock }}</span>
                                @else
                                    <span class="stock-badge stock-unavailable">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                @if($product->categories->count() > 0)
                                    @foreach($product->categories as $category)
                                        <span class="category-badge">{{ $category->name }}</span>
                                    @endforeach
                                @else
                                    <span style="color: #cbd5e0; font-size: 12px;">-</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 30px; display: flex; justify-content: center;">
        {{ $products->links() }}
    </div>
@else
    <div class="empty-state" style="background: white; border-radius: 12px;">
        <div class="empty-state-icon"></div>
        <h3 class="empty-state-title">Tidak Ada Produk</h3>
        <p class="empty-state-text">Belum ada produk di toko Anda. Mari buat produk pertama Anda sekarang!</p>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Buat Produk Pertama</a>
    </div>
@endif

@endsection
