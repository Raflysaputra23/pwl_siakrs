<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Kelola\KelolaAkademikController;
use App\Http\Controllers\Kelola\KelolaMatakuliahController;
use App\Http\Controllers\Kelola\KelolaProdiController;
use App\Http\Controllers\Kelola\KelolaUserController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get("/login", [LoginController::class, 'index'])->name('auth.login');
    Route::post("/login", [LoginController::class, 'authenticate'])->name('auth.authenticate');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get("/kelola/user", [KelolaUserController::class, 'index'])->name('kelola.user');
    Route::post("/kelola/user/store", [KelolaUserController::class, 'store'])->name('kelola.user.store');
    Route::put("/kelola/user/update/{id}", [KelolaUserController::class, 'update'])->name('kelola.user.update');
    Route::delete("/kelola/user/delete/{id}", [KelolaUserController::class, 'destroy'])->name('kelola.user.destroy');
    
    Route::get("/kelola/matakuliah", [KelolaMatakuliahController::class, 'index'])->name('kelola.matakuliah');
    Route::post("/kelola/matakuliah/store", [KelolaMatakuliahController::class, 'store'])->name('kelola.matakuliah.store');
    Route::put("/kelola/matakuliah/update/{id}", [KelolaMatakuliahController::class, 'update'])->name('kelola.matakuliah.update');
    Route::delete("/kelola/matakuliah/delete/{id}", [KelolaMatakuliahController::class, 'destroy'])->name('kelola.matakuliah.destroy');
    
    Route::get("/kelola/akademik", [KelolaAkademikController::class, 'index'])->name('kelola.akademik');
    Route::post("/kelola/akademik/store", [KelolaAkademikController::class, 'store'])->name('kelola.akademik.store');
    Route::put("/kelola/akademik/update/{id}", [KelolaAkademikController::class, 'update'])->name('kelola.akademik.update');
    Route::post("/kelola/akademik/set-aktif/{id}", [KelolaAkademikController::class, 'setAktif'])->name('kelola.akademik.set-aktif');
    Route::delete("/kelola/akademik/delete/{id}", [KelolaAkademikController::class, 'destroy'])->name('kelola.akademik.destroy');

    Route::get("/kelola/prodi", [KelolaProdiController::class, 'index'])->name('kelola.prodi');
    Route::post("/kelola/prodi/store", [KelolaProdiController::class, 'store'])->name('kelola.prodi.store');
    Route::put("/kelola/prodi/update/{id}", [KelolaProdiController::class, 'update'])->name('kelola.prodi.update');
    Route::delete("/kelola/prodi/delete/{id}", [KelolaProdiController::class, 'destroy'])->name('kelola.prodi.destroy');
});

Route::middleware(['auth', 'role:admin,dosen,mahasiswa'])->group(function () {
    Route::get("/", [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/profile", [ProfileController::class, 'index'])->name('profile');
    Route::post("/profile/update", [ProfileController::class, 'update'])->name('profile.update');
    Route::post("/profile/update-password", [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post("/logout", [LoginController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth', 'role:dosen,mahasiswa'])->group(function () {
    Route::get("/krs", [KrsController::class, 'index'])->name('krs');
    Route::post("/krs/ajukan", [KrsController::class, 'ajukan'])->name('krs.ajukan');
    Route::post("/krs/batal", [KrsController::class, 'batal'])->name('krs.batal');
    Route::post("/krs/setujui/{id}", [KrsController::class, 'setujui'])->name('krs.setujui');
    Route::post("/krs/tolak/{id}", [KrsController::class, 'tolak'])->name('krs.tolak');
    Route::get("/krs/detail/{id}", [KrsController::class, 'detail'])->name('krs.detail');
    Route::get("/jadwal", [JadwalController::class, 'index'])->name('jadwal');
});