<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

            {{-- Gambar --}}
            <div>
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-auto rounded shadow">
            </div>

            {{-- Informasi Produk --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
                    {{ $product->name }}
                </h1>

                <p class="text-xl text-indigo-600 dark:text-indigo-400 font-semibold mb-3">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>

                @if ($product->stock > 0)
                    <p class="text-green-600 dark:text-green-400 font-medium mb-3">
                        Stok: {{ $product->stock }}
                    </p>
                @else
                    <p class="text-red-600 dark:text-red-400 font-medium mb-3">
                        Stok Habis
                    </p>
                @endif

                <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed">
                    {{ $product->description }}
                </p>

                <a href="{{ route('store.index') }}"
                   class="inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                    ← Kembali ke Toko
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
