<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('tugas', 'mata_pelajaran')) {
                $table->string('mata_pelajaran')->after('kelas');
            }
            if (!Schema::hasColumn('tugas', 'pertemuan')) {
                $table->string('pertemuan')->after('mata_pelajaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['mata_pelajaran', 'pertemuan']);
        });
    }
};
