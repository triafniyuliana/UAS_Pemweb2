<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Halaman beranda toko
    public function index(Request $request)
    {
        $query = Product::where('is_visible', true);

        if ($request->filled('kategori')) {
            $category = Category::where('slug', $request->kategori)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view('store.index', compact('products', 'categories'));
    }


    // Detail produk
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_visible', true)->firstOrFail();
        return view('store.show', compact('product'));
    }

    // Produk berdasarkan kategori
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()
            ->where('is_visible', true)
            ->latest()
            ->get();

        return view('store.category', compact('category', 'products'));
    }
}
