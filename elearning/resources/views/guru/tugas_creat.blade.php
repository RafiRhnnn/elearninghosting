@extends('guru.layout')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Tugas</h2>

        <form action="{{ route('guru.tugas.store', $kelas) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="guru_id" value="{{ Auth::id() }}">
            <input type="hidden" name="kelas" value="{{ $kelas }}">

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Pertemuan</label>
                <input type="text" name="pertemuan" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">File Tugas (pdf, docx, jpg)</label>
                <input type="file" name="file" class="w-full border px-3 py-2 rounded" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </form>
    </div>
@endsection
