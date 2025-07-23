<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('kelas')->where('role', '!=', 'admin')->get();
        return view('admin.kelola_user', compact('users'));
    }



    public function edit(User $user)
    {
        $kelas = Kelas::all(); // Ambil semua kelas untuk dropdown
        return view('admin.edit_user', compact('user', 'kelas'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:guru,siswa',
            'password' => 'nullable|string|min:8',
            'kelas_id' => 'nullable|string|max:100', // validasi nama kelas
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'kelas_id' => $request->kelas_id, // simpan nama kelas ke kolom 'kelas_id'
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.kelola_user')->with('success', 'User berhasil diperbarui.');
    }




    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
