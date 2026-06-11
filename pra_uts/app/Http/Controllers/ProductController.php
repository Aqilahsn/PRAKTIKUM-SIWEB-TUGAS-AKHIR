<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products (Admin Dashboard)
     */
    public function index()
    {
        $products = Product::with('categories')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $product = Product::create($validated);

        // Attach categories to product
        if ($request->has('categories') && !empty($request->categories)) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $selectedCategories = $product->categories->pluck('id')->toArray();
        return view('admin.products.edit', compact('product', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified product in storage
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $product->update($validated);

        // Sync categories
        if ($request->has('categories') && !empty($request->categories)) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Display all products for users (Landing page)
     */
    public function userProducts()
    {
        $products = Product::with('categories')->paginate(12);
        return view('user.products', compact('products'));
    }
}
