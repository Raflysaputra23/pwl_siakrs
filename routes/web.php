<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Jadwal\JadwalMahasiswaController;
use App\Http\Controllers\Jadwal\JadwalDosenController;
use App\Http\Controllers\Kelola\KelolaAkademikController;
use App\Http\Controllers\Kelola\KelolaMatakuliahController;
use App\Http\Controllers\Kelola\KelolaProdiController;
use App\Http\Controllers\Kelola\KelolaUserController;
use App\Http\Controllers\Krs\KrsMahasiswaController;
use App\Http\Controllers\Profile\ProfileMahasiswaController;
use App\Http\Controllers\Krs\KrsDosenController;
use Illuminate\Support\Facades\Route;

Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');

Route::get("/login", [LoginController::class, 'index'])->name('auth.login');
Route::post("/login", [LoginController::class, 'authenticate'])->name('authenticate');
Route::get("/login", [LoginController::class, 'logout'])->name('logout');

Route::get("/kelola/user", [KelolaUserController::class, 'index'])->name('kelola.user');

Route::get("/kelola/matakuliah", [KelolaMatakuliahController::class, 'index'])->name('kelola.matakuliah');

Route::get("/kelola/akademik", [KelolaAkademikController::class, 'index'])->name('kelola.akademik');

Route::get("/kelola/prodi", [KelolaProdiController::class, 'index'])->name('kelola.prodi');

Route::get("/profile", [ProfileMahasiswaController::class, 'index'])->name('profile.mahasiswa');

Route::get("/krs", [KrsMahasiswaController::class, 'index'])->name('krs.mahasiswa');

Route::get("/jadwal", [JadwalMahasiswaController::class, 'index'])->name('jadwal.mahasiswa');
Route::get("/dosen/jadwal", [JadwalDosenController::class, 'index'])->name('jadwal.dosen');

Route::get("/krs", [KrsMahasiswaController::class, 'index'])->name('krs.mahasiswa');
Route::get("/dosen/krs", [KrsDosenController::class, 'index'])->name('krs.dosen');