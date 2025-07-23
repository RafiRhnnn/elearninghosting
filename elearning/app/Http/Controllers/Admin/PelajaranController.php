<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Models\Pelajaran; // pastikan model Pelajaran sudah ada


class PelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::all();
        return view('admin.pelajaran', compact('pelajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'guru_id' => 'required|exists:users,id',
            'nama_pelajaran' => 'required|string|max:255',
            'hari' => 'required|string|max:100',
            'jam' => 'required|string|max:100',
            // pelajaran1-10 tetap opsional
        ]);

        Pelajaran::create($request->only([
            'kelas',
            'guru_id',
            'nama_pelajaran',
            'hari',
            'jam',
        ]));

        return redirect()->back()->with('success', 'Pelajaran berhasil disimpan.');
    }


    public function create()
    {
        $kelas = Kelas::select('id', 'nama')->distinct()->get();
        $guru = User::where('role', 'guru')->get(); // Ambil guru

        return view('admin.pelajaran', compact('kelas', 'guru'));
    }
}
