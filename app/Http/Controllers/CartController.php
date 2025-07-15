<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('store.cart', compact('cart'));
    }

    // Tambahkan produk ke keranjang
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'quantity' => $request->input('quantity', 1),
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    // Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    // Checkout → Simpan ke tabel orders
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
        ]);

        foreach ($cart as $item) {
            Order::create([
                'order_id' => 'LOCAL-' . strtoupper(Str::random(8)),
                'product_id' => $item['product_id'],
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
                'status' => 'pending',
                'address' => $request->address,
            ]);
        }

        session()->forget('cart');
        return redirect('/')->with('success', 'Pesanan berhasil dikirim!');
    }

    // Kosongkan keranjang
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang dikosongkan');
    }

    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }
        return view('store.checkout', compact('cart'));
    }

    
}
