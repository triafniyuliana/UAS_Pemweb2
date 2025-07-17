<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Order') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white p-6 rounded-lg shadow-md w-full mx-auto">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">No. Order</th>
                            <th class="px-4 py-3 text-left font-semibold">Total</th>
                            <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                            <th class="px-4 py-3 text-left font-semibold">Item</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    {{ $order->shipping_address }},
                                    {{ $order->shipping_city }},
                                    {{ $order->shipping_province }} {{ $order->shipping_postal_code }}
                                </td>
                                <td class="px-4 py-3">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($order->items as $item)
                                            <li>Produk ID: {{ $item->product_id }} ({{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Belum ada order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
