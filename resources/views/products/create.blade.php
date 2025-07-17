<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6">
        <div class="bg-white p-8 rounded shadow w-full">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-1 font-semibold">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block mb-1 font-semibold">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="price" class="block mb-1 font-semibold">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="stock" class="block mb-1 font-semibold">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sku" class="block mb-1 font-semibold">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('sku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="weight" class="block mb-1 font-semibold">Berat (gram)</label>
                        <input type="number" name="weight" id="weight" value="{{ old('weight') }}" step="0.01"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('weight') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="image" class="block mb-1 font-semibold">Gambar Produk</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tampilkan di toko --}}
                <div class="mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_visible" {{ old('is_visible', true) ? 'checked' : '' }}
                            class="form-checkbox">
                        <span class="ml-2">Tampilkan di toko</span>
                    </label>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                        Simpan Produk
                    </button>
                    <a href="{{ route('products.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
