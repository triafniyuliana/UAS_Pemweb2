<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Selamat datang, {{ auth()->user()->name }}!</h3>
                    <p class="mb-4">Silakan kelola toko Anda melalui menu berikut:</p>

                    <ul class="list-disc pl-5 space-y-2">
                        <li>
                            <a href="{{ route('categories.index') }}" class="text-blue-500 hover:underline">Kategori Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">Daftar Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.index') }}" class="text-blue-500 hover:underline">Lihat Pesanan Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>