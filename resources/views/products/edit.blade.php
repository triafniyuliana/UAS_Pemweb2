<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        <div class="bg-white p-8 rounded shadow w-full">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-1 font-semibold">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block mb-1 font-semibold">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="price" class="block mb-1 font-semibold">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="stock" class="block mb-1 font-semibold">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sku" class="block mb-1 font-semibold">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('sku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="weight" class="block mb-1 font-semibold">Berat (gram)</label>
                        <input type="number" name="weight" id="weight" step="0.01"
                            value="{{ old('weight', $product->weight) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('weight') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if ($product->image)
                        <div class="md:col-span-2">
                            <label class="block mb-1 font-semibold">Gambar Saat Ini</label>
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif

                    <div class="md:col-span-2">
                        <label for="image" class="block mb-1 font-semibold">Ganti Gambar Produk</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Update Produk
                    </button>
                    <a href="{{ route('products.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
