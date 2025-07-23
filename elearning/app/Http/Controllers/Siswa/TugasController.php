<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek apakah ada kelas dengan nama yang sama dengan kelas_id user
        $kelasDitemukan = Kelas::where('nama', $user->kelas_id)->first();

        // Jika tidak ada, langsung gunakan kelas_id sebagai nama kelas
        if (!$kelasDitemukan && $user->kelas_id) {
            $kelas = (object) ['nama' => $user->kelas_id];
        } else {
            $kelas = $kelasDitemukan;
        }

        // Ambil tugas berdasarkan kelas siswa
        $tugasList = Tugas::where('kelas', $user->kelas_id)
            ->with(['guru', 'pengumpulan' => function ($query) use ($user) {
                $query->where('siswa_id', $user->id);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.tugas', compact('user', 'kelas', 'tugasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'keterangan' => 'required|string|max:500',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg|max:5120',
        ]);

        $user = Auth::user();
        $tugas = Tugas::findOrFail($request->tugas_id);

        // Cek apakah sudah mengumpulkan
        $sudahKumpul = PengumpulanTugas::where('tugas_id', $request->tugas_id)
            ->where('siswa_id', $user->id)
            ->exists();

        if ($sudahKumpul) {
            return redirect()->back()->with('error', 'Anda sudah mengumpulkan tugas ini!');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pengumpulan_tugas', 'public');
        }

        PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'siswa_id' => $user->id,
            'nama_siswa' => $user->name,
            'kelas' => $user->kelas_id,
            'mata_pelajaran' => $tugas->mata_pelajaran ?? 'Umum',
            'pertemuan' => $tugas->pertemuan,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'dikumpulkan_pada' => now(),
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
