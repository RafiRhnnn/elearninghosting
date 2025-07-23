<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pelajaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('admin.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Edit Pelajaran</h2>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.kelola_pelajaran.update', $pelajaran->id) }}">
                @csrf
                @method('PUT')

                <!-- Pilih Guru -->
                <div class="mb-4">
                    <label for="guru_id" class="block text-sm font-semibold text-gray-700">Pilih Guru</label>
                    <select name="guru_id" id="guru_id" class="w-full p-2 border rounded bg-gray-50" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($guru as $g)
                            <option value="{{ $g->id }}" {{ $pelajaran->guru_id == $g->id ? 'selected' : '' }}>
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Kelas -->
                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-semibold text-gray-700">Pilih Kelas</label>
                    <select name="kelas" id="kelas" class="w-full p-2 border rounded bg-gray-50" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->nama }}" {{ $pelajaran->kelas == $k->nama ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Pelajaran -->
                <div class="mb-4">
                    <label for="nama_pelajaran" class="block text-sm font-semibold text-gray-700">Nama Pelajaran</label>
                    <input type="text" name="nama_pelajaran" id="nama_pelajaran"
                        value="{{ old('nama_pelajaran', $pelajaran->nama_pelajaran) }}"
                        class="w-full p-2 border rounded bg-gray-50" required>
                </div>

                <!-- Hari -->
                <div class="mb-4">
                    <label for="hari" class="block text-sm font-semibold text-gray-700">Hari</label>
                    <select name="hari" id="hari" class="w-full p-2 border rounded bg-gray-50" required>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                            <option value="{{ $h }}" {{ $pelajaran->hari == $h ? 'selected' : '' }}>
                                {{ $h }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jam -->
                <div class="mb-6">
                    <label for="jam" class="block text-sm font-semibold text-gray-700">Jam</label>
                    <select name="jam" id="jam" class="w-full p-2 border rounded bg-gray-50" required>
                        @foreach (['07:00', '08:00', '09:00', '10:00', '11:00', '13:00', '14:00'] as $j)
                            <option value="{{ $j }}" {{ $pelajaran->jam == $j ? 'selected' : '' }}>
                                {{ $j }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <a href="{{ route('admin.kelola_pelajaran') }}"
                        class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                        Update Pelajaran
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
