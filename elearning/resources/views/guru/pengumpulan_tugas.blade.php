<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengumpulan Tugas - Guru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-gray-100">
    @include('guru.sidebar')

    <main class="flex-1 p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Pengumpulan Tugas Siswa</h2>

        <!-- Info Guru -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi Guru</h3>
            <p class="text-gray-600"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p class="text-gray-600"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6">
                    <button onclick="showTab('daftar-tugas')" id="tab-daftar-tugas"
                        class="tab-button border-b-2 border-blue-500 text-blue-600 py-4 px-1 text-sm font-medium">
                        Daftar Tugas Saya
                    </button>
                    <button onclick="showTab('semua-pengumpulan')" id="tab-semua-pengumpulan"
                        class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 py-4 px-1 text-sm font-medium">
                        Semua Pengumpulan
                    </button>
                </nav>
            </div>

            <!-- Tab Content: Daftar Tugas -->
            <div id="content-daftar-tugas" class="tab-content p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tugas yang Saya Berikan</h3>

                @if ($tugasList->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">Mata Pelajaran</th>
                                    <th class="border px-4 py-2">Pertemuan</th>
                                    <th class="border px-4 py-2">Deadline</th>
                                    <th class="border px-4 py-2">File Tugas</th>
                                    <th class="border px-4 py-2">Jumlah Pengumpulan</th>
                                    <th class="border px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugasList as $index => $tugas)
                                    <tr class="text-center">
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $tugas->kelas }}</td>
                                        <td class="border px-4 py-2">{{ $tugas->mata_pelajaran ?? 'Umum' }}</td>
                                        <td class="border px-4 py-2">{{ $tugas->pertemuan }}</td>
                                        <td class="border px-4 py-2">
                                            <span
                                                class="text-sm {{ $tugas->deadline < now() ? 'text-red-600' : 'text-gray-600' }}">
                                                {{ $tugas->deadline->format('d/m/Y H:i') }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                📄 {{ basename($tugas->file) }}
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                                {{ $tugas->pengumpulan->count() }} siswa
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('guru.pengumpulan.detail', $tugas->id) }}"
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-6xl mb-4">📝</div>
                        <p class="text-gray-500">Belum ada tugas yang Anda berikan</p>
                    </div>
                @endif
            </div>

            <!-- Tab Content: Semua Pengumpulan -->
            <div id="content-semua-pengumpulan" class="tab-content p-6 hidden">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Semua Pengumpulan Tugas</h3>

                @if ($pengumpulanList->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Nama Siswa</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">Mata Pelajaran</th>
                                    <th class="border px-4 py-2">Pertemuan</th>
                                    <th class="border px-4 py-2">Keterangan</th>
                                    <th class="border px-4 py-2">File Siswa</th>
                                    <th class="border px-4 py-2">Waktu Kumpul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumpulanList as $index => $pengumpulan)
                                    <tr class="text-center">
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $pengumpulan->nama_siswa }}</td>
                                        <td class="border px-4 py-2">{{ $pengumpulan->kelas }}</td>
                                        <td class="border px-4 py-2">{{ $pengumpulan->mata_pelajaran }}</td>
                                        <td class="border px-4 py-2">{{ $pengumpulan->pertemuan }}</td>
                                        <td class="border px-4 py-2 text-left">
                                            <div class="max-w-xs overflow-hidden">
                                                {{ Str::limit($pengumpulan->keterangan, 50) }}
                                            </div>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($pengumpulan->file)
                                                <a href="{{ asset('storage/' . $pengumpulan->file) }}" target="_blank"
                                                    class="text-blue-600 hover:underline">
                                                    📎 {{ basename($pengumpulan->file) }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-sm">
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
                        <p class="text-gray-500">Belum ada pengumpulan tugas</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active styles from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Add active styles to selected tab
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-blue-500', 'text-blue-600');
        }
    </script>
</body>

</html>
