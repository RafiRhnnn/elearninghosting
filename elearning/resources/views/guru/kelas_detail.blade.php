<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Kelas - {{ $kelas }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('guru.sidebar')

    <main class="flex-1 p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail Kelas: {{ $kelas }}</h2>
        <p class="text-gray-600 mb-6">Kelola materi dan tugas untuk kelas <strong>{{ $kelas }}</strong>.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Kartu Materi -->
            <div class="border rounded-lg shadow p-6 flex flex-col items-center text-center bg-white">
                <div class="text-4xl mb-3">
                    📖
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Materi</h3>
                <a href="{{ route('guru.materi.index', $kelas) }}" class="text-blue-600 hover:underline">
                    Lihat Lebih →
                </a>
            </div>

            <!-- Kartu Tugas -->
            <div class="border rounded-lg shadow p-6 flex flex-col items-center text-center bg-white">
                <div class="text-4xl mb-3">
                    📝
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tugas</h3>
                <a href="{{ route('guru.tugas.index', $kelas) }}" class="text-blue-600 hover:underline">
                    Lihat Lebih →
                </a>
            </div>
        </div>
    </main>
</body>

</html>
