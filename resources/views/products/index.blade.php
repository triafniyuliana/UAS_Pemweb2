<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Produk
        </h2>
    </x-slot>

    {{-- Mulai konten halaman --}}
    <div class="py-4">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

            <a href="{{ route('products.create') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm mb-4">
                + Tambah Produk
            </a>

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
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
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Visibilitas</th>
                            <th class="py-2 px-4 border-b bg-gray-50 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 border-b">
                                @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="Gambar Produk"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                @else
                                <span class="text-gray-400 italic">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-3 px-4 border-b text-sm">{{ Str::limit($product->description, 50) }}</td>
                            <td class="py-3 px-4 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b">{{ $product->stock }}</td>
                            <td class="py-3 px-4 border-b">{{ $product->sku ?? '-' }}</td>
                            <td class="py-3 px-4 border-b">{{ $product->weight ?? '-' }} gr</td>

                            <td class="py-3 px-4 border-b">
                                <form id="sync-product-{{ $product->id }}" action="{{ route('products.sync', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="is_active" x-ref="is_active" value="{{ $product->hub_product_id ? 1 : 0 }}">

                                    <div x-data="{
            isOn: {{ $product->hub_product_id ? 'true' : 'false' }},
            toggle() {
                this.isOn = !this.isOn;
                this.$refs.is_active.value = this.isOn ? 0 : 1;
                document.getElementById('sync-product-{{ $product->id }}').submit();
            }
        }">
                                        <button
                                            type="button"
                                            x-on:click="toggle"
                                            :class="isOn ? 'bg-indigo-600' : 'bg-gray-300'"
                                            class="relative inline-flex h-6 w-11 rounded-full transition-colors duration-200 ease-in-out focus:outline-none"
                                            role="switch">
                                            <span
                                                :class="isOn ? 'translate-x-5' : 'translate-x-0'"
                                                class="inline-block h-5 w-5 transform bg-white rounded-full shadow transition"></span>
                                        </button>
                                        <!-- <div class="text-xs mt-1" x-text="isOn ? 'Ditampilkan' : 'Disembunyikan'"></div> -->
                                    </div>
                                </form>
                            </td>

                            <td class="py-3 px-4 border-b">
                                @if ($product->hub_product_id)
                                <div x-data="{
                                            isOn: {{ $product->is_visible ? 'true' : 'false' }},
                                            productId: {{ $product->id }},
                                            toggleVisibility() {
                                                const url = `/api/products/${this.productId}/toggle-visibility`;
                                                const csrfToken = document.querySelector('meta[name=csrf-token]').getAttribute('content');
                                                fetch(url, {
                                                    method: 'PUT',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'Accept': 'application/json',
                                                        'X-CSRF-TOKEN': csrfToken,
                                                    },
                                                    body: JSON.stringify({ is_on: this.isOn })
                                                })
                                                .then(response => {
                                                    if (!response.ok) {
                                                        return response.json().then(err => {
                                                            throw new Error(err.message || 'Gagal toggle visibilitas');
                                                        });
                                                    }
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    alert(data.message);
                                                })
                                                .catch(error => {
                                                    alert('Error: ' + error.message);
                                                    this.isOn = !this.isOn;
                                                });
                                            }
                                        }">
                                    <button
                                        x-on:click="isOn = !isOn; toggleVisibility()"
                                        :class="isOn ? 'bg-indigo-600' : 'bg-gray-200'"
                                        class="relative inline-flex h-6 w-11 rounded-full transition-colors focus:outline-none"
                                        role="switch">
                                        <span
                                            :class="isOn ? 'translate-x-5' : 'translate-x-0'"
                                            class="inline-block h-5 w-5 transform bg-white rounded-full shadow transition"></span>
                                    </button>
                                </div>
                                @else
                                <span class="text-red-500">Belum Disinkron</span>
                                @endif
                            </td>

                            <td class="py-3 px-4 border-b whitespace-nowrap">
                                @if (!$product->hub_product_id)
                                <button x-data="{ productId: {{ $product->id }} }"
                                    x-on:click="
                                                fetch(`/api/products/${productId}/sync-to-hub`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'Accept': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                    },
                                                    body: JSON.stringify({})
                                                })
                                                .then(res => res.json())
                                                .then(data => {
                                                    alert(data.message);
                                                    location.reload();
                                                })
                                                .catch(err => alert('Gagal: ' + err.message));"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                    SyncHub
                                </button>
                                @else
                                <button x-data="{ productId: {{ $product->id }} }"
                                    x-on:click="
                                                if (!confirm('Hapus produk dari Hub?')) return;
                                                fetch(`/api/products/${productId}/delete-from-hub`, {
                                                    method: 'DELETE',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'Accept': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                    }
                                                })
                                                .then(res => res.json())
                                                .then(data => {
                                                    alert(data.message);
                                                    location.reload();
                                                })
                                                .catch(err => alert('Gagal: ' + err.message));"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs ml-1">
                                    Hapus dari Hub
                                </button>
                                @endif
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs ml-1">
                                    Edit
                                </a>
                                {{-- Tombol Hapus dari Toko Lokal --}}
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk dari toko ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white text-xs px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>