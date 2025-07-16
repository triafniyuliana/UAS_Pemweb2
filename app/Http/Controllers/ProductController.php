<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\HubApiService;
use Illuminate\Support\Facades\DB;
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
        $isOn = $request->input('is_on');

        if (empty($product->hub_product_id)) {
            return response()->json([
                'message' => 'Product ID in Hub is missing. Please sync product first.'
            ], 400);
        }

        try {
            DB::beginTransaction();
            $hubResponse = $this->hubApiService->updateProductVisibility(
                $product->hub_product_id,
                ['is_visible' => $isOn]
            );

            $product->is_visible = $isOn;
            $product->save();
            DB::commit();

            return response()->json([
                'message' => 'Product visibility updated successfully.',
                'hub_response' => $hubResponse
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            DB::rollBack();
            $statusCode = $e->getCode();
            $responseBody = json_decode($e->getResponse()->getBody(), true);
            Log::error("API Hub Client Error: " . $e->getMessage() . " Response: " . json_encode($responseBody));
            return response()->json([
                'message' => 'Error from Hub API: ' . ($responseBody['message'] ?? 'Unknown error'),
                'status' => $statusCode
            ], $statusCode);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to toggle product visibility: " . $e->getMessage());
            return response()->json([
                'message' => 'Failed to toggle product visibility. ' . $e->getMessage()
            ], 500);
        }
    }

    public function syncProductToHub($id)
    {
        $product = Product::findOrFail($id);

        $response = Http::post(env('HUB_API_URL') . '/product/sync', [
            'client_id'         => env('HUB_CLIENT_ID'),
            'client_secret'     => env('HUB_CLIENT_SECRET'),
            'seller_product_id' => $product->id,
            'name'              => $product->name,
            'description'       => $product->description,
            'price'             => $product->price,
            'stock'             => $product->stock,
            'sku'               => $product->sku,
            'image_url'         => $product->image_url,
            'weight'            => $product->weight,
            'is_active'         => true,
            'category_id'       => $product->category->hub_category_id ?? null,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $product->hub_product_id = $data['product_id']
                ?? $data['data']['id']
                ?? $data['data']['product_id']
                ?? null;

            $product->is_visible = true;
            $product->save();

            Log::info('Response dari Hub:', $data);


            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil disinkronkan ke Hub.',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim produk ke Hub.',
                'error' => $response->body()
            ], 500);
        }
    }

    public function sync(Product $product)
    {
        $hubApiUrl = rtrim(env('HUB_API_URL'), '/') . '/product/sync';

        $response = Http::post($hubApiUrl, [
            'client_id' => env('HUB_CLIENT_ID'),
            'client_secret' => env('HUB_CLIENT_SECRET'),
            'seller_product_id' => (string) $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'sku' => $product->sku,
            'image_url' => $product->image_url,
            'weight' => $product->weight,
            'is_active' => $product->is_visible ? true : false,
            'category_id' => (string) ($product->category->hub_category_id ?? ''),
        ]);

        if ($response->successful() && isset($response['product_id'])) {
            $product->hub_product_id = $response['product_id'];
            $product->save();
            return redirect()->back()->with('success', 'Produk berhasil disinkronkan ke Hub.');
        } else {
            return redirect()->back()->with('error', 'Gagal sinkronisasi. Pesan: ' . $response->body());
        }
    }

    public function deleteProductFromHub(Request $request, Product $product)
    {
        if (empty($product->hub_product_id)) {
            return response()->json(['message' => 'Product ID in Hub is missing. Nothing to delete from Hub.'], 400);
        }

        try {
            DB::beginTransaction();
            $hubResponse = $this->hubApiService->deleteProduct($product->hub_product_id);
            $product->hub_product_id = null;
            $product->save();
            DB::commit();

            return response()->json([
                'message' => 'Product deleted from Hub successfully.',
                'hub_response' => $hubResponse
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            DB::rollBack();
            $statusCode = $e->getCode();
            $responseBody = json_decode($e->getResponse()->getBody(), true);
            Log::error("API Hub Client Error during delete: " . $e->getMessage() . " Response: " . json_encode($responseBody));
            return response()->json([
                'message' => 'Error from Hub API during delete: ' . ($responseBody['message'] ?? 'Unknown error'),
                'status' => $statusCode
            ], $statusCode);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete product from Hub: " . $e->getMessage());
            return response()->json(['message' => 'Failed to delete product from Hub. ' . $e->getMessage()], 500);
        }
    }

    public function syncManual(Request $request)
    {
        Log::info('SyncManual payload:', $request->all());

        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
            'seller_product_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'required',
            'image_url' => 'required|url',
            'weight' => 'required|numeric',
            'is_active' => 'required|boolean',
            'category_id' => 'required|integer'
        ]);

        $product = Product::updateOrCreate(
            ['sku' => $request->sku],
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'sku' => $request->sku,
                'image_url' => $request->image_url,
                'weight' => $request->weight,
                'is_visible' => $request->is_active,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Produk disimpan ke database lokal.',
            'data' => $product
        ]);
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
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|max:255',
            'weight'      => 'nullable|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        $imageUrl = null;

        if ($request->hasFile('image')) {
            // ✅ Bagian ini yang kamu maksud
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
            'image_url'   => $imageUrl, // ⬅️ Disimpan di database
            'is_visible'  => $request->has('is_visible'),
        ]);

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
