<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaUser;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get("/", [DashboardController::class, 'index'])->name('dashboard');

Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');

Route::get("/login", [LoginController::class, 'index'])->name('auth.login');
Route::post("/login", [LoginController::class, 'authenticate'])->name('authenticate');
Route::get("/login", [LoginController::class, 'logout'])->name('logout');

Route::get("/kelola/user", [KelolaUser::class, 'index'])->name('kelola.user');

Route::get("/kelola/matakuliah", [KelolaUser::class, 'index'])->name('kelola.matakuliah');

Route::get("/profile", [ProfileController::class, 'index'])->name('profile');


