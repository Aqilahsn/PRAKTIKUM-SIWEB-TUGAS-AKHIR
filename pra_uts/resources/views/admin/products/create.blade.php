@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div style="margin-bottom: 30px;">
    <h2 class="section-title">Tambah Produk Baru</h2>
    <p class="section-subtitle">Isi formulir di bawah untuk menambahkan produk ke katalog Anda</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <!-- Product Name -->
                <div class="form-group">
                    <label for="name" style="font-weight: 600; color: #2d3748;">Nama Produk</label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Contoh: Laptop Gaming ASUS ROG"
                        required
                        style="padding: 12px 15px; border-radius: 8px;"
                    >
                    @error('name')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" style="font-weight: 600; color: #2d3748;">Deskripsi Produk</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="5" 
                        placeholder="Jelaskan spesifikasi dan keunggulan produk Anda..."
                        style="padding: 12px 15px; border-radius: 8px; resize: vertical;"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price and Stock -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price" style="font-weight: 600; color: #2d3748;">Harga (Rp)</label>
                            <input 
                                type="number" 
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                name="price" 
                                value="{{ old('price') }}" 
                                step="1000"
                                min="0"
                                placeholder="0"
                                required
                                style="padding: 12px 15px; border-radius: 8px;"
                            >
                            @error('price')
                                <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock" style="font-weight: 600; color: #2d3748;">Stok</label>
                            <input 
                                type="number" 
                                class="form-control @error('stock') is-invalid @enderror" 
                                id="stock" 
                                name="stock" 
                                value="{{ old('stock', 0) }}" 
                                min="0"
                                placeholder="0"
                                required
                                style="padding: 12px 15px; border-radius: 8px;"
                            >
                            @error('stock')
                                <div style="color: #f56565; font-size: 12px; margin-top: 8px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="form-group">
                    <label style="font-weight: 600; color: #2d3748; display: block; margin-bottom: 15px;">📂 Kategori Produk</label>
                    <p style="color: #718096; font-size: 13px; margin-bottom: 15px;">Pilih satu atau lebih kategori untuk produk ini</p>
                    
                    @if($categories->count() > 0)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px;">
                            @foreach($categories as $category)
                                <div style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 12px; cursor: pointer; transition: all 0.3s;" id="cat_{{ $category->id }}">
                                    <label style="cursor: pointer; margin: 0; display: flex; align-items: center; gap: 10px;">
                                        <input 
                                            type="checkbox" 
                                            name="categories[]" 
                                            value="{{ $category->id }}" 
                                            style="width: 18px; height: 18px; cursor: pointer;"
                                            @if(in_array($category->id, old('categories', []))) checked @endif
                                            onchange="updateCategoryStyle(this, {{ $category->id }})"
                                        >
                                        <span style="flex-grow: 1; font-weight: 500; color: #2d3748;">{{ $category->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="background: #fefcbf; border-radius: 8px; padding: 15px; color: #7c2d12;">
                            <p style="margin: 0;">Belum ada kategori. Buat kategori terlebih dahulu.</p>
                        </div>
                    @endif
                </div>

                <!-- Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 30px; padding-top: 30px; border-top: 2px solid #e2e8f0;">
                    <button 
                        type="submit" 
                        class="btn btn-primary" 
                        style="padding: 12px 30px; font-weight: 600;"
                    >
                        Simpan Produk
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary" style="padding: 12px 30px; font-weight: 600;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateCategoryStyle(checkbox, categoryId) {
    const element = document.getElementById('cat_' + categoryId);
    if (checkbox.checked) {
        element.style.borderColor = '#D38C9D';
        element.style.backgroundColor = '#F5EEF0';
    } else {
        element.style.borderColor = '#e2e8f0';
        element.style.backgroundColor = 'white';
    }
}

// Initialize styles on page load
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="categories[]"]');
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            updateCategoryStyle(checkbox, checkbox.value);
        }
    });
});
</script>

@endsection
