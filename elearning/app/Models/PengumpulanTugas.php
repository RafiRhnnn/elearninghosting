<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'nama_siswa',
        'kelas',
        'mata_pelajaran',
        'pertemuan',
        'keterangan',
        'file',
        'dikumpulkan_pada'
    ];

    protected $casts = [
        'dikumpulkan_pada' => 'datetime'
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
