<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="{{ route('store.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                    <i class="fas fa-store mr-2"></i>
                    <span class="font-medium">Toko Kami</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors">
                        <i class="fas fa-shopping-cart mr-1"></i>
                        <span>Keranjang</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-shopping-bag mr-3 text-indigo-600"></i>
                            Informasi Pembelian
                        </h1>
                    </div>

                    <form method="POST" action="{{ route('cart.checkout') }}" class="p-6 space-y-6">
                        @csrf

                        <!-- Customer Info Section -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-user-circle mr-2 text-indigo-500"></i>
                                Informasi Pelanggan
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap*</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" name="customer_name" id="customer_name" required
                                            class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            placeholder="Nama Anda">
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" id="email" required
                                            class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            placeholder="email@contoh.com">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon*</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="tel" name="phone" id="phone" required
                                        class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="0812-3456-7890">
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address Section -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-truck mr-2 text-indigo-500"></i>
                                Alamat Pengiriman
                            </h2>

                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap*</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea name="address" id="address" rows="3" required
                                        class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Jl. Contoh No. 123, Kota, Kode Pos"></textarea>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                    <select name="province" id="province" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten*</label>
                                    <select name="city" id="city" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Pilih Kota</option>
                                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                                        <option value="Bandung">Bandung</option>
                                        <option value="Semarang">Semarang</option>
                                        <option value="Surabaya">Surabaya</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos*</label>
                                    <input type="text" name="postal_code" id="postal_code" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="12345">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Section -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-credit-card mr-2 text-indigo-500"></i>
                                Metode Pembayaran
                            </h2>

                            <div class="space-y-3">
                                <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-indigo-400 cursor-pointer">
                                    <input type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500" checked>
                                    <label for="bank_transfer" class="ml-3 flex items-center">
                                        <img src="https://via.placeholder.com/40" alt="Bank Transfer" class="h-8 w-8 mr-2">
                                        <span class="block text-sm font-medium text-gray-700">Transfer Bank</span>
                                    </label>
                                </div>

                                <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-indigo-400 cursor-pointer">
                                    <input type="radio" name="payment_method" id="credit_card" value="credit_card" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500">
                                    <label for="credit_card" class="ml-3 flex items-center">
                                        <img src="https://via.placeholder.com/40" alt="Credit Card" class="h-8 w-8 mr-2">
                                        <span class="block text-sm font-medium text-gray-700">Kartu Kredit</span>
                                    </label>
                                </div>

                                <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-indigo-400 cursor-pointer">
                                    <input type="radio" name="payment_method" id="cod" value="cod" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500">
                                    <label for="cod" class="ml-3 flex items-center">
                                        <img src="https://via.placeholder.com/40" alt="COD" class="h-8 w-8 mr-2">
                                        <span class="block text-sm font-medium text-gray-700">Bayar di Tempat (COD)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <a href="{{ route('cart.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                <span class="font-medium">Kembali ke Keranjang</span>
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                                <i class="fas fa-lock mr-2"></i>
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-receipt mr-3 text-indigo-600"></i>
                            Ringkasan Pesanan
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Product List -->
                        <div class="space-y-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden bg-gray-200">
                                    <img src="https://via.placeholder.com/80" alt="Product" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">Nama Produk 1</h3>
                                    <p class="text-sm text-gray-500">1 x Rp120.000</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">Rp120.000</div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden bg-gray-200">
                                    <img src="https://via.placeholder.com/80" alt="Product" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">Nama Produk 2</h3>
                                    <p class="text-sm text-gray-500">2 x Rp75.000</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">Rp150.000</div>
                            </div>
                        </div>

                        <!-- Order Totals -->
                        <div class="space-y-3 border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp270.000</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span>Rp15.000</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Diskon</span>
                                <span class="text-green-600">-Rp10.000</span>
                            </div>
                            <div class="flex justify-between text-base font-medium text-gray-900 pt-2">
                                <span>Total Pembayaran</span>
                                <span>Rp275.000</span>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mt-6">
                            <label for="promo_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Promo</label>
                            <div class="flex">
                                <input type="text" name="promo_code" id="promo_code"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Masukkan kode">
                                <button type="button" class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition-colors">
                                    Gunakan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Info -->
                <div class="mt-4 bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-4 flex items-center">
                        <i class="fas fa-shield-alt text-green-500 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-700">Pembayaran aman dan terenkripsi</p>
                            <div class="flex mt-1 space-x-2">
                                <img src="https://via.placeholder.com/30" alt="Secure Payment" class="h-6">
                                <img src="https://via.placeholder.com/30" alt="Secure Payment" class="h-6">
                                <img src="https://via.placeholder.com/30" alt="Secure Payment" class="h-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>