<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Pelajaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('admin.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Kelola Data Pelajaran</h2>

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Guru</th>
                            <th class="border px-4 py-2">Kelas</th>
                            <th class="border px-4 py-2">Nama Pelajaran</th>
                            <th class="border px-4 py-2">Hari</th>
                            <th class="border px-4 py-2">Jam</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataPelajaran as $index => $p)
                            <tr class="text-center">
                                <td class="border px-2 py-1">{{ $index + 1 }}</td>
                                <td class="border px-2 py-1">{{ $p->guru->name ?? '-' }}</td>
                                <td class="border px-2 py-1">{{ $p->kelas }}</td>
                                <td class="border px-2 py-1">{{ $p->nama_pelajaran }}</td>
                                <td class="border px-2 py-1">{{ $p->hari }}</td>
                                <td class="border px-2 py-1">{{ $p->jam }}</td>
                                <td class="border px-2 py-1">
                                    <a href="{{ route('admin.kelola_pelajaran.edit', $p->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    |
                                    <form action="{{ route('admin.kelola_pelajaran.destroy', $p->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pelajaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </main>
</body>

</html>
