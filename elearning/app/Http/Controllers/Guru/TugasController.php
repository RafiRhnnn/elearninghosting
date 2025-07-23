<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index($kelas)
    {
        // Ambil mata pelajaran yang diajar guru di kelas ini
        $pelajaranList = Pelajaran::where('guru_id', Auth::id())
            ->where('kelas', $kelas)
            ->get();

        $tugasList = Tugas::where('kelas', $kelas)
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.tugas', compact('kelas', 'tugasList', 'pelajaranList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id'   => 'required|exists:users,id',
            'kelas'     => 'required|string',
            'mata_pelajaran' => 'required|string',
            'pertemuan' => 'required|string|max:255',
            'deadline'  => 'required|date|after:now',
            'file'      => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $path = $request->file('file')->store('tugas', 'public');

        Tugas::create([
            'guru_id'   => $request->guru_id,
            'kelas'     => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'pertemuan' => $request->pertemuan,
            'deadline'  => $request->deadline,
            'file'      => $path,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Hapus file dari storage
        if ($tugas->file && Storage::exists($tugas->file)) {
            Storage::delete($tugas->file);
        }

        // Hapus dari database
        $tugas->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }
}
