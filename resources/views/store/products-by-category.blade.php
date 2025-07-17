<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>Produk Kategori - TasMu Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .min-h-screen {
            min-height: 100vh;
        }
        .flex-grow {
            flex-grow: 1;
        }
    </style>
</head>
<body class="font-['Poppins'] bg-gray-50 h-full flex flex-col">
    <!-- Header Sederhana -->
    <header class="bg-white shadow-sm py-4 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('store.index') }}" class="flex items-center space-x-2">
                <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                <span class="text-xl font-bold">TasMu Store</span>
            </a>
            <a href="{{ route('store.products') }}" class="hidden md:block text-gray-600 hover:text-pink-600">
                Semua Produk
            </a>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-8 w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Produk Kategori: {{ request()->category }}</h1>
            <a href="{{ route('store.products') }}" class="text-pink-600 hover:underline">
                Lihat Semua Produk
            </a>
        </div>

        @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                    @if($product->stock > 0)
                    <span class="absolute top-2 right-2 bg-pink-600 text-white text-xs px-2 py-1 rounded-full">Tersedia</span>
                    @else
                    <span class="absolute top-2 right-2 bg-gray-600 text-white text-xs px-2 py-1 rounded-full">Habis</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold mb-1">{{ $product->name }}</h3>
                    <p class="text-pink-600 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('store.show', $product->id) }}" class="block mt-3 text-center bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-600">Tidak ada produk dalam kategori ini</p>
            <a href="{{ route('store.products') }}" class="mt-4 inline-block px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">
                Kembali ke Produk
            </a>
        </div>
        @endif
    </main>

    <!-- Footer yang tetap di bawah -->
    <footer class="bg-gray-800 text-white py-8 px-6 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                        <span class="text-xl font-bold">TasMu Store</span>
                    </div>
                    <p class="text-gray-400">Toko tas premium dengan kualitas terbaik dan desain modern.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-pink-600"></i>
                            <span>Jl. Contoh No. 123, Jakarta</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-pink-600"></i>
                            <span>+62 123 4567 890</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Sosial Media</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-tiktok text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 TasMu Store. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>