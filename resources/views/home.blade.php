<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Semua Produk') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                        {{-- Gambar Produk --}}
                        @if ($product->image)
                            <img src="{{ asset('storage/images/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-600">
                                Tidak ada gambar
                            </div>
                        @endif

                        {{-- Info Produk --}}
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                            <p class="text-green-600 font-bold">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        Belum ada produk tersedia.
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
