<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function beranda()
    {
        $categories = Category::where('is_active', true)->get();
        $products = Product::where('is_active', true)->latest()->take(6)->get();

        return view('store.beranda', compact('categories', 'products'));
    }

    public function products(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('store.products', compact('products'));
    }

    public function showProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('store.show', compact('product'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)
            ->with(['products' => function ($q) {
                $q->where('is_active', true);
            }])
            ->get();

        return view('store.categories', compact('categories'));
    }

    public function contact()
    {
        return view('store.contact');
    }

    public function productsByCategory($name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $products = Product::whereHas('category', function ($q) use ($name) {
            $q->where('name', $name);
        })->where('is_active', true)->latest()->paginate(12);

        return view('store.products-by-category', compact('products', 'category'));
    }
}
