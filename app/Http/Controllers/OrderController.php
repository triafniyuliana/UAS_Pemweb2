<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Product;



class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan untuk admin
     */
    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Menerima data pesanan dari Hub (webhook)
     */
    public function receiveOrderFromHub(Request $request)
    {
        $data = $request->validate([
            'order_id'      => 'required|string|unique:orders,order_id',
            'product_id'    => 'required|integer|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'email'         => 'nullable|email',
            'quantity'      => 'required|integer|min:1',
            'total_price'   => 'required|numeric|min:0',
            'status'        => 'nullable|string', // ex: pending, paid, shipped
            'address'       => 'nullable|string',
        ]);

        Order::create([
            'order_id'      => $data['order_id'],
            'product_id'    => $data['product_id'],
            'customer_name' => $data['customer_name'],
            'email'         => $data['email'] ?? null,
            'quantity'      => $data['quantity'],
            'total_price'   => $data['total_price'],
            'status'        => $data['status'] ?? 'pending',
            'address'       => $data['address'] ?? null,
        ]);

        return response()->json(['message' => 'Order received'], 201);
    }

    /**
     * Update status pesanan (opsional)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    /**
     * Simpan pesanan manual dari lokal
     */
    public function storeFromLocal(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'quantity' => 'required|integer|min:1',
            'address' => 'nullable|string|max:500',
        ]);

        $product = \App\Models\Product::findOrFail($data['product_id']);
        $total = $product->price * $data['quantity'];

        Order::create([
            'order_id' => 'LOCAL-' . strtoupper(Str::random(8)),
            'product_id' => $product->id,
            'customer_name' => $data['customer_name'],
            'email' => $data['email'],
            'quantity' => $data['quantity'],
            'total_price' => $total,
            'status' => 'pending',
            'address' => $data['address'],
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim.');
    }
}
