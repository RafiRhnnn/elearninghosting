<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pengumpulan - {{ $tugas->mata_pelajaran }} Pertemuan {{ $tugas->pertemuan }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('guru.sidebar')

    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Detail Pengumpulan Tugas</h2>
            <a href="{{ route('guru.pengumpulan.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ⬅ Kembali
            </a>
        </div>

        <!-- Info Tugas -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Tugas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600"><strong>Kelas:</strong> {{ $tugas->kelas }}</p>
                    <p class="text-gray-600"><strong>Mata Pelajaran:</strong> {{ $tugas->mata_pelajaran ?? 'Umum' }}</p>
                    <p class="text-gray-600"><strong>Pertemuan:</strong> {{ $tugas->pertemuan }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Guru:</strong> {{ $tugas->guru->name }}</p>
                    <p class="text-gray-600"><strong>Dibuat:</strong> {{ $tugas->created_at->format('d/m/Y H:i') }}</p>
                    <p class="text-gray-600"><strong>Jumlah Pengumpulan:</strong> {{ $pengumpulanList->count() }} siswa
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-600"><strong>File Tugas:</strong></p>
                <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                    class="text-blue-600 hover:underline inline-flex items-center mt-1">
                    📄 {{ basename($tugas->file) }}
                </a>
            </div>
        </div>

        <!-- Daftar Pengumpulan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Siswa yang Mengumpulkan</h3>

            @if ($pengumpulanList->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Nama Siswa</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Keterangan</th>
                                <th class="border px-4 py-2">File Pengumpulan</th>
                                <th class="border px-4 py-2">Waktu Pengumpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumpulanList as $index => $pengumpulan)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $pengumpulan->nama_siswa }}</td>
                                    <td class="border px-4 py-2">{{ $pengumpulan->siswa->email ?? '-' }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="max-w-xs">
                                            {{ $pengumpulan->keterangan }}
                                        </div>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        @if ($pengumpulan->file)
                                            <a href="{{ asset('storage/' . $pengumpulan->file) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                📎 {{ basename($pengumpulan->file) }}
                                            </a>
                                        @else
                                            <span class="text-gray-400">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2 text-center text-sm">
                                        {{ $pengumpulan->dikumpulkan_pada->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 text-6xl mb-4">📭</div>
                    <p class="text-gray-500">Belum ada siswa yang mengumpulkan tugas ini</p>
                </div>
            @endif
        </div>
    </main>
</body>

</html>
