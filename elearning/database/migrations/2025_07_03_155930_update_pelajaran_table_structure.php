<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelajaran', function (Blueprint $table) {
            // Hapus kolom lama yang tidak diperlukan
            // $table->dropColumn([
            //     'pelajaran1',
            //     'pelajaran2',
            //     'pelajaran3',
            //     'pelajaran4',
            //     'pelajaran5',
            //     'pelajaran6',
            //     'pelajaran7',
            //     'pelajaran8',
            //     'pelajaran9',
            //     'pelajaran10',
            // ]);

            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('pelajaran', 'guru_id')) {
                $table->unsignedBigInteger('guru_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('pelajaran', 'nama_pelajaran')) {
                $table->string('nama_pelajaran')->nullable()->after('kelas');
            }
            if (!Schema::hasColumn('pelajaran', 'hari')) {
                $table->string('hari')->nullable()->after('nama_pelajaran');
            }
            if (!Schema::hasColumn('pelajaran', 'jam')) {
                $table->string('jam')->nullable()->after('hari');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pelajaran', function (Blueprint $table) {
            $table->string('pelajaran1')->nullable();
            $table->string('pelajaran2')->nullable();
            $table->string('pelajaran3')->nullable();
            $table->string('pelajaran4')->nullable();
            $table->string('pelajaran5')->nullable();
            $table->string('pelajaran6')->nullable();
            $table->string('pelajaran7')->nullable();
            $table->string('pelajaran8')->nullable();
            $table->string('pelajaran9')->nullable();
            $table->string('pelajaran10')->nullable();

            $table->dropColumn(['guru_id', 'nama_pelajaran', 'hari', 'jam']);
        });
    }
};