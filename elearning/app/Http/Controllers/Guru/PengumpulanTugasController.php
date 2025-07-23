<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;

class PengumpulanTugasController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();

        // Ambil semua tugas yang dibuat guru ini
        $tugasList = Tugas::where('guru_id', $guruId)
            ->with(['pengumpulan.siswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil semua pengumpulan tugas dari tugas yang dibuat guru ini
        $pengumpulanList = PengumpulanTugas::whereHas('tugas', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })->with(['tugas', 'siswa'])
            ->orderBy('dikumpulkan_pada', 'desc')
            ->get();

        return view('guru.pengumpulan_tugas', compact('tugasList', 'pengumpulanList'));
    }

    public function detail($tugasId)
    {
        $guruId = Auth::id();

        // Pastikan tugas ini milik guru yang login
        $tugas = Tugas::where('id', $tugasId)
            ->where('guru_id', $guruId)
            ->firstOrFail();

        // Ambil semua pengumpulan untuk tugas ini
        $pengumpulanList = PengumpulanTugas::where('tugas_id', $tugasId)
            ->with('siswa')
            ->orderBy('dikumpulkan_pada', 'desc')
            ->get();

        return view('guru.detail_pengumpulan', compact('tugas', 'pengumpulanList'));
    }
}
