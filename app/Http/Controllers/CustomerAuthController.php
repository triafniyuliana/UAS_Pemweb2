<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke halaman beranda setelah login
            return redirect()->route('store.index'); // Sesuai route beranda kamu
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman beranda store.index setelah logout
        return redirect()->route('store.index');
    }



    public function showLoginForm()
    {
        return view('customer.customer');
    }

    public function showRegisterForm()
    {
        return view('customer.customer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|confirmed'
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login-customer')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
