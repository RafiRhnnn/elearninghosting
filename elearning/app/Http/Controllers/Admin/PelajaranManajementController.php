<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelajaran;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class PelajaranManajementController extends Controller
{
    public function index()
    {
        $dataPelajaran = Pelajaran::with('guru')->get(); // include relasi guru jika ada
        return view('admin.kelola_pelajaran', compact('dataPelajaran'));
    }

    public function edit($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $guru = User::where('role', 'guru')->get();
        $kelas = Kelas::select('nama')->get();

        return view('admin.edit_pelajaran', compact('pelajaran', 'guru', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'kelas' => 'required|string|max:255',
            'nama_pelajaran' => 'required|string|max:255',
            'hari' => 'required|string|max:20',
            'jam' => 'required|string|max:10',
        ]);

        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->update([
            'guru_id' => $request->guru_id,
            'kelas' => $request->kelas,
            'nama_pelajaran' => $request->nama_pelajaran,
            'hari' => $request->hari,
            'jam' => $request->jam,
        ]);

        return redirect()->route('admin.kelola_pelajaran')->with('success', 'Data pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);
        $pelajaran->delete();

        return redirect()->route('admin.kelola_pelajaran')->with('success', 'Data pelajaran berhasil dihapus.');
    }
}
