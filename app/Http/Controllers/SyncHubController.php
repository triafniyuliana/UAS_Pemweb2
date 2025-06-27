<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Product;

class SyncHubController extends Controller
{
    public function syncProduct($id)
    {
        $store = Store::first(); // Ambil data toko

        if (!$store) {
            return response()->json(['error' => 'Toko belum terdaftar'], 404);
        }

        $product = Product::findOrFail($id);

        $response = Http::withHeaders([
            'Client-ID' => $store->client_id,
            'Client-Secret' => $store->client_secret,
        ])->post('https://phb-umkm.my.id/api/products', [
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'description' => $product->description,
        ]);

        return response()->json([
            'success' => $response->successful(),
            'message' => $response->body()
        ]);
    }
}