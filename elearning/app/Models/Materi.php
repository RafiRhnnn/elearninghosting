<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi'; // ← Wajib ditambah jika nama tabel tidak jamak

    protected $fillable = ['guru_id', 'kelas', 'mata_pelajaran', 'pertemuan', 'file'];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Pastikan tidak ada observer atau logic otomatis di sini.
}

// DESCRIBE materi;
