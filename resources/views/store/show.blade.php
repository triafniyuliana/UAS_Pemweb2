<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Navigation Back Button -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('store.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                <span class="font-medium">Kembali ke Toko</span>

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

    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                <!-- Product Images -->
                <div class="space-y-4">
                    @if ($product->image_url)
                    <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-contain transition-transform duration-300 hover:scale-105">
                    </div>
                    @else
                    <div class="h-96 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-6xl"></i>
                    </div>
                    @endif

                    <!-- Thumbnails (placeholder - you can add multiple images here) -->
                    <div class="grid grid-cols-4 gap-2">
                        <div class="aspect-square bg-gray-200 rounded cursor-pointer border-2 border-indigo-400"></div>
                        <div class="aspect-square bg-gray-200 rounded cursor-pointer hover:border-indigo-200 border-2 border-transparent"></div>
                        <div class="aspect-square bg-gray-200 rounded cursor-pointer hover:border-indigo-200 border-2 border-transparent"></div>
                        <div class="aspect-square bg-gray-200 rounded cursor-pointer hover:border-indigo-200 border-2 border-transparent"></div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="flex flex-col">
                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>

                    <!-- Product Name -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                    <!-- Price -->
                    <div class="flex items-center mb-4">
                        <p class="text-2xl font-bold text-indigo-600">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if($product->discount > 0)
                        <span class="ml-3 px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">
                            {{ $product->discount }}% OFF
                        </span>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-6">
                        @if ($product->stock > 0)
                        <p class="text-green-600 font-medium flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Tersedia ({{ $product->stock }} stok)
                        </p>
                        @else
                        <p class="text-red-600 font-medium flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>
                            Stok habis
                        </p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Add to Cart -->
                    @if ($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-auto space-y-4">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                <div class="flex border rounded-md overflow-hidden">
                                    <button type="button" onclick="decrementQuantity()" class="px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                        class="w-16 px-2 py-2 text-center border-0 focus:ring-2 focus:ring-indigo-500">
                                    <button type="button" onclick="incrementQuantity()" class="px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium transition-colors flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                    @endif

                    <!-- Additional Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-gray-400 mr-2"></i>
                                <span>Garansi 1 Tahun</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-truck text-gray-400 mr-2"></i>
                                <span>Gratis Ongkir</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-undo text-gray-400 mr-2"></i>
                                <span>Pengembalian 14 Hari</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-headset text-gray-400 mr-2"></i>
                                <span>Dukungan 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Reviews Section (Placeholder) -->
        <div class="mt-12 bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ulasan Produk</h2>

                <!-- Rating Summary -->
                <div class="flex flex-col md:flex-row items-start md:items-center mb-8">
                    <div class="flex items-center mb-4 md:mb-0 md:mr-8">
                        <div class="text-5xl font-bold text-gray-900 mr-4">4.8</div>
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-gray-600 ml-2">(24 ulasan)</span>
                            </div>
                            <div class="text-sm text-gray-500">Berdasarkan 24 penilaian pelanggan</div>
                        </div>
                    </div>

                    <!-- Rating Distribution -->
                    <div class="flex-1 w-full">
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="w-10 text-sm text-gray-600">5 bintang</span>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-yellow-400 rounded-full" style="width: 80%"></div>
                                </div>
                                <span class="w-10 text-sm text-gray-600">80%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10 text-sm text-gray-600">4 bintang</span>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-yellow-400 rounded-full" style="width: 15%"></div>
                                </div>
                                <span class="w-10 text-sm text-gray-600">15%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-10 text-sm text-gray-600">3 bintang</span>
                                <div class="flex-1 mx-2 h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-yellow-400 rounded-full" style="width: 5%"></div>
                                </div>
                                <span class="w-10 text-sm text-gray-600">5%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review List -->
                <div class="space-y-6">
                    <!-- Sample Review 1 -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="font-medium">Budi Santoso</h4>
                        </div>
                        <p class="text-gray-600 mb-2">Produk sangat bagus, sesuai dengan deskripsi. Pengiriman cepat!</p>
                        <p class="text-sm text-gray-400">12 Juni 2023</p>
                    </div>

                    <!-- Sample Review 2 -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <h4 class="font-medium">Ani Wijaya</h4>
                        </div>
                        <p class="text-gray-600 mb-2">Kualitas produk baik, tapi pengiriman agak lama.</p>
                        <p class="text-sm text-gray-400">5 Mei 2023</p>
                    </div>
                </div>

                <!-- View All Reviews Button -->
                <button class="mt-6 px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 transition-colors">
                    Lihat Semua Ulasan
                </button>
            </div>
        </div>
    </div>

    <script>
        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            const max = parseInt(quantityInput.max);
            let value = parseInt(quantityInput.value);
            if (value < max) {
                quantityInput.value = value + 1;
            }
        }

        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        }
    </script>

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