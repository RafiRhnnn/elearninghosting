<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Materi;

class MateriController extends Controller
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

        // Debug untuk melihat kelas siswa
        logger('Kelas siswa: ' . $user->kelas_id);

        // Ambil semua materi untuk debugging
        $allMateri = Materi::all();
        logger('Total materi di database: ' . $allMateri->count());

        // Ambil materi berdasarkan kelas siswa
        $materiList = Materi::where('kelas', $user->kelas_id)
            ->with('guru')
            ->orderBy('created_at', 'desc')
            ->get();

        logger('Materi untuk kelas ' . $user->kelas_id . ': ' . $materiList->count());

        return view('siswa.materi', compact('user', 'kelas', 'materiList'));
    }
}
