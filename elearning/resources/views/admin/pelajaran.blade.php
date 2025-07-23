<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pelajaran untuk Kelas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Konten Utama -->
    <main class="flex-1 p-6">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Tambah Pelajaran untuk Kelas</h2>

            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.pelajaran.store') }}">
                @csrf

                <!-- Pilih Guru -->
                <div class="mb-4">
                    <label for="guru_id" class="block text-sm font-semibold text-gray-700">Pilih Guru</label>
                    <select name="guru_id" id="guru_id" class="w-full mt-1 p-2 border rounded bg-gray-50" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($guru as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Kelas -->
                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-semibold text-gray-700">Pilih Kelas</label>
                    <select name="kelas" id="kelas" class="w-full mt-1 p-2 border rounded bg-gray-50" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->nama }}" {{ old('kelas') == $k->nama ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Pelajaran -->
                <div class="mb-4">
                    <label for="nama_pelajaran" class="block text-sm font-semibold text-gray-700">Nama Pelajaran</label>
                    <input type="text" name="nama_pelajaran" id="nama_pelajaran"
                        class="w-full mt-1 p-2 border rounded bg-gray-50" value="{{ old('nama_pelajaran') }}" required>
                    @error('nama_pelajaran')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hari -->
                <div class="mb-4">
                    <label for="hari" class="block text-sm font-semibold text-gray-700">Hari</label>
                    <input type="text" name="hari" id="hari"
                        class="w-full mt-1 p-2 border rounded bg-gray-50" value="{{ old('hari') }}" required>
                    @error('hari')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam -->
                <div class="mb-4">
                    <label for="jam" class="block text-sm font-semibold text-gray-700">Jam</label>
                    <input type="text" name="jam" id="jam"
                        class="w-full mt-1 p-2 border rounded bg-gray-50" value="{{ old('jam') }}" required>
                    @error('jam')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition">
                        Simpan Pelajaran
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
