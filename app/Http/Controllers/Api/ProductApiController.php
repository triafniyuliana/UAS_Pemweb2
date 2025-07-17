<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
        public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->has('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->category);
                });
            })
            ->where('is_visibl', true)
            ->get();

        return response()->json($products);
    }

    public function toggleVisibility($id)
    {
        $product = Product::findOrFail($id);
        $product->is_visible = !$product->is_visible;
        $product->save();

        return response()->json([
            'success' => true,
            'is_visible' => $product->is_visible,
            'message' => $product->is_visible ? 'Produk ditampilkan' : 'Produk disembunyikan'
        ]);
    }

}
