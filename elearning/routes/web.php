<?php

use App\Models\User;
use App\Http\Middleware\GuruOnly;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\SiswaOnly;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Admin\PelajaranController;
use App\Http\Controllers\Admin\RegisterUserController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\PelajaranManajementController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Arahkan root ke halaman login
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Default dashboard (jika tidak pakai redirect berdasarkan role)


// Profile (semua role bisa akses)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminOnly::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin dengan total user
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'totalUsers' => User::whereIn('role', ['guru', 'siswa'])->count(),
                'totalGuru' => User::where('role', 'guru')->count(),
                'totalSiswa' => User::where('role', 'siswa')->count(),
            ]);
        })->name('dashboard');


        // Register User (oleh admin)
        Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

        //tambahkelas
        Route::get('/tambah-kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/tambah-kelas', [KelasController::class, 'store'])->name('kelas.store');

        //pelajaran
        Route::get('/pelajaran', [PelajaranController::class, 'create'])->name('pelajaran');
        Route::post('/pelajaran', [PelajaranController::class, 'store'])->name('pelajaran.store');

        //kelola pelajaran
        Route::get('/kelola-pelajaran', [PelajaranManajementController::class, 'index'])->name('kelola_pelajaran');
        Route::get('/kelola-pelajaran/{id}/edit', [PelajaranManajementController::class, 'edit'])->name('kelola_pelajaran.edit');
        Route::put('/kelola-pelajaran/{id}', [PelajaranManajementController::class, 'update'])->name('kelola_pelajaran.update');
        Route::delete('/kelola-pelajaran/{id}', [PelajaranManajementController::class, 'destroy'])->name('kelola_pelajaran.destroy');

        // Kelola User
        Route::get('/kelola-user', [UserManagementController::class, 'index'])->name('kelola_user');
        Route::get('/kelola-user/{user}/edit', [UserManagementController::class, 'edit'])->name('kelola_user.edit');
        Route::put('/kelola-user/{user}', [UserManagementController::class, 'update'])->name('kelola_user.update');
        Route::delete('/kelola-user/{user}', [UserManagementController::class, 'destroy'])->name('kelola_user.destroy');
    });

/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', GuruOnly::class])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/kelas/{kelas}', [DashboardController::class, 'detailKelas'])->name('kelas.detail');

        // Halaman Materi & Tugas
        Route::get('/kelas/{kelas}/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/kelas/{kelas}/tugas', [TugasController::class, 'index'])->name('tugas.index');
        Route::post('/kelas/materi/store', [MateriController::class, 'store'])->name('materi.store');
        Route::post('/kelas/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
        Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');

        // Pengumpulan Tugas
        Route::get('/pengumpulan-tugas', [App\Http\Controllers\Guru\PengumpulanTugasController::class, 'index'])->name('pengumpulan.index');
        Route::get('/pengumpulan-tugas/{tugas}', [App\Http\Controllers\Guru\PengumpulanTugasController::class, 'detail'])->name('pengumpulan.detail');
    });

Route::post('/guru/tugas/store', [App\Http\Controllers\Guru\TugasController::class, 'store'])->name('guru.tugas.store');
Route::delete('/guru/materi/{id}', [GuruMateriController::class, 'destroy'])->name('guru.materi.destroy');


/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', SiswaOnly::class])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/materi', [App\Http\Controllers\Siswa\MateriController::class, 'index'])->name('materi');
        Route::get('/tugas', [App\Http\Controllers\Siswa\TugasController::class, 'index'])->name('tugas');
        Route::post('/tugas/kumpul', [App\Http\Controllers\Siswa\TugasController::class, 'store'])->name('tugas.store');
    });

// Route bawaan Laravel Breeze (login, logout, dll)
require __DIR__ . '/auth.php';
