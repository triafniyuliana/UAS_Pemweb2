<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|max:255|unique:products,sku',
            'weight'      => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name',
            'description',
            'price',
            'stock',
            'sku',
            'weight',
            'category_id'
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['sku'])) {
            $data['sku'] = 'TAS-' . strtoupper(uniqid());
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_visible'] = false;
        $data['image_url'] = isset($data['image']) ? asset('storage/' . $data['image']) : null;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
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
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'weight'      => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only([
            'name',
            'description',
            'price',
            'stock',
            'sku',
            'weight',
            'category_id'
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (empty($data['sku'])) {
            $data['sku'] = 'TAS-' . strtoupper(uniqid());
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
            $data['image_url'] = asset('storage/' . $data['image']);
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function toggleStatus(Product $product)
    {
        $product->is_visible = !$product->is_visible;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Status product berhasil diubah.');
    }

    public function sync(Request $request, Product $product)
    {
        $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
            'client_id' => env('HUB_CLIENT_ID'),
            'client_secret' => env('HUB_CLIENT_SECRET'),
            'seller_product_id' => (string) $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'image_url' => $product->image ? $product->image : null,
            'is_active' => $product->is_visible == 1 ? true : false,
            'category_id' => (string) optional($product->category)->hub_category_id,
        ]);

        // Final
        if ($response->successful() && isset($response['product_id'])) {
            $product->hub_product_id = $request->is_visible == 1 ? null : $response['product_id'];
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Sinkronisasi product berhasil.');
    }
}
