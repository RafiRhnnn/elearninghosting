<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tugas Kelas - {{ $kelas }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('guru.sidebar')

    <main class="flex-1 p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Tugas Kelas: {{ $kelas }}</h2>

        <!-- Tombol Tambah -->
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('guru.kelas.detail', $kelas) }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 inline-block">
                ⬅ Kembali
            </a>

            <button onclick="showModal()"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-block">
                + Tambah Tugas
            </button>
        </div>

        <!-- Modal Form Tambah Tugas -->
        <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
            style="display: none;">
            <div class="bg-white rounded-lg shadow-lg p-4 w-[320px] sm:w-[360px]">
                <h3 class="text-lg font-bold mb-3">Tambah Tugas</h3>
                <form action="{{ route('guru.tugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kelas" value="{{ $kelas }}">
                    <input type="hidden" name="guru_id" value="{{ Auth::id() }}">

                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm">Nama Guru</label>
                        <input type="text" value="{{ Auth::user()->name }}" disabled
                            class="w-full border rounded px-3 py-2 bg-gray-100 text-sm">
                    </div>

                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm">Kelas</label>
                        <input type="text" value="{{ $kelas }}" disabled
                            class="w-full border rounded px-3 py-2 bg-gray-100 text-sm">
                    </div>

                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm">Mata Pelajaran</label>
                        <select name="mata_pelajaran" required class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">Pilih Mata Pelajaran</option>
                            @if (isset($pelajaranList) && $pelajaranList->count() > 0)
                                @foreach ($pelajaranList as $pelajaran)
                                    <option value="{{ $pelajaran->nama_pelajaran }}">{{ $pelajaran->nama_pelajaran }}
                                    </option>
                                @endforeach
                            @else
                                <option value="Umum">Umum</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm">Pertemuan</label>
                        <input type="text" name="pertemuan" required class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="mb-3">
                        <label class="block text-gray-700 text-sm">Deadline</label>
                        <input type="datetime-local" name="deadline" required
                            class="w-full border rounded px-3 py-2 text-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-1">Upload File</label>
                        <input type="file" name="file" required
                            class="w-full border rounded px-3 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="hideModal()"
                            class="px-3 py-2 bg-gray-500 text-white rounded text-sm hover:bg-gray-600">Batal</button>
                        <button type="submit"
                            class="px-3 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Tugas -->
        <div class="overflow-x-auto mt-6">
            <table class="w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Guru</th>
                        <th class="border px-4 py-2">Kelas</th>
                        <th class="border px-4 py-2">Mata Pelajaran</th>
                        <th class="border px-4 py-2">Pertemuan</th>
                        <th class="border px-4 py-2">Deadline</th>
                        <th class="border px-4 py-2">File</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tugasList as $index => $tugas)
                        <tr class="text-center">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $tugas->guru->name }}</td>
                            <td class="border px-4 py-2">{{ $tugas->kelas }}</td>
                            <td class="border px-4 py-2">{{ $tugas->mata_pelajaran ?? 'Umum' }}</td>
                            <td class="border px-4 py-2">{{ $tugas->pertemuan }}</td>
                            <td class="border px-4 py-2">
                                <span
                                    class="text-sm {{ $tugas->deadline < now() ? 'text-red-600' : 'text-gray-600' }}">
                                    {{ $tugas->deadline->format('d/m/Y H:i') }}
                                </span>
                                @if ($tugas->deadline < now())
                                    <br><small class="text-red-500">Terlambat</small>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ basename($tugas->file) }}
                                </a>
                            </td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('guru.tugas.destroy', $tugas->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">Belum ada tugas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- JS Modal -->
    <script>
        function showModal() {
            document.getElementById('modalTambah').style.display = 'flex';
        }

        function hideModal() {
            document.getElementById('modalTambah').style.display = 'none';
        }
    </script>
</body>

</html>
