<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Produk
            </a>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Gambar</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-left">SKU</th>
                            <th class="px-4 py-3 text-left">Stok</th>
                            <th class="px-4 py-3 text-left">Harga</th>
                            <th class="px-4 py-3 text-left">Berat</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Sinkronisasi</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">
                                @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="w-24 h-24 object-cover rounded">
                                @else
                                <div class="w-24 h-24 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                                    Tidak ada gambar
                                </div>
                                @endif

                            </td>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            <td class="px-4 py-2">{{ Str::limit($product->description, 50) }}</td>
                            <td class="px-4 py-2">{{ $product->sku ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $product->stock }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $product->weight ?? '-' }} gram</td>
                            <td class="px-4 py-2">
                                @if ($product->is_visible)
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Tampil</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold bg-gray-300 text-gray-800 rounded-full">Disembunyikan</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <form id="sync-product-{{ $product->id }}" action="{{ route('products.sync', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="is_active" value="{{ $product->hub_product_id ? 1 : 0 }}">
                                    @if($product->hub_product_id)
                                    <flux:switch checked onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                    @else
                                    <flux:switch onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                    @endif
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-3 text-gray-500">Belum ada produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout> -->