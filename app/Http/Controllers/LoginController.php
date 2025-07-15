<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        Log::info('Mengakses halaman login');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            Log::info('Login berhasil', [
                'nama' => $request->nama,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->intended('/dashboard');
        }

        Log::warning('Login gagal', [
            'nama' => $request->nama,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors(['login' => 'Login gagal, cek nama atau password!']);
    }
}
