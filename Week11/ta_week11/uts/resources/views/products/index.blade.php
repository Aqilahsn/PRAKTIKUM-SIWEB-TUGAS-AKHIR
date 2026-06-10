@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-heading text-4xl font-bold text-gray-900">Manajemen Produk Gudang</h1>
            <p class="text-gray-600 mt-2">Kelola semua produk di gudang Anda</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn-primary flex items-center gap-2">
            <span>Tambah Produk</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Stok</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->sum('stok') }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Nilai Gudang</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">Rp {{ number_format($products->sum(fn($p) => $p->stok * $p->harga), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($products->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">Belum ada produk</p>
                <p class="text-gray-500 text-sm mt-1">Silakan tambahkan produk terlebih dahulu</p>
                <a href="{{ route('products.create') }}" class="btn-primary mt-4 inline-block">
                    Tambah Produk Pertama
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Kode Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Stok</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Harga</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Total Nilai</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Dibuat oleh</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($products as $index => $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->nama_produk }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-xs font-medium">{{ $product->kode_produk }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @if($product->stok > 0)
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm font-medium">{{ $product->stok }}</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm font-medium">Kosong</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Rp {{ number_format($product->stok * $product->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $product->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
