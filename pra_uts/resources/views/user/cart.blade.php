@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

<div style="margin-bottom: 40px;">
    <h2 class="section-title">Keranjang Belanja</h2>
    <p class="section-subtitle">Kelola dan checkout produk pilihan Anda</p>
</div>

<div class="row">
    <div class="col-lg-8">
        @if(count($items) > 0)
            <div class="table-responsive" style="background: white; border-radius: 12px; padding: 20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item['product']->name }}</strong>
                                    <br>
                                    <small style="color: #718096;">
                                        @foreach($item['product']->categories as $category)
                                            <span class="category-badge">{{ $category->name }}</span>
                                        @endforeach
                                    </small>
                                </td>
                                <td>
                                    <strong style="color: #667eea;">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <div style="display: flex; gap: 5px;">
                                            <input type="number" name="quantities[{{ $item['product']->id }}]" class="form-control" style="width: 70px; padding: 8px;" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}">
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <strong style="color: #667eea; font-size: 16px;">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('home') }}" class="btn btn-secondary">← Lanjut Belanja</a>
            </div>
        @else
            <div class="empty-state" style="background: white; border-radius: 12px; padding: 60px 20px;">
                <div class="empty-state-icon"></div>
                <h3 class="empty-state-title">Keranjang Kosong</h3>
                <p class="empty-state-text">Belum ada produk di keranjang Anda. Mari mulai berbelanja sekarang!</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Mulai Berbelanja</a>
            </div>
        @endif
    </div>

    <div class="col-lg-4">
        @if(count($items) > 0)
            <div style="background: linear-gradient(135deg, #D38C9D 0%, #A55166 100%); border-radius: 12px; padding: 25px; color: white; position: sticky; top: 100px;">
                <h5 style="font-size: 20px; font-weight: 700; margin-bottom: 20px;">Ringkasan Pesanan</h5>
                <hr style="border-color: rgba(255,255,255,0.2); margin: 15px 0;">
                
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Jumlah Item:</span>
                        <strong>{{ count($cart) }} Produk</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700;">
                        <span>Total:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <hr style="border-color: rgba(255,255,255,0.2); margin: 15px 0;">

                <div style="display: grid; gap: 10px;">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light w-100" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</button>
                    </form>

                    <button class="btn btn-light w-100" style="font-weight: 700; color: #D38C9D;">Lanjut ke Pembayaran</button>
                </div>

                <div style="margin-top: 20px; font-size: 12px; opacity: 0.9;">
                    <p style="margin: 0;">Aman dan terpercaya</p>
                    <p style="margin: 0;">Pengiriman cepat</p>
                    <p style="margin: 0;">Privasi terjamin</p>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
