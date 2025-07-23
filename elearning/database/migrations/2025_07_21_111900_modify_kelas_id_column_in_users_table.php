<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jangan ubah tipe data kelas_id, biarkan tetap string
        Schema::table('users', function (Blueprint $table) {
            // Hanya pastikan kolom kelas_id ada dan nullable
            if (!Schema::hasColumn('users', 'kelas_id')) {
                $table->string('kelas_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback jika diperlukan
        });
    }
};
