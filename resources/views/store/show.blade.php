<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - TasMu Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $product->description }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="font-['Poppins'] bg-gray-50 h-full flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-sm py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('store.index') }}" class="flex items-center space-x-2">
                <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                <span class="text-xl font-bold">TasMu Store</span>
            </a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('store.products') }}" class="hidden md:block text-gray-600 hover:text-pink-600">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Produk
                </a>
                <a href="#" class="p-2 rounded-full hover:bg-gray-100 relative">
                    <i class="fas fa-shopping-cart text-gray-600"></i>
                    <span class="absolute -top-1 -right-1 bg-pink-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Konten -->
    <main class="flex-grow max-w-6xl mx-auto px-6 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">

            <!-- Gallery Produk -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-96 w-full">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition duration-300 hover:scale-105">
                    
                    <div class="absolute top-4 left-4 bg-gradient-to-r from-amber-500 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center">
                        <i class="fas fa-crown mr-1"></i> PREMIUM
                    </div>

                    @if($product->price < $product->price_original)
                        <div class="absolute top-4 right-4 bg-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                            DISKON {{ round(100 - ($product->price / $product->price_original * 100)) }}%
                        </div>
                    @endif
                </div>

                <!-- Thumbnail utama -->
                <div class="grid grid-cols-4 gap-2 p-4">
                    <div class="product-gallery-thumb active">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-20 object-cover">
                    </div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 text-gray-800">{{ $product->name }}</h1>

                <div class="flex items-center mb-4">
                    <div class="flex text-amber-400 mr-2">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-sm text-gray-500">4.8 (128 reviews)</span>
                </div>

                <div class="mb-6">
                    <p class="text-2xl md:text-3xl font-bold text-pink-600">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->price_original > $product->price)
                        <p class="text-gray-400 line-through">Rp{{ number_format($product->price_original, 0, ',', '.') }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Kategori</p>
                        <p class="font-medium">{{ $product->category->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Stok</p>
                        <p class="@if($product->stock > 0) text-green-600 @else text-red-600 @endif font-medium">
                            @if($product->stock > 0) {{ $product->stock }} tersedia @else Habis @endif
                        </p>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $product->description ?? 'Tas premium dengan bahan berkualitas tinggi dan desain eksklusif.' }}
                    </p>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-3">Spesifikasi</h3>
                    <ul class="space-y-2">
                        <li class="flex">
                            <span class="text-gray-500 w-32">Material</span>
                            <span class="font-medium">Kulit Sintetis Premium</span>
                        </li>
                        <li class="flex">
                            <span class="text-gray-500 w-32">Dimensi</span>
                            <span class="font-medium">25cm x 15cm x 10cm</span>
                        </li>
                        <li class="flex">
                            <span class="text-gray-500 w-32">Berat</span>
                            <span class="font-medium">450 gram</span>
                        </li>
                        <li class="flex">
                            <span class="text-gray-500 w-32">Warna</span>
                            <span class="font-medium">Hitam</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="flex-1 bg-pink-600 hover:bg-pink-700 text-white py-3 px-6 rounded-lg font-medium transition flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
                    </button>
                    <button class="flex-1 border border-pink-600 text-pink-600 hover:bg-pink-50 py-3 px-6 rounded-lg font-medium transition flex items-center justify-center">
                        <i class="fas fa-heart mr-2"></i> Wishlist
                    </button>
                </div>

                <div class="mt-6 p-4 bg-gray-50 rounded-lg flex items-start">
                    <i class="fas fa-shield-alt text-pink-600 text-xl mr-3 mt-1"></i>
                    <div>
                        <p class="font-medium">Garansi 1 Tahun</p>
                        <p class="text-sm text-gray-600">Garansi terhadap cacat produksi dan jahitan</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 px-6 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                        <span class="text-xl font-bold">TasMu Store</span>
                    </div>
                    <p class="text-gray-400 mb-4">Toko tas premium dengan kualitas terbaik dan desain modern.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-tiktok text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Kontak</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-pink-600"></i>
                            <span>Jl. Contoh No. 123, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-pink-600"></i>
                            <span>+62 123 4567 890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-pink-600"></i>
                            <span>hello@tasmu.store</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Layanan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Pengiriman</a></li>
                        <li><a href="#" class="hover:text-white">Pengembalian</a></li>
                        <li><a href="#" class="hover:text-white">Garansi</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                <p>&copy; 2025 TasMu Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp -->
    <a href="https://wa.me/6281234567890" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition z-50">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>
</body>
</html>