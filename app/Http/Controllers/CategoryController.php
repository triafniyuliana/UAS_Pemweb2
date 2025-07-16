<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        Log::info('Menampilkan daftar kategori', ['total' => $categories->count()]);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        Log::info('Mengakses halaman form tambah kategori');
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_visible' => true,
        ]);

        Log::info('Kategori baru dibuat', ['id' => $category->id, 'name' => $category->name]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        Log::info('Menampilkan detail kategori', ['id' => $category->id]);
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        Log::info('Mengakses halaman edit kategori', ['id' => $category->id]);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_visible' => $request->has('is_visible'),
        ]);

        Log::info('Kategori diperbarui', ['id' => $category->id, 'name' => $category->name]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        Log::warning('Kategori akan dihapus', ['id' => $category->id, 'name' => $category->name]);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function sync($id, Request $request)
    {
        $category = Category::findOrFail($id);

        Log::info('Memulai sinkronisasi kategori', ['id' => $category->id]);

        try {
            $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
                'client_id' => env('client_26WPe0JJAUnF'),
                'client_secret' => env('BxjF0lgf3Ps1djhFwQ5OTwFXCRKZ12AowtknTrxq'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'is_active' => $request->is_active == 1 ? false : true,
            ]);

            if ($response->successful() && isset($response['product_category_id'])) {
                $category->hub_category_id = $request->is_active == 1 ? null : $response['product_category_id'];
                $category->save();
                Log::info('Sinkronisasi kategori berhasil', ['id' => $category->id, 'hub_id' => $category->hub_category_id]);
            } else {
                Log::warning('Sinkronisasi kategori gagal (tidak sukses atau tanpa product_category_id)', ['id' => $category->id, 'response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Gagal sinkronisasi kategori', ['id' => $category->id, 'error' => $e->getMessage()]);
        }

        session()->flash('successMessage', 'Category Synced Successfully');
        return redirect()->back();
    }
}
