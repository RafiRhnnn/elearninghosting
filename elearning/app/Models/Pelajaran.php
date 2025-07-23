<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';

    protected $fillable = [
        'kelas',
        'guru_id',
        'nama_pelajaran',
        'hari',
        'jam',
    ];

    /**
     * Relasi ke model User (guru)
     */
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
