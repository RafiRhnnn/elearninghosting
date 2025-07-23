<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Materi - Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('siswa.sidebar')

    <main class="flex-1 p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Materi Pembelajaran</h2>

        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi Siswa</h3>
            <p class="text-gray-600"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p class="text-gray-600"><strong>Kelas:</strong>
                @if (Auth::user()->kelas_id)
                    {{ Auth::user()->kelas_id }}
                @else
                    Kelas belum ditentukan
                @endif
            </p>
            <p class="text-gray-600"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Materi</h3>
            <p class="text-gray-600 mb-4">Berikut adalah materi pembelajaran untuk kelas Anda:</p>

            <!-- Debug info -->
            <div class="bg-yellow-100 p-3 rounded mb-4 text-sm">
                <strong>Debug Info:</strong><br>
                Kelas Anda: {{ Auth::user()->kelas_id }}<br>
                Total Materi Ditemukan: {{ $materiList->count() }}
            </div>

            @if ($materiList->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Guru</th>
                                <th class="border px-4 py-2">Mata Pelajaran</th>
                                <th class="border px-4 py-2">Pertemuan</th>
                                <th class="border px-4 py-2">File</th>
                                <th class="border px-4 py-2">Tanggal Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materiList as $index => $materi)
                                <tr class="text-center">
                                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $materi->guru->name }}</td>
                                    <td class="border px-4 py-2">{{ $materi->mata_pelajaran ?? 'Umum' }}</td>
                                    <td class="border px-4 py-2">{{ $materi->pertemuan ?? '-' }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            📄 {{ basename($materi->file) }}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $materi->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 text-6xl mb-4">📚</div>
                    <p class="text-gray-500">Belum ada materi yang tersedia</p>
                    <p class="text-gray-400 text-sm">Materi akan ditampilkan ketika guru mengunggah materi baru</p>
                    <p class="text-gray-400 text-xs mt-2">Kelas Anda: {{ Auth::user()->kelas_id }}</p>
                </div>
            @endif
        </div>
    </main>
</body>

</html>
