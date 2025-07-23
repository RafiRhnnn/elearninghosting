<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->string('kelas')->nullable();
            $table->string('nama_pelajaran')->nullable();
            $table->string('hari')->nullable();
            $table->string('jam')->nullable();
            $table->timestamps();
        });
        Schema::table('pelajaran', function (Blueprint $table) {
            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('pelajaran', 'guru_id')) {
                $table->unsignedBigInteger('guru_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('pelajaran', 'kelas')) {
                $table->string('kelas')->nullable()->after('guru_id');
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
            // Tambahkan kembali kolom lama
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

            // Hapus kolom baru
            $table->dropColumn(['guru_id', 'kelas', 'nama_pelajaran', 'hari', 'jam']);
        });
    }
};