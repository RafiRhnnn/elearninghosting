<?php

// app/Http/Controllers/Guru/DashboardController.php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();
        $pelajaran = Pelajaran::where('guru_id', $guruId)->get();
        $kelas = $pelajaran->groupBy('kelas');

        return view('guru.dashboard', compact('kelas'));
    }

    public function detailKelas($kelas)
    {
        $guruId = Auth::id();
        $pelajaran = Pelajaran::where('guru_id', $guruId)
            ->where('kelas', $kelas)
            ->get();

        return view('guru.kelas_detail', compact('kelas', 'pelajaran'));
    }
}
