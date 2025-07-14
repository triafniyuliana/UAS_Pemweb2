<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Beranda Toko</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <h1 class="text-2xl font-bold">Toko Online</h1>

            {{-- Form Pencarian --}}
            <form action="{{ route('store.index') }}" method="GET" class="flex flex-wrap gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                    class="px-3 py-2 border rounded w-48">
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

            {{-- Autentikasi --}}
            <div class="flex items-center gap-3">
                @guest
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm text-white bg-indigo-600 px-3 py-1 rounded hover:bg-indigo-700">Daftar</a>
                @else
                <span class="text-sm">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">Keluar</button>
                </form>
                @endguest
            </div>
        </div>
    </header>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-xl font-semibold mb-4">Produk Tersedia</h2>

            @if ($products->isEmpty())
            <p class="text-gray-500">Produk tidak ditemukan.</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
                    @if ($product->image_url)
                    <img src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-auto rounded shadow">
                    @else
                    <div class="text-gray-400 italic">Tidak ada gambar</div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-bold mb-1">
                            <a href="{{ route('store.show', $product->slug) }}" class="text-indigo-600 hover:underline">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mb-1">
                            Kategori: {{ $product->category->name ?? '-' }}
                        </p>
                        <p class="text-indigo-600 font-bold">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

</body>

</html>