<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-5xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Gambar Produk --}}
        <div>
            @if ($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto rounded shadow">
            @else
                <div class="h-64 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        {{-- Informasi Produk --}}
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-indigo-600 text-xl font-semibold mb-2">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>
            <p class="text-sm text-gray-500 mb-4">Kategori: {{ $product->category->name ?? '-' }}</p>
            <p class="text-gray-700 mb-6">{{ $product->description }}</p>

            @if ($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="space-y-3">
                    @csrf
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                           class="w-24 px-3 py-2 border rounded">
                    <button type="submit" class="block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Tambah ke Keranjang
                    </button>
                </form>
            @else
                <p class="text-red-600 font-medium">Stok habis</p>
            @endif

            <a href="{{ route('store.index') }}" class="inline-block mt-4 text-sm text-indigo-600 hover:underline">
                ← Kembali ke Toko
            </a>
        </div>
    </div>
</body>
</html>
