<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Kelas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Konten Utama -->
    <main class="flex-1 p-6">
        <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Form Tambah Kelas</h2>

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.kelas.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-semibold text-gray-700">Nama Kelas</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="w-full mt-1 p-2 border rounded bg-gray-50" required>
                    @error('nama')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                    Simpan Kelas
                </button>
            </form>
        </div>
    </main>
</body>

</html>
