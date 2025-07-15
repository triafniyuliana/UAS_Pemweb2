<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan untuk admin
     */
    public function index()
    {
        Log::info('Admin mengakses daftar pesanan');
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
            'status'        => 'nullable|string',
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

        Log::info('Pesanan diterima dari Hub', [
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
        ]);

        return response()->json(['message' => 'Order received'], 201);
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        Log::info('Status pesanan diperbarui', [
            'order_id' => $order->order_id,
            'dari' => $oldStatus,
            'ke' => $request->status,
        ]);

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

        $product = Product::findOrFail($data['product_id']);
        $total = $product->price * $data['quantity'];

        $order = Order::create([
            'order_id' => 'LOCAL-' . strtoupper(Str::random(8)),
            'product_id' => $product->id,
            'customer_name' => $data['customer_name'],
            'email' => $data['email'],
            'quantity' => $data['quantity'],
            'total_price' => $total,
            'status' => 'pending',
            'address' => $data['address'],
        ]);

        Log::info('Pesanan lokal disimpan', [
            'order_id' => $order->order_id,
            'product_id' => $order->product_id,
            'customer' => $order->customer_name,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim.');
    }
}
