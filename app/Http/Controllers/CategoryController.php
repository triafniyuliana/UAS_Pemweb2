<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Tampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => false,
            'hub_category_id' => null,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // Aktif/nonaktif kategori sekaligus update produk
    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        // Update semua produk dalam kategori ini
        $category->products()->update(['is_visible' => $category->is_active]);

        return redirect()->route('categories.index')->with('success', 'Status kategori & produk berhasil diperbarui.');
    }

    // Sinkronisasi kategori ke Hub
    public function sync(Request $request, Category $category)
    {
        $payload = [
            'client_id' => env('HUB_CLIENT_ID'),
            'client_secret' => env('HUB_CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => $category->is_active ? true : false,
        ];

        Log::info('Syncing category to HUB API', $payload);

        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', $payload);

        Log::info('HUB API Response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json()
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $response['product_category_id'];
            $category->save();

            // Sinkronisasi produk juga (opsional)
            $category->products()->update(['is_visible' => $category->is_active]);

            return redirect()->route('categories.index')->with('success', 'Sinkronisasi kategori berhasil.');
        }

        Log::error('Sinkronisasi kategori gagal.', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return redirect()->route('categories.index')->with('error', 'Sinkronisasi kategori gagal. Periksa log.');
    }
}
