<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Tambah Produk
            </a>

            <table class="table-auto w-full border border-collapse border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-sm text-gray-700">
                        <th class="border px-4 py-2">Gambar</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">SKU</th>
                        <th class="border px-4 py-2">Berat</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Sinkron</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="text-sm">
                            <td class="border px-4 py-2 text-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar" class="w-20 h-20 object-cover rounded">
                                @else
                                    <span class="text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 font-semibold">{{ $product->name }}</td>
                            <td class="border px-4 py-2 text-gray-600">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</td>
                            <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                            <td class="border px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ $product->stock }}</td>
                            <td class="border px-4 py-2 text-center">{{ $product->sku ?? '-' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $product->weight ?? '-' }} gr</td>

                            {{-- Status --}}
                            <td class="border px-4 py-2 text-center">
                                <form action="{{ route('products.toggleStatus', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded text-white {{ $product->is_active ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Sinkronisasi --}}
                            <td class="border px-4 py-2 text-center">
                                <form action="{{ route('products.sync', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded text-white bg-green-600 hover:bg-green-700">
                                        Sinkronkan
                                    </button>
                                </form>
                            </td>

                            {{-- Aksi --}}
                            <td class="border px-4 py-2 whitespace-nowrap">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:underline mr-2"> Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-gray-600">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>