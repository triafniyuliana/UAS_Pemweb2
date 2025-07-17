<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

            {{-- Tombol untuk menambahkan produk baru --}}
            <a href="{{ route('products.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm mb-4">
                + Tambah Produk
            </a>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Pesan error --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">No</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Gambar</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Nama Produk</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Deskripsi</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Harga</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Stok</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">SKU</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Berat</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Status</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">On/Off</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 border-b">
                                    @if ($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="Gambar Produk" class="w-10 h-10 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b">{{ $product->name }}</td>
                                <td class="py-3 px-4 border-b text-sm">{{ Str::limit($product->description, 50) }}</td>
                                <td class="py-3 px-4 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 border-b">{{ $product->stock }}</td>
                                <td class="py-3 px-4 border-b">{{ $product->sku ?? '-' }}</td>
                                <td class="py-3 px-4 border-b">{{ $product->weight ?? '-' }} gr</td>
                                <td class="py-3 px-4 border-b text-green-600 font-semibold">Yes</td>
                                <td class="py-3 px-4 border-b">
                                    <form id="sync-product-{{ $product->id }}" action="{{ route('products.sync', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_active" id="is_active_{{ $product->id }}" value="{{ $product->hub_product_id ? 1 : 0 }}">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" id="toggle_{{ $product->id }}" {{ $product->hub_product_id ? 'checked' : '' }} onchange="
                                                document.getElementById('is_active_{{ $product->id }}').value = this.checked ? 0 : 1;
                                                document.getElementById('sync-product-{{ $product->id }}').submit();
                                            ">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer-checked:bg-blue-600 relative">
                                                <div class="absolute w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-full"></div>
                                            </div>
                                        </label>
                                    </form>
                                </td>
                                <td class="py-3 px-4 border-b whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-3 rounded">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk dari toko ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center py-4 text-gray-600">Belum ada data produk.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>