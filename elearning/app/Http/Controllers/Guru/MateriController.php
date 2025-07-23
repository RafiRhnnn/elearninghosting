<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index($kelas)
    {
        // Ambil mata pelajaran yang diajar guru di kelas ini
        $pelajaranList = Pelajaran::where('guru_id', Auth::id())
            ->where('kelas', $kelas)
            ->get();

        $materiList = Materi::where('kelas', $kelas)
            ->where('guru_id', Auth::id())
            ->get();

        return view('guru.materi', compact('kelas', 'materiList', 'pelajaranList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'kelas' => 'required|string',
            'mata_pelajaran' => 'required|string',
            'pertemuan' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $path = $request->file('file')->store('materi', 'public');

        Materi::create([
            'guru_id' => $request->guru_id,
            'kelas' => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'pertemuan' => $request->pertemuan,
            'file' => $path,
        ]);

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        // Delete the file from storage
        if ($materi->file && Storage::exists($materi->file)) {
            Storage::delete($materi->file);
        }

        // Delete the record from the database
        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus.');
    }
}
