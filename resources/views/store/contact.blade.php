<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>Hubungi Kami - TasMu Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-['Poppins'] bg-gray-50 h-full flex flex-col">

    <!-- Header -->
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

    <!-- Konten -->
    <main class="flex-grow max-w-7xl mx-auto px-6 py-12 w-full">
        <h1 class="text-3xl font-bold text-center mb-12 text-pink-600">Hubungi Kami</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Info Kontak -->
            <div class="bg-white shadow rounded-xl p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-pink-600">Informasi Kontak</h2>
                    <div class="space-y-4 text-gray-700">
                        <div class="flex items-start gap-4">
                            <i class="fas fa-map-marker-alt text-pink-600 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Alamat Toko</h3>
                                <p>Jl. Contoh No. 123, Jakarta Selatan</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <i class="fas fa-phone-alt text-pink-600 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Telepon</h3>
                                <p>+62 123 4567 890</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <i class="fas fa-envelope text-pink-600 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Email</h3>
                                <p>hello@tasmu.store</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <i class="fas fa-clock text-pink-600 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Jam Operasional</h3>
                                <p>Senin–Jumat: 08.00 - 17.00</p>
                                <p>Sabtu: 09.00 - 15.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-4 text-pink-600">Kirim Pesan</h2>

                <div id="notification" class="hidden mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg"></div>

                <form id="contactForm">
                    <div class="mb-4">
                        <label for="name" class="block font-medium mb-1">Nama Lengkap</label>
                        <input type="text" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block font-medium mb-1">Email</label>
                        <input type="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block font-medium mb-1">Nomor Telepon</label>
                        <input type="tel" id="phone" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block font-medium mb-1">Subjek</label>
                        <input type="text" id="subject" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block font-medium mb-1">Pesan Anda</label>
                        <textarea id="message" class="w-full border border-gray-300 rounded-lg px-4 py-2 h-32 resize-none" required></textarea>
                    </div>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- notifikasi -->
            <script>
                document.getElementById('contactForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const notification = document.getElementById('notification');
                    notification.textContent = 'Pesan Anda telah berhasil terkirim!';
                    notification.classList.remove('hidden');

                    this.reset();

                    setTimeout(() => {
                        notification.classList.add('hidden');
                    }, 5000);
                });
            </script>

            <!-- Map -->
            <div class="mt-16">
                <h2 class="text-xl font-semibold mb-4 text-pink-600">Lokasi Kami</h2>
                <div class="rounded-xl overflow-hidden shadow">
                    <iframe class="w-full h-96" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.81956135063986!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1629997986916!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
    </main>

    <!-- Footer -->
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