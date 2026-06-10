@extends('layouts.app')

@section('title', 'Kelola Produk — Risol Majesty')

@section('content')

<section class="manage-section">
  <div class="container">

    <div class="text-center mb-4" style="animation: fadeUp 0.5s ease both;">
      <span class="section-label">Manajemen</span>
      <h2 class="section-title" style="font-size: 1.5rem;">Kelola Produk Risol</h2>
      <div class="section-divider"><span class="section-divider-dot"></span></div>

      {{-- Badge Role User --}}
      <div class="mt-2">
        <span class="badge px-3 py-2" style="background: {{ auth()->user()->role === 'admin' ? 'linear-gradient(135deg,#e76f51,#f4a261)' : 'rgba(100,100,200,0.2)' }}; color:#fff; border-radius:99px; font-size:0.8rem;">
          <i class="bi bi-{{ auth()->user()->role === 'admin' ? 'shield-fill-check' : 'eye' }} me-1"></i>
          {{ auth()->user()->role === 'admin' ? 'Mode Admin — Akses Penuh CRUD' : 'Mode User — Hanya dapat melihat produk' }}
        </span>
      </div>
    </div>

    {{-- ===== FORM TAMBAH PRODUK (ADMIN ONLY) ===== --}}
    @if(auth()->user()->role === 'admin')
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 col-md-9">
        <div class="manage-card" style="animation: fadeUp 0.5s ease 0.1s both;">
          <div class="card-header-manage">
            <span class="header-sub">Formulir Produk</span>
            <h2 class="fw-bold">
              <i class="bi bi-plus-square me-2"></i>Tambah Produk Baru
            </h2>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger" style="border-radius:12px;">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form id="formProduk" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" novalidate>
              @csrf

              <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" placeholder="Contoh: Risol Matcha Premium" value="{{ old('name') }}" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Pilih Varian</label>
                <select class="form-select" name="varian" required>
                  <option value="">— Pilih Varian —</option>
                  @foreach(['Matcha','Coklat','Bolognese','Mozzarella','Beef','Tiramisu','Original','Keju'] as $v)
                    <option value="{{ $v }}" {{ old('varian') == $v ? 'selected' : '' }}>{{ $v }}</option>
                  @endforeach
                </select>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Harga Satuan (Rp)</label>
                  <input type="number" class="form-control" name="price" placeholder="Contoh: 12000" min="1000" step="500" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Jumlah Stok</label>
                  <input type="number" class="form-control" name="stock" placeholder="Contoh: 50" min="1" value="{{ old('stock') }}" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Deskripsi Produk (Opsional)</label>
                <textarea class="form-control" name="description" rows="2" placeholder="Deskripsi singkat produk...">{{ old('description') }}</textarea>
              </div>

              <div class="mb-4">
                <label class="form-label"><i class="bi bi-image me-1"></i>Upload Gambar Produk</label>
                <input type="file" class="form-control" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
                <small style="color: var(--text-secondary);">Format: JPG, PNG, GIF. Maks: 2MB</small>
              </div>

              <button type="submit" class="btn-submit-main w-100">
                <i class="bi bi-check-circle me-2"></i>Simpan Produk
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- ===== TABEL DAFTAR PRODUK ===== --}}
    <div style="animation: fadeUp 0.5s ease 0.2s both;">
      <h3 class="section-title mb-4" style="font-size:1.3rem;">
        <i class="bi bi-table me-2"></i>Daftar Produk
        <span class="badge ms-2" style="background: rgba(200,98,42,0.2); color: var(--risol-amber); border-radius:99px; font-size:0.75rem;">
          {{ $products->count() }} Produk
        </span>
      </h3>

      @if($products->isEmpty())
        <div class="text-center py-5" style="color: var(--text-secondary);">
          <i class="bi bi-box-seam" style="font-size:3rem; opacity:0.4;"></i>
          <p class="mt-3">Belum ada produk. Gunakan form di atas untuk menambahkan produk.</p>
        </div>
      @else
      <div class="table-responsive">
        <table class="table table-hover" style="color: var(--text-primary);">
          <thead>
            <tr style="border-bottom: 2px solid rgba(200,98,42,0.3);">
              <th>#</th>
              <th>Gambar</th>
              <th>Nama Produk</th>
              <th>Varian</th>
              <th>Harga</th>
              <th>Stok</th>
              @if(auth()->user()->role === 'admin')
              <th>Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($products as $index => $product)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>
                @if($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                       style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                @else
                  <div style="width:50px;height:50px;background:rgba(200,98,42,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-image" style="color:var(--risol-amber);opacity:0.5;"></i>
                  </div>
                @endif
              </td>
              <td><strong>{{ $product->name }}</strong></td>
              <td><span class="badge" style="background:rgba(200,98,42,0.2);color:var(--risol-amber);border-radius:99px;">{{ $product->varian }}</span></td>
              <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td>
                <span class="{{ $product->stock > 10 ? 'text-success' : 'text-danger' }} fw-bold">
                  {{ $product->stock }}
                </span>
              </td>
              @if(auth()->user()->role === 'admin')
              <td>
                <div class="d-flex gap-2">
                  {{-- Tombol Edit (trigger modal) --}}
                  <button class="btn btn-sm btn-outline-warning btn-edit"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-varian="{{ $product->varian }}"
                    data-price="{{ $product->price }}"
                    data-stock="{{ $product->stock }}"
                    data-description="{{ $product->description }}"
                    style="border-radius:8px;">
                    <i class="bi bi-pencil"></i>
                  </button>
                  {{-- Tombol Hapus --}}
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>

  </div>
</section>

{{-- ===== MODAL EDIT PRODUK (ADMIN ONLY) ===== --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-risol">
        <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Produk</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEdit" method="POST" action="" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="editName" name="name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Pilih Varian</label>
            <select class="form-select" id="editVarian" name="varian" required>
              @foreach(['Matcha','Coklat','Bolognese','Mozzarella','Beef','Tiramisu','Original','Keju'] as $v)
                <option value="{{ $v }}">{{ $v }}</option>
              @endforeach
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Harga Satuan (Rp)</label>
              <input type="number" class="form-control" id="editPrice" name="price" min="1000" step="500" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Jumlah Stok</label>
              <input type="number" class="form-control" id="editStock" name="stock" min="1" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="editDescription" name="description" rows="2"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label"><i class="bi bi-image me-1"></i>Ganti Gambar (Opsional)</label>
            <input type="file" class="form-control" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
            <small style="color: var(--text-secondary);">Kosongkan jika tidak ingin mengganti gambar.</small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-warning" onclick="document.getElementById('formEdit').submit()">
          <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
        </button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection

@push('scripts')
<script>
  // Handle tombol Edit — isi modal dengan data produk
  document.querySelectorAll('.btn-edit').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      document.getElementById('editName').value = this.dataset.name;
      document.getElementById('editPrice').value = this.dataset.price;
      document.getElementById('editStock').value = this.dataset.stock;
      document.getElementById('editDescription').value = this.dataset.description || '';

      const varianSelect = document.getElementById('editVarian');
      for (let opt of varianSelect.options) {
        opt.selected = opt.value === this.dataset.varian;
      }

      document.getElementById('formEdit').action = '/manage/' + id;
      const editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
    });
  });
</script>
@endpush