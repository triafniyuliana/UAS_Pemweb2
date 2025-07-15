<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Formulir Checkout</h1>

        <form method="POST" action="{{ route('cart.checkout') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" name="customer_name" id="customer_name" required class="w-full px-3 py-2 border rounded">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="address" id="address" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Konfirmasi Pesanan
            </button>
        </form>

        <a href="{{ route('cart.index') }}" class="inline-block mt-4 text-sm text-indigo-600 hover:underline">
            ← Kembali ke Keranjang
        </a>
    </div>
</body>
</html>
