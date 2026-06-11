<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $items = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('user.cart', compact('items', 'total', 'cart'));
    }

    /**
     * Add a product to the cart
     */
    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' ditambahkan ke keranjang.');
    }

    /**
     * Remove a product from the cart
     */
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' dihapus dari keranjang.');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->back()->with('success', 'Keranjang telah dikosongkan.');
    }

    /**
     * Update cart quantities
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantities', []) as $productId => $quantity) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }
}
