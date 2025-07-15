<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Toko Tas</h1>
            <a href="{{ route('cart.index') }}" class="text-sm text-indigo-600 hover:underline">🛒 Keranjang</a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 space-y-6">
        {{-- Filter & Pencarian --}}
        <form method="GET" action="{{ route('store.index') }}" class="flex flex-wrap gap-2 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                   class="flex-1 px-3 py-2 border rounded">
            <select name="kategori" class="px-3 py-2 border rounded">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Cari
            </button>
        </form>

        {{-- Daftar Produk --}}
        @if ($products->isEmpty())
            <p class="text-gray-500">Produk tidak ditemukan.</p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <a href="{{ route('store.show', $product->slug) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h2 class="text-lg font-bold">
                            <a href="{{ route('store.show', $product->slug) }}"
                               class="text-indigo-600 hover:underline">
                                {{ $product->name }}
                            </a>
                        </h2>
                        <p class="text-sm text-gray-500">{{ $product->category->name ?? '-' }}</p>
                        <p class="text-indigo-600 font-bold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
