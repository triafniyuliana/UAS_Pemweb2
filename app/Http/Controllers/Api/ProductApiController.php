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
        $product->is_activee = !$product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => $product->is_active ? 'Produk ditampilkan' : 'Produk disembunyikan'
        ]);
    }

}
