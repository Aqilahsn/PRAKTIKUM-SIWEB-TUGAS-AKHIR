@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h1 class="font-heading text-5xl italic tracking-wide text-gray-900 mb-2">Keranjang Belanja</h1>
    <p class="text-gray-600 text-lg">Selesaikan pesanan Anda di bawah ini.</p>
</div>

<div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
    @if($carts->count() > 0)
        <div class="overflow-x-auto mb-8">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="py-4 px-4 font-semibold text-gray-600">Produk</th>
                        <th class="py-4 px-4 font-semibold text-gray-600">Harga</th>
                        <th class="py-4 px-4 font-semibold text-gray-600 text-center">Kuantitas</th>
                        <th class="py-4 px-4 font-semibold text-gray-600">Subtotal</th>
                        <th class="py-4 px-4 font-semibold text-gray-600 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-5 px-4 font-medium text-gray-900 text-lg">{{ $cart->item->name }}</td>
                        <td class="py-5 px-4 text-gray-600">Rp {{ number_format($cart->item->price, 0, ',', '.') }}</td>
                        <td class="py-5 px-4 text-center font-bold">{{ $cart->quantity }}</td>
                        <td class="py-5 px-4 text-gray-900 font-bold">Rp {{ number_format($cart->item->price * $cart->quantity, 0, ',', '.') }}</td>
                        <td class="py-5 px-4 text-center">
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center bg-secondary/20 p-6 rounded-2xl">
            <div class="mb-4 md:mb-0">
                <h3 class="text-gray-600 font-medium">Total Pembayaran</h3>
                <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-gray-800 transition">
                    Checkout Sekarang
                </button>
            </form>
        </div>
    @else
        <div class="text-center py-16">
            <h3 class="text-2xl font-heading text-gray-800 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-500 mb-6">Anda belum memasukkan produk ke keranjang belanja.</p>
            <a href="{{ route('items.index') }}" class="bg-gray-900 text-white px-8 py-3 rounded-full inline-block font-semibold">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
