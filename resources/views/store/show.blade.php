<!DOCTYPE html>
<html lang="id">
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
            </a>
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
</body>
</html>