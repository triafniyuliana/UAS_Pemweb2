<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6 text-pink-600">Daftar Customer</h2>

            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/register-customer') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>

                <div class="mb-6">
                    <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded-md hover:bg-pink-700 transition">Daftar</button>
                </div>

                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ url('/login-customer') }}" class="text-pink-600 hover:underline">Login di sini</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
