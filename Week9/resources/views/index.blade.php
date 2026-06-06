@extends('layouts.app')

@section('title', 'Risol Majesty — Artisan Snacks')
@section('meta_description', 'Risol Majesty - Cita rasa artisan handcrafted premium terbaik.')

@section('content')

<!-- ===== HERO ===== -->
<section class="hero-banner">
  <div class="hero-banner-wrapper">
    <img src="{{ asset('assets/banner-hero.jpg') }}" alt="Banner Risol Majesty">
  </div>
  <div class="hero-text-overlay">
    <span class="hero-eyebrow">Artisan · Handcrafted · Premium</span>
    <h1 class="hero-title">Cita Rasa yang<br><em>Tak Terlupakan</em></h1>
    <a href="#produk" class="hero-btn">
      <i class="bi bi-arrow-down"></i> Jelajahi Produk
    </a>
  </div>
</section>


<!-- ===== STATISTIK ===== -->
<section class="statistics-section">
  <div class="container">
    <div class="text-center mb-2">
      <span class="section-label">Ringkasan</span>
      <h2 class="section-title">Statistik Dashboard</h2>
      <div class="section-divider"><span class="section-divider-dot"></span></div>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-palette"></i></div>
          <span class="stat-number">{{ $products->count() }}</span>
          <p class="stat-label">Total Produk</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-boxes"></i></div>
          <span class="stat-number">{{ $products->sum('stock') }}</span>
          <p class="stat-label">Stok Tersedia</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon"><i class="bi bi-graph-up"></i></div>
          <span class="stat-number">{{ $products->pluck('varian')->unique()->count() }}</span>
          <p class="stat-label">Total Varian</p>
        </div>
      </div>
    </div>

    @auth
    <div class="text-center mt-5">
      <a href="{{ route('products') }}" class="btn btn-warning px-4">
        <i class="bi bi-grid me-2"></i> Kelola Produk
      </a>
    </div>
    @endauth
  </div>
</section>


<!-- ===== PRODUK ===== -->
<section class="product-section" id="produk">
  <div class="container">
    <div class="text-center mb-2">
      <span class="section-label">Koleksi Kami</span>
      <h2 class="section-title">Daftar Produk Risol</h2>
      <div class="section-divider"><span class="section-divider-dot"></span></div>
    </div>

    @if($products->isEmpty())
      <div class="text-center py-5" style="color: var(--text-secondary);">
        <i class="bi bi-box-seam" style="font-size:3rem; opacity:0.4;"></i>
        <p class="mt-3">Belum ada produk. <a href="{{ route('products') }}" style="color:var(--risol-amber);">Tambahkan produk pertama Anda!</a></p>
      </div>
    @else
    <div class="row g-4">
      @foreach($products as $product)
      <div class="col-md-6 col-lg-4">
        <div class="product-card">
          <div class="product-image-wrapper">
            @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="width:100%;height:220px;object-fit:cover;">
            @else
              <div style="width:100%;height:220px;background:linear-gradient(135deg,#2a1a0e,#4a2c18);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-image" style="font-size:3rem;opacity:0.3;color:#f4a261;"></i>
              </div>
            @endif
            <span class="badge-rasa">{{ $product->varian }}</span>
          </div>
          <div class="product-body">
            <h5 class="product-title">{{ $product->name }}</h5>
            <p class="product-desc">{{ $product->description ?? 'Produk risol premium berkualitas tinggi.' }}</p>
            <div class="product-details">
              <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
              <p class="product-stock">Stok: <span class="stock-number">{{ $product->stock }}</span></p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn-risol flex-grow-1 btn-detail"
                data-nama="{{ $product->name }}" data-harga="Rp {{ number_format($product->price, 0, ',', '.') }}"
                data-stok="{{ $product->stock }}" data-varian="{{ $product->varian }}"
                data-deskripsi="{{ $product->description ?? 'Produk risol premium berkualitas tinggi.' }}">
                <i class="bi bi-eye"></i> Detail
              </button>
              <button class="btn-beli"><i class="bi bi-bag-plus"></i> Beli</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>


<!-- ===== MODAL DETAIL PRODUK ===== -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-risol">
        <h5 class="modal-title">Detail Produk</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="detail-container">
          <h4 id="modalNamaProduk" class="mb-3">—</h4>
          <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
              <h6 class="fw-bold text-muted">Varian</h6>
              <p id="modalVarian" class="fs-5 mb-0">—</p>
            </div>
            <div class="col-md-6">
              <h6 class="fw-bold text-muted">Harga</h6>
              <p id="modalHarga" class="fs-5 mb-0" style="color:var(--risol-amber);font-weight:700;">—</p>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
              <h6 class="fw-bold text-muted">Stok Tersedia</h6>
              <p id="modalStok" class="fs-5 mb-0">—</p>
            </div>
            <div class="col-md-6">
              <h6 class="fw-bold text-muted">Status</h6>
              <p class="mb-0"><span id="statusBadge" class="badge bg-secondary">—</span></p>
            </div>
          </div>
          <hr style="border-color:var(--border-soft);">
          <h6 class="fw-bold text-muted mb-2">Deskripsi Produk</h6>
          <p id="modalDeskripsi" style="color:var(--text-secondary);line-height:1.7;">—</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('script.js') }}"></script>
@endpush