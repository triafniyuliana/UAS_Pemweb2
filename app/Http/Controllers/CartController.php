<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        Log::info('Menampilkan halaman keranjang', ['cart_count' => count($cart)]);
        return view('store.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
            Log::info('Menambah kuantitas produk di keranjang', [
                'product_id' => $id,
                'new_quantity' => $cart[$id]['quantity']
            ]);
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'quantity' => $request->input('quantity', 1),
            ];
            Log::info('Menambahkan produk baru ke keranjang', [
                'product_id' => $id,
                'quantity' => $cart[$id]['quantity']
            ]);
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            Log::info('Menghapus produk dari keranjang', ['product_id' => $id]);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            Log::warning('Checkout dibatalkan karena keranjang kosong');
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
        ]);

        foreach ($cart as $item) {
            $order = Order::create([
                'order_id' => 'LOCAL-' . strtoupper(Str::random(8)),
                'product_id' => $item['product_id'],
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
                'status' => 'pending',
                'address' => $request->address,
            ]);

            Log::info('Menyimpan order', [
                'order_id' => $order->order_id,
                'product_id' => $order->product_id,
                'customer_name' => $order->customer_name,
                'quantity' => $order->quantity,
                'total_price' => $order->total_price,
            ]);
        }

        session()->forget('cart');
        Log::info('Checkout berhasil, keranjang dikosongkan');
        return redirect('/')->with('success', 'Pesanan berhasil dikirim!');
    }

    public function clear()
    {
        session()->forget('cart');
        Log::info('Keranjang dikosongkan oleh user');
        return redirect()->back()->with('success', 'Keranjang dikosongkan');
    }

    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            Log::warning('User mencoba akses form checkout dengan keranjang kosong');
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }
        Log::info('Menampilkan halaman form checkout');
        return view('store.checkout', compact('cart'));
    }
}
