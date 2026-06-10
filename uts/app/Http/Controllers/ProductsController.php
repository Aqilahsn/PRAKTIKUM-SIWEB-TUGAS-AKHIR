<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        // Hanya tampilkan produk jika user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Hanya admin yang dapat mengakses.');
        }
        
        $products = Product::with('user')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Cek role admin sebelum menampilkan form
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Hanya admin yang dapat mengakses.');
        }
        
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|unique:products,kode_produk',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'nama_produk' => $request->nama_produk,
            'kode_produk' => $request->kode_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kode_produk' => 'required|string|unique:products,kode_produk,' . $product->id,
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        $product->update([
            'nama_produk' => $request->nama_produk,
            'kode_produk' => $request->kode_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
