<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Pesanan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Order ID</th>
                                <th class="px-4 py-2">Produk</th>
                                <th class="px-4 py-2">Pembeli</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2">Qty</th>
                                <th class="px-4 py-2">Total Harga</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @forelse ($orders as $index => $order)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $order->order_id }}</td>
                                    <td class="px-4 py-2">{{ $order->product->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->customer_name }}</td>
                                    <td class="px-4 py-2">{{ $order->email ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $order->address ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                                    <td class="px-4 py-2">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 capitalize">
                                        <span class="px-2 py-1 rounded text-white
                                            {{ $order->status == 'paid' ? 'bg-green-500' :
                                               ($order->status == 'shipped' ? 'bg-blue-500' :
                                               ($order->status == 'cancelled' ? 'bg-red-500' : 'bg-yellow-500')) }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            <select name="status"
                                                    class="text-sm border-gray-300 rounded dark:bg-gray-700 dark:text-white"
                                                    onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada pesanan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
