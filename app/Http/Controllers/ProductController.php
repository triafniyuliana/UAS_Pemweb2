<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\HubApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    protected $hubApiService;

    public function __construct(HubApiService $hubApiService)
    {
        $this->hubApiService = $hubApiService;
    }

    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function toggleVisibility(Request $request, Product $product)
    {
        $request->validate([
            'is_on' => 'required|boolean',
        ]);

        $product->is_visible = $request->is_on;
        $product->save();

        return response()->json(['message' => 'Status produk berhasil diperbarui']);
    }

    public function sync($id, Request $request)
    {
        $product = Product::findOrFail($id);

        if ($request->is_active == 1) {
            // OFF: hapus dari Hub, kosongkan hub_product_id
            $product->hub_product_id = null;
            $product->save();
            session()->flash('successMessage', 'Produk dinonaktifkan dari Hub.');
        } else {
            // ON: sinkron ke Hub
            $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image_url,
                'weight' => $product->weight,
                'is_active' => true,
                'category_id' => (string) $product->category->hub_category_id,
            ]);

            Log::info('CLIENT_ID:', [env('CLIENT_ID')]);
            Log::info('CLIENT_SECRET:', [env('CLIENT_SECRET')]);


            if ($response->successful() && isset($response['product_id'])) {
                $product->hub_product_id = $response['product_id'];
                $product->save();
                session()->flash('successMessage', 'Produk berhasil disinkron ke Hub.');
            } else {
                session()->flash('error', 'Gagal sinkronisasi produk ke Hub.');
            }
        }

        return redirect()->back();
    }



    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $imageUrl = asset('storage/' . $imagePath);
        }

        Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'sku'         => $request->sku,
            'weight'      => $request->weight,
            'image_url'   => $imageUrl,
            'is_visible'  => false,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function create()
    {
        $categories = \App\Models\Category::all(); // ambil semua kategori untuk dropdown
        return view('products.create', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageUrl = $product->image_url;
        if ($request->hasFile('image')) {
            if ($product->image_url) {
                $oldImage = str_replace(asset('storage/'), '', $product->image_url);
                Storage::disk('public')->delete($oldImage);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $imageUrl = asset('storage/' . $imagePath);
        }

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'sku'         => $request->sku,
            'weight'      => $request->weight,
            'image_url'   => $imageUrl,
            'is_visible'  => $request->has('is_visible'),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            $imageFile = str_replace(asset('storage/'), '', $product->image_url);
            Storage::disk('public')->delete($imageFile);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
