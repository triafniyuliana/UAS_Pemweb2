<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <tr>
                        <th class="py-2 px-4 border-b">Nama Produk</th>
                        <th class="py-2 px-4 border-b">Harga</th>
                        <th class="py-2 px-4 border-b">Visibilitas</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-3 px-4 border-b">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-3 px-4 border-b">
                            @if ($product->hub_product_id)
                                <div x-data="{
                                    isOn: {{ $product->is_visible ? 'true' : 'false' }},
                                    toggleVisibility() {
                                        const url = `/api/products/{{ $product->id }}/toggle-visibility`;
                                        const csrfToken = document.querySelector('meta[name=csrf-token]').getAttribute('content');
                                        fetch(url, {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            body: JSON.stringify({ is_on: this.isOn })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            alert(data.message);
                                        })
                                        .catch(error => {
                                            console.error(error);
                                            alert('Gagal mengubah visibilitas.');
                                            this.isOn = !this.isOn;
                                        });
                                    }
                                }">
                                    <button
                                        @click="isOn = !isOn; toggleVisibility()"
                                        :class="isOn ? 'bg-green-500' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 items-center rounded-full transition">
                                        <span
                                            :class="isOn ? 'translate-x-6' : 'translate-x-1'"
                                            class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                                    </button>
                                </div>
                            @else
                                <span class="text-red-500 text-xs">Belum Disinkronkan</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b space-x-2">
                            @if (!$product->hub_product_id)
                                <button
                                    x-data
                                    @click="
                                        fetch(`/api/products/{{ $product->id }}/sync-to-hub`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                            },
                                            body: JSON.stringify({})
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            alert(data.message);
                                            location.reload();
                                        })
                                        .catch(err => {
                                            alert('Gagal sinkronisasi.');
                                            console.error(err);
                                        });
                                    "
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                    Sinkronkan
                                </button>
                            @else
                                <button
                                    x-data
                                    @click="
                                        if (!confirm('Yakin ingin menghapus produk dari Hub?')) return;
                                        fetch(`/api/products/{{ $product->id }}/delete-from-hub`, {
                                            method: 'DELETE',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                            }
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            alert(data.message);
                                            location.reload();
                                        })
                                        .catch(err => {
                                            alert('Gagal menghapus dari Hub.');
                                            console.error(err);
                                        });
                                    "
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Hapus dari Hub
                                </button>
                            @endif

                            <a href="{{ route('products.edit', $product->id) }}"
                               class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                                Tidak ada produk.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
