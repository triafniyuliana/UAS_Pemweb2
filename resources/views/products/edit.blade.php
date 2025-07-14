<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="name">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ old('name', $product->name) }}" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full border rounded p-2" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="price">Harga</label>
                    <input type="number" name="price" id="price" class="w-full border rounded p-2" value="{{ old('price', $product->price) }}" required>
                </div>

                {{-- Stok --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="stock">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full border rounded p-2" value="{{ old('stock', $product->stock) }}" required>
                </div>

                {{-- SKU --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="sku">SKU</label>
                    <input type="text" name="sku" id="sku" class="w-full border rounded p-2" value="{{ old('sku', $product->sku) }}">
                </div>

                {{-- Berat --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="weight">Berat (gram)</label>
                    <input type="number" step="0.01" name="weight" id="weight" class="w-full border rounded p-2" value="{{ old('weight', $product->weight) }}">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div class="mb-4">
                    <label class="block font-bold mb-1" for="image">Ganti Gambar</label>
                    <input type="file" name="image" id="image" class="w-full border rounded p-2">

                    @if ($product->image_url)
                        <div class="mt-2">
                            <img src="{{ $product->image_url }}" alt="Gambar Produk" class="w-24 h-24 object-cover rounded shadow">
                            <p class="text-sm text-gray-600 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                </div>

                {{-- Visibilitas --}}
                <div class="mb-4">
                    <label>
                        <input type="checkbox" name="is_visible" {{ $product->is_visible ? 'checked' : '' }}>
                        Tampilkan di toko
                    </label>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Perbarui Produk
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
