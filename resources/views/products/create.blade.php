<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
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

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                {{-- Nama Produk --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="name">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full border rounded p-2" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="price">Harga</label>
                    <input type="number" name="price" id="price" class="w-full border rounded p-2" value="{{ old('price') }}" required>
                </div>

                {{-- Stok --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="stock">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full border rounded p-2" value="{{ old('stock') }}" required>
                </div>

                {{-- SKU --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="sku">SKU (Opsional)</label>
                    <input type="text" name="sku" id="sku" class="w-full border rounded p-2" value="{{ old('sku') }}">
                </div>

                {{-- Berat --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="weight">Berat (gram)</label>
                    <input type="number" step="0.01" name="weight" id="weight" class="w-full border rounded p-2" value="{{ old('weight') }}">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                </div>

                {{-- Gambar --}}
                <div class="mb-4">
                    <label class="block mb-1 font-bold" for="image">Gambar</label>
                    <input type="file" name="image" id="image" class="w-full border p-2 rounded">
                </div>

                {{-- Tampilkan di toko --}}
                <div class="mb-4">
                    <label>
                        <input type="checkbox" name="is_visible" {{ old('is_visible', true) ? 'checked' : '' }}>
                        Tampilkan di toko
                    </label>
                </div>

                {{-- Tombol Simpan --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
