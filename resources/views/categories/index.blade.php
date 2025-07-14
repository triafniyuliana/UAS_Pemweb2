<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('successMessage'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('successMessage') }}
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <a href="{{ route('categories.create') }}"
               class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Kategori
            </a>

            {{-- Tabel --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Slug</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">On/Off</th> {{-- Tombol sinkron --}}
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($categories as $category)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->slug }}</td>
                                <td class="px-4 py-2">
                                    @if ($category->is_visible)
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Tampil</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-300 text-gray-800 rounded-full">Disembunyikan</span>
                                    @endif
                                </td>

                                {{-- Tombol On/Off Sinkron --}}
                                <td class="px-4 py-2">
                                    <form id="sync-category-{{ $category->id }}"
                                          action="{{ route('category.sync', $category->id) }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="is_active" value="{{ $category->hub_category_id ? 1 : 0 }}">
                                        @if ($category->hub_category_id)
                                            <flux:switch checked onchange="document.getElementById('sync-category-{{ $category->id }}').submit()" />
                                        @else
                                            <flux:switch onchange="document.getElementById('sync-category-{{ $category->id }}').submit()" />
                                        @endif
                                    </form>
                                </td>

                                {{-- Tombol Edit / Hapus --}}
                                <td class="px-4 py-2">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="text-blue-600 hover:underline mr-2">Edit</a>

                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
