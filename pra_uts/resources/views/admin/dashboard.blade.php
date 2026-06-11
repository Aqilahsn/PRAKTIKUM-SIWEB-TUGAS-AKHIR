@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div style="margin-bottom: 40px;">
    <h2 class="section-title">Dashboard Admin</h2>
    <p class="section-subtitle">Kelola produk, kategori, dan toko Anda dengan mudah</p>
</div>

<!-- Statistics Cards -->
<div class="row" style="margin-bottom: 40px;">
    <div class="col-md-4 mb-3">
        <div class="stat-card stat-primary">
            <h5>Total Produk</h5>
            <h2>{{ \App\Models\Product::count() }}</h2>
            <p>Produk aktif di toko</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card stat-success">
            <h5>Total Kategori</h5>
            <h2>{{ \App\Models\Category::count() }}</h2>
            <p>Kategori tersedia</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card stat-warning">
            <h5>Total Pengguna</h5>
            <h2>{{ \App\Models\User::count() }}</h2>
            <p>User terdaftar</p>
        </div>
    </div>
</div>

<!-- Management Sections -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">Manajemen Produk</h4>
            <p style="color: #718096; margin-bottom: 20px;">Tambah, edit, atau hapus produk dari katalog toko Anda. Kelola stok, harga, dan kategori produk.</p>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk Baru</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Lihat Semua Produk</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">Manajemen Kategori</h4>
            <p style="color: #718096; margin-bottom: 20px;">Kelola kategori produk untuk mengorganisir katalog toko Anda dengan baik dan mudah.</p>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('home') }}" class="btn btn-primary">Lihat Kategori</a>
                <a href="{{ route('home') }}" class="btn btn-secondary">Buat Kategori Baru</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 20px;">Akses Cepat</h4>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
        <a href="{{ route('products.create') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #D38C9D 0%, #A55166 100%); color: white; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(211, 140, 157, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
            Tambah Produk
        </a>
        <a href="{{ route('products.index') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(72, 187, 120, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
            Daftar Produk
        </a>
        <a href="{{ route('home') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); color: white; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(237, 137, 54, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
            Kelola Pengguna
        </a>
        <a href="{{ route('home') }}" style="display: block; padding: 20px; background: linear-gradient(135deg, #9f7aea 0%, #6b46c1 100%); color: white; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(159, 122, 234, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
            Laporan
        </a>
    </div>
</div>

@endsection
