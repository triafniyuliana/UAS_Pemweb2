<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    // Halaman beranda toko
    public function index(Request $request)
    {
        $query = Product::where('is_visible', true);

        if ($request->filled('kategori')) {
            $category = Category::where('slug', $request->kategori)->first();
            if ($category) {
                Log::info("Filter by category: {$category->name} (ID: {$category->id})");
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('q')) {
            Log::info("Search query: " . $request->q);
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->get();
        $categories = Category::all();
 
        return view('store.beranda', compact('products', 'categories'));
    }



    // Detail produk
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_visible', true)->firstOrFail();
        Log::info("Viewing product detail: {$product->name} (ID: {$product->id})");
        return view('store.show', compact('product'));
    }

    // Produk berdasarkan kategori
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        Log::info("Viewing category page: {$category->name} (ID: {$category->id})");

        $products = $category->products()
            ->where('is_visible', true)
            ->latest()
            ->get();

        return view('store.category', compact('category', 'products'));
    }
}
