<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($cart))
            <p class="text-gray-600">Keranjang kamu kosong.</p>
            <a href="{{ route('store.index') }}" class="text-indigo-600 hover:underline">← Kembali ke Toko</a>
        @else
            <table class="w-full mb-6 border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 text-left">Produk</th>
                        <th class="p-3 text-left">Jumlah</th>
                        <th class="p-3 text-left">Harga</th>
                        <th class="p-3 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($cart as $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $grandTotal += $subtotal; @endphp
                        <tr class="border-t">
                            <td class="p-3">{{ $item['name'] }}</td>
                            <td class="p-3">{{ $item['quantity'] }}</td>
                            <td class="p-3">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="p-3">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="text-xl font-bold mb-4">Total: Rp{{ number_format($grandTotal, 0, ',', '.') }}</p>

            <a href="{{ route('cart.checkout.form') }}"
               class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Checkout Sekarang
            </a>
        @endif
    </div>
</body>
</html>
