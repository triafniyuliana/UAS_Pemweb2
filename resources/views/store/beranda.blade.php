<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>TasMu Store - Toko Tas Premium</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-['Poppins'] text-gray-800 bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                <span class="text-xl font-bold text-gray-800">TasMu Store</span>
            </div>

            <!-- Centered Navigation Links -->
            <div class="hidden md:flex space-x-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="{{ route('store.index') }}" class="font-medium hover:text-pink-600">Beranda</a>
                <a href="#kategori" class="font-medium hover:text-pink-600">Kategori</a>
                <a href="#produk" class="font-medium hover:text-pink-600">Produk</a>
                <a href="#tentang" class="font-medium hover:text-pink-600">Tentang Kami</a>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <a href="#" class="p-2 rounded-full hover:bg-gray-100 relative">
                    <i class="fas fa-shopping-cart text-gray-600"></i>
                    <span class="absolute -top-1 -right-1 bg-pink-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>

                {{-- Tombol Login/Logout Customer --}}
                @auth('customer')
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200 text-sm">
                        Logout
                    </button>
                </form>
                @else
                <a href="{{ url('/login-customer') }}" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 text-sm">
                    Login
                </a>
                @endauth


                <!-- Toggle Menu Icon (for mobile) -->
                <button class="md:hidden p-2">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-gray-50 to-gray-100 py-16 md:py-24 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <!-- Text Content -->
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    Koleksi Tas <span class="text-pink-600">Premium</span> untuk Gaya Harianmu
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg mx-auto md:mx-0">
                    Temukan tas berkualitas tinggi dengan desain modern yang cocok untuk berbagai kesempatan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 mb-8">
                    <a href="#produk" class="px-8 py-3 bg-pink-600 text-white font-medium rounded-full hover:bg-pink-700 transition duration-300 shadow-lg hover:shadow-xl">
                        Belanja Sekarang
                    </a>
                    <a href="#tentang" class="px-8 py-3 border-2 border-gray-200 font-medium rounded-full hover:bg-gray-50 hover:border-gray-300 transition duration-300">
                        Tentang Kami
                    </a>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-6">
                    <div class="flex -space-x-3">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&h=100&q=80&facepad=3"
                            class="w-12 h-12 rounded-full border-2 border-white object-cover"
                            alt="Customer"
                            loading="lazy">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&h=100&q=80&facepad=3"
                            class="w-12 h-12 rounded-full border-2 border-white object-cover"
                            alt="Customer"
                            loading="lazy">
                        <img src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&h=100&q=80&facepad=3"
                            class="w-12 h-12 rounded-full border-2 border-white object-cover"
                            alt="Customer"
                            loading="lazy">
                    </div>
                    <div class="text-center sm:text-left">
                        <p class="text-sm font-medium">1.2K+ Pelanggan</p>
                        <div class="flex justify-center md:justify-start text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-gray-600 ml-1">4.8 (328 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Content -->
            <div class="md:w-1/2 relative mt-8 md:mt-0">
                <div class="relative rounded-xl overflow-hidden shadow-2xl aspect-[4/3]">
                    <img src="https://images.unsplash.com/photo-1591561954555-607968c989ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&h=600&q=80"
                        class="w-full h-full object-cover transition duration-500 hover:scale-105"
                        alt="Tas Wanita Premium"
                        loading="lazy">
                </div>

                <!-- Discount Badge -->
                <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-xl shadow-lg hidden md:block animate-bounce">
                    <div class="flex items-center">
                        <div class="bg-pink-100 p-3 rounded-full mr-3">
                            <i class="fas fa-tag text-pink-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Diskon Akhir Tahun</p>
                            <p class="font-bold text-lg text-pink-600">Hingga 40%</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Elements -->
                <div class="absolute -top-6 -right-6 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium hidden lg:block">
                    <i class="fas fa-bolt mr-1"></i> Bahan Tahan Lama
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-16 md:py-24 px-4 sm:px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Image -->
                <div class="lg:w-1/2">
                    <div class="relative rounded-xl overflow-hidden shadow-2xl aspect-[4/3]">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&h=600&q=80"
                            class="w-full h-full object-cover"
                            alt="TasMu Store Team"
                            loading="lazy">
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Tentang <span class="text-pink-600">TasMu Store</span></h2>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-pink-100 p-3 rounded-full mr-4 flex-shrink-0">
                                <i class="fas fa-medal text-pink-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Kualitas Premium</h3>
                                <p class="text-gray-600">Kami hanya menyediakan tas dengan bahan terbaik dan jahitan berkualitas tinggi yang tahan lama.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-pink-100 p-3 rounded-full mr-4 flex-shrink-0">
                                <i class="fas fa-palette text-pink-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Desain Eksklusif</h3>
                                <p class="text-gray-600">Setiap tas dirancang dengan gaya modern dan fungsional untuk memenuhi kebutuhan fashion Anda.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-pink-100 p-3 rounded-full mr-4 flex-shrink-0">
                                <i class="fas fa-heart text-pink-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Kepuasan Pelanggan</h3>
                                <p class="text-gray-600">Lebih dari 1,200 pelanggan telah mempercayakan kebutuhan tas mereka kepada kami.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('store.contact') }}" class="px-8 py-3 bg-pink-600 text-white font-medium rounded-full hover:bg-pink-700 transition duration-300 shadow-lg hover:shadow-xl mt-8 inline-block">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section id="kategori" class="py-16 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-3">Kategori Tas</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan tas sesuai kebutuhan Anda dari berbagai kategori pilihan</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('store.products.category', $category->name) }}"
                    class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition duration-300 hover:scale-105">
                    <div class="bg-pink-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="font-medium">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $category->products->count() }} produk</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Produk Terbaru Section -->
    <section id="produk" class="py-16 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold">Produk Terbaru</h2>
                    <p class="text-gray-600">Koleksi tas terbaru kami</p>
                </div>
                <a href="{{ route('store.products') }}" class="hidden md:block text-pink-600 font-medium hover:underline">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($products as $product)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 hover:-translate-y-1">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-60 object-cover" alt="{{ $product->name }}">
                        @if($product->stock > 0)
                        <div class="absolute top-3 right-3 bg-pink-600 text-white text-xs px-2 py-1 rounded-full">
                            Tersedia
                        </div>
                        @else
                        <div class="absolute top-3 right-3 bg-gray-600 text-white text-xs px-2 py-1 rounded-full">
                            Habis
                        </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg mb-1">{{ $product->name }}</h3>
                            <button class="text-gray-400 hover:text-pink-600">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <p class="text-gray-500 text-sm mb-3">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-pink-600 font-bold text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                @if($product->price_original > $product->price)
                                <p class="text-gray-400 text-sm line-through">Rp{{ number_format($product->price_original, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            <a href="{{ route('store.show', $product->id) }}" class="bg-pink-100 text-pink-600 p-2 rounded-full hover:bg-pink-600 hover:text-white transition">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <!-- Tombol Detail Produk -->
                        <div class="mt-4">
                            <a href="{{ route('store.show', $product->id) }}" class="w-full block text-center bg-white border border-pink-600 text-pink-600 py-2 px-4 rounded-lg hover:bg-pink-600 hover:text-white transition duration-300">
                                Detail Produk
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-12">
                    <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-600">Belum ada produk tersedia</h3>
                    <p class="text-gray-500 mt-2">Produk baru akan segera hadir</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <div class="text-center mt-10">
        <a href="{{ route('store.products') }}" class="md:hidden inline-block px-6 py-3 border border-pink-600 text-pink-600 font-medium rounded-full hover:bg-pink-600 hover:text-white transition">
            Lihat Semua Produk
        </a>
    </div>
    </div>
    </section>

    <!-- Testimoni -->
    <section class="py-16 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-3">Apa Kata Pelanggan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Testimoni dari pelanggan yang sudah membeli produk kami</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-500">1 minggu lalu</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Tasnya sangat berkualitas, bahannya nyaman dan desainnya kekinian. Pengiriman juga cepat!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" class="w-10 h-10 rounded-full mr-3" alt="Customer">
                        <div>
                            <p class="font-medium">Sarah Wijaya</p>
                            <p class="text-sm text-gray-500">Jakarta</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-sm text-gray-500">2 minggu lalu</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Saya sudah beli 3 tas disini, semuanya bagus dan tahan lama. Recomended banget!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-10 h-10 rounded-full mr-3" alt="Customer">
                        <div>
                            <p class="font-medium">Diana Putri</p>
                            <p class="text-sm text-gray-500">Bandung</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-500">3 hari lalu</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Packagingnya sangat rapi dan tasnya persis seperti di gambar. Puas banget belanja disini."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" class="w-10 h-10 rounded-full mr-3" alt="Customer">
                        <div>
                            <p class="font-medium">Rina Amelia</p>
                            <p class="text-sm text-gray-500">Surabaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-6 bg-pink-600 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Newsletter Kami</h2>
            <p class="text-pink-100 mb-8">Dapatkan update produk terbaru dan penawaran spesial langsung ke email Anda</p>

            <!-- Notifikasi berlangganan -->
            <div id="subscribe-notification" class="hidden mb-4 p-4 bg-white text-pink-600 font-medium rounded-lg max-w-md mx-auto"></div>

            <div class="flex flex-col sm:flex-row max-w-md mx-auto sm:max-w-xl gap-3">
                <input type="email" id="subscribe-email" placeholder="Alamat email Anda"
                    class="flex-grow px-4 py-3 rounded-full text-gray-800 focus:outline-none" required>
                <button id="subscribe-btn"
                    class="px-6 py-3 bg-white text-pink-600 font-medium rounded-full hover:bg-gray-100 transition shadow-lg">
                    Berlangganan
                </button>
            </div>
        </div>
    </section>

    <!-- JavaScript untuk notifikasi berlangganan -->
    <script>
        document.getElementById('subscribe-btn').addEventListener('click', function() {
            const emailInput = document.getElementById('subscribe-email');
            const notification = document.getElementById('subscribe-notification');

            // Validasi email
            if (!emailInput.value || !emailInput.checkValidity()) {
                notification.textContent = 'Masukkan alamat email yang valid!';
                notification.classList.remove('hidden');
                notification.classList.add('bg-red-100', 'text-red-600');
                return;
            }

            // Tampilkan notifikasi sukses
            notification.textContent = 'Terima kasih! Anda telah berhasil berlangganan newsletter kami.';
            notification.classList.remove('hidden', 'bg-red-100', 'text-red-600');
            notification.classList.add('bg-white', 'text-pink-600');

            // Kosongkan input
            emailInput.value = '';

            // Sembunyikan notifikasi setelah 5 detik
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000);
        });
    </script>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-shopping-bag text-2xl text-pink-600"></i>
                    <span class="text-xl font-bold">TasMu Store</span>
                </div>
                <p class="text-gray-400 mb-4">Toko tas premium dengan kualitas terbaik dan desain modern.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Beranda</a></li>
                    <li><a href="#produk" class="text-gray-400 hover:text-white">Produk</a></li>
                    <li><a href="#kategori" class="text-gray-400 hover:text-white">Kategori</a></li>
                    <li><a href="#tentang" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                    <li><a href="{{ route('store.contact') }}" class="text-gray-400 hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">Bantuan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Cara Pembelian</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Pengembalian</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Status Pesanan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Pembayaran</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">Kontak</h3>
                <ul class="space-y-2 text-gray-400">
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
        </div>

        <div class="max-w-7xl mx-auto border-t border-gray-800 mt-10 pt-6 text-center text-gray-400 text-sm">
            <p>© 2025 TasMu Store. All rights reserved.</p>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>
</body>

</html>