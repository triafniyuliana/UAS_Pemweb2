<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    {{-- Redirect ke beranda jika sudah login --}}
    @if (Auth::guard('customer')->check())
        <script>window.location.href = "{{ route('store.index') }}";</script>
    @endif

    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6 text-pink-600">Login Customer</h2>

            @if (session('error'))
                <div class="mb-4 text-red-600 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/login-customer') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded-md hover:bg-pink-700 transition">Login</button>
                </div>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Belum punya akun?
                    <a href="{{ url('/register-customer') }}" class="text-pink-600 hover:underline">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
