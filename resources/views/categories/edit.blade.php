<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="w-full px-6 lg:px-10">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                {{-- Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Kategori --}}
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-200 mb-1">
                                Nama Kategori
                            </label>
                            <input type="text" name="name" id="name"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('name', $category->name) }}" required>
                        </div>

                        {{-- Checkbox Visibilitas --}}
                        <div class="flex items-center mt-6 md:mt-0">
                            <input type="checkbox" name="is_visible" id="is_visible" class="rounded"
                                {{ old('is_visible', $category->is_visible) ? 'checked' : '' }}>
                            <label for="is_visible" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                Tampilkan kategori di toko
                            </label>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('categories.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                            ← Kembali
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-semibold shadow">
                            Perbarui Kategori
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
