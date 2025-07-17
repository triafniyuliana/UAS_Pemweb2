<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasmu - Toko Tas Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Header dengan gradient dan animasi -->
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shopping-bag text-white text-2xl"></i>
                    <h1 class="text-2xl font-bold text-white">Tas<span class="font-light">Mu</span></h1>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                        <i class="fas fa-heart"></i>
                        <span class="hidden md:inline ml-1">Favorit</span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative text-white hover:text-gray-200 transition duration-300">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hidden md:inline ml-1">Keranjang</span>
                        <span class="absolute -top-2 -right-2 bg-yellow-400 text-xs text-gray-900 font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-indigo-50 to-purple-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Koleksi Tas Eksklusif Musim Ini</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan tas berkualitas tinggi dengan desain elegan untuk setiap kesempatan</p>
                <a href="#products" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-full transition duration-300 transform hover:scale-105">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="products">
        <!-- Filter & Pencarian dengan card -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('store.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk tas..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </form>
        </div>

        <!-- Kategori Populer -->
        <div class="mb-10">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Kategori Populer</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                <a href="#" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition duration-300 border border-gray-100 hover:border-indigo-300">
                    <div class="bg-indigo-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-briefcase text-indigo-600"></i>
                    </div>
                    <span class="text-sm font-medium">Tas Kerja</span>
                </a>
                <a href="#" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition duration-300 border border-gray-100 hover:border-indigo-300">
                    <div class="bg-pink-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-shopping-bag text-pink-600"></i>
                    </div>
                    <span class="text-sm font-medium">Tas Tangan</span>
                </a>
                <a href="#" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition duration-300 border border-gray-100 hover:border-indigo-300">
                    <div class="bg-green-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-passport text-green-600"></i>
                    </div>
                    <span class="text-sm font-medium">Tas Travel</span>
                </a>
                <a href="#" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition duration-300 border border-gray-100 hover:border-indigo-300">
                    <div class="bg-yellow-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-laptop text-yellow-600"></i>
                    </div>
                    <span class="text-sm font-medium">Tas Laptop</span>
                </a>
                <a href="#" class="bg-white rounded-lg shadow-sm p-4 text-center hover:shadow-md transition duration-300 border border-gray-100 hover:border-indigo-300">
                    <div class="bg-purple-100 w-12 h-12 mx-auto rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-tshirt text-purple-600"></i>
                    </div>
                    <span class="text-sm font-medium">Tas Ransel</span>
                </a>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Produk Terbaru</h3>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    Lihat Semua <i class="fas fa-chevron-right ml-1 text-sm"></i>
                </a>
            </div>

            @if ($products->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                    <h4 class="text-xl font-medium text-gray-600 mb-2">Produk tidak ditemukan</h4>
                    <p class="text-gray-500 mb-4">Coba gunakan kata kunci atau filter yang berbeda</p>
                    <a href="{{ route('store.index') }}" class="text-indigo-600 hover:underline font-medium">
                        <i class="fas fa-undo mr-1"></i> Reset Pencarian
                    </a>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <a href="{{ route('store.show', $product->slug) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                     class="w-full h-64 object-cover">
                            </a>
                            <div class="absolute top-3 right-3">
                                <button class="bg-white rounded-full p-2 shadow-md text-gray-500 hover:text-red-500 transition duration-300">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            @if($product->is_new)
                                <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    BARU
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-1">
                                <a href="{{ route('store.show', $product->slug) }}"
                                   class="text-lg font-bold text-gray-800 hover:text-indigo-600 transition duration-300">
                                    {{ $product->name }}
                                </a>
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2 py-0.5 rounded">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </div>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-500 text-xs ml-1">(24)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-indigo-600 font-bold text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <button class="bg-indigo-100 hover:bg-indigo-200 text-indigo-800 p-2 rounded-full transition duration-300">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Banner Promo -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl shadow-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row">
                <div class="p-8 md:p-10 flex-1 text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3">Diskon Akhir Tahun</h3>
                    <p class="text-purple-100 mb-5">Dapatkan diskon hingga 30% untuk semua produk tas pilihan</p>
                    <a href="#" class="inline-block bg-white text-indigo-600 font-medium py-2 px-6 rounded-full hover:bg-gray-100 transition duration-300">
                        Lihat Promo
                    </a>
                </div>
                <div class="hidden md:block flex-1">
                    <img src="https://images.unsplash.com/photo-1590874103328-eac38a683ce7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Promo Tas" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">Tasmu</h4>
                    <p class="text-gray-400 text-sm">Tas berkualitas tinggi dengan desain elegan untuk gaya hidup modern.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Produk</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Promo</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Tentang Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Panduan Ukuran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Pengembalian</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Pembayaran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2"></i> +62 123 4567 890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i> hello@Tasmu.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2023 Tasmu. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>