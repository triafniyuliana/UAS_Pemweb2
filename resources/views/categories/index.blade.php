<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategori Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                    <div x-data="{ show: true }" x-show="show"
                        class="relative mb-4 p-4 pr-12 bg-green-100 text-green-800 rounded shadow">

                        {{-- Pesan teks --}}
                        <span>{{ session('success') }}</span>

                        {{-- Tombol silang di kanan atas --}}
                        <button @click="show = false"
                            class="absolute top-2 right-2 text-xl font-bold text-green-800 hover:text-red-600 focus:outline-none"
                            aria-label="Tutup">
                            &times;
                        </button>
                    </div>
                    @endif


                    {{-- Tombol tambah --}}
                    <div class="mb-4">
                        <a href="{{ route('categories.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded">
                            + Tambah Kategori
                        </a>
                    </div>

                    {{-- Tabel --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border border-gray-300 dark:border-gray-600">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Nama</th>
                                    <th class="px-4 py-2 border">Slug</th>
                                    <th class="px-4 py-2 border">Deskripsi</th>
                                    <th class="px-4 py-2 border text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                <tr class="border-t dark:border-gray-600">
                                    <td class="px-4 py-2 border">{{ $category->id }}</td>
                                    <td class="px-4 py-2 border">{{ $category->name }}</td>
                                    <td class="px-4 py-2 border">{{ $category->slug }}</td>
                                    <td class="px-4 py-2 border">{{ $category->description}}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada kategori.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>