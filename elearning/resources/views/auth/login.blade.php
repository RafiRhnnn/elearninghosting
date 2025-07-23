<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login E-Learning</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-md flex w-full max-w-6xl overflow-hidden">
        <!-- Ilustrasi kiri -->
        <div class="w-1/2 bg-blue-100 flex items-center justify-center">
            <img src="{{ asset('img/login-illustration.png') }}" alt="Ilustrasi Login" class="max-w-full h-auto">
        </div>

        <!-- Form kanan -->
        <div class="w-1/2 p-10 flex flex-col justify-center">
            <div class="mb-6 text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-24 mx-auto mb-3">
                <h2 class="text-2xl font-bold">Log in E-Learning</h2>
                <p class="text-sm text-gray-600 mt-2">Selamat Datang kembali, silahkan login ke akun Anda untuk
                    melanjutkan</p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full rounded-md bg-blue-50 border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md bg-blue-50 border-gray-300 shadow-sm focus:ring focus:ring-blue-300 focus:outline-none pr-10">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-sm text-gray-500">
                            👁️
                        </button>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>

</html>
