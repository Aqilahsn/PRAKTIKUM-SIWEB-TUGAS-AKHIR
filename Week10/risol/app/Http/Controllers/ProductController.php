<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Get all products
        $products = [
            [
                'id' => 1,
                'name' => 'Risol Matcha Premium',
                'varian' => 'Matcha',
                'price' => 12000,
                'stock' => 85
            ],
            [
                'id' => 2,
                'name' => 'Risol Coklat Lezat',
                'varian' => 'Coklat',
                'price' => 12000,
                'stock' => 120
            ],
            [
                'id' => 3,
                'name' => 'Risol Bolognese Istimewa',
                'varian' => 'Bolognese',
                'price' => 14000,
                'stock' => 95
            ],
            [
                'id' => 4,
                'name' => 'Risol Mozzarella Keju',
                'varian' => 'Mozzarella',
                'price' => 15000,
                'stock' => 110
            ],
            [
                'id' => 5,
                'name' => 'Risol Beef Premium',
                'varian' => 'Beef',
                'price' => 16000,
                'stock' => 75
            ],
            [
                'id' => 6,
                'name' => 'Risol Tiramisu Manis',
                'varian' => 'Tiramisu',
                'price' => 13000,
                'stock' => 105
            ]
        ];

        return view('manage', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'varian' => 'required|string',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|numeric|min:1'
        ]);

        // Di sini nantinya bisa save ke database
        // Product::create($request->all());

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string',
            'varian' => 'required|string',
            'price'  => 'required|numeric|min:1000',
            'stock'  => 'required|numeric|min:1',
        ]);

        // Di sini nantinya bisa update ke database
        // Product::findOrFail($id)->update($request->all());

        return redirect()->route('products')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Di sini nantinya bisa delete dari database
        // Product::findOrFail($id)->delete();

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus!');
    }
}
