@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center shrink-0">
                <x-lucide-school class="size-5" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Program Studi & Fakultas</h1>
                <p class="text-xs text-slate-600">Manajemen struktur fakultas naungan dan program studi sesuai skema database.</p>
            </div>
        </div>

        <div class="inline-flex rounded-2xl bg-surface p-1.5 border border-slate-200 shadow-sm self-start sm:self-auto">
            <button type="button" id="btn-tab-prodi" onclick="switchTab('prodi')" class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer">
                <x-lucide-graduation-cap class="size-4" />
                Program Studi
                <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white">8</span>
            </button>
            <button type="button" id="btn-tab-fakultas" onclick="switchTab('fakultas')" class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer">
                <x-lucide-building-2 class="size-4" />
                Fakultas
                <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700">4</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Program Studi</h2>
                <p class="text-2xl font-bold text-slate-900">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-graduation-cap class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Fakultas</h2>
                <p class="text-2xl font-bold text-slate-900">4</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                <x-lucide-building-2 class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Mahasiswa Terdaftar</h2>
                <p class="text-2xl font-bold text-emerald-600">1,180</p>
                <p class="text-[11px] text-slate-400">Di seluruh prodi</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Kurikulum</h2>
                <p class="text-2xl font-bold text-slate-900">142</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center">
                <x-lucide-book-open class="size-5" />
            </div>
        </div>
    </div>

    <div id="section-prodi" class="space-y-4">
        <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
            <div class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    <div class="relative min-w-65 max-w-sm flex-1">
                        <input type="text" id="search-prodi-input" placeholder="Cari Kode Prodi atau Nama Program Studi..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                        <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    </div>

                    <select id="filter-prodi-fakultas" class="px-3 py-2 max-w-56 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                        <option value="">Semua Fakultas Naungan</option>
                        <option value="ilmu komputer">Fakultas Ilmu Komputer</option>
                        <option value="teknik">Fakultas Teknik</option>
                        <option value="ekonomi">Fakultas Ekonomi & Bisnis</option>
                        <option value="mipa">Fakultas Matematika & IPA</option>
                    </select>
                </div>

                <button type="button" onclick="openModal('modal-tambah-prodi')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2 font-semibold text-xs shadow-sm transition shrink-0 cursor-pointer">
                    <x-lucide-plus-circle class="size-4" />
                    Tambah Program Studi
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Kode Prodi</th>
                            <th class="px-6 py-4">Nama Program Studi</th>
                            <th class="px-6 py-4">Singkatan</th>
                            <th class="px-6 py-4">Fakultas Naungan (id_fakultas)</th>
                            <th class="px-6 py-4 text-center">Akumulasi Mahasiswa</th>
                            <th class="px-6 py-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-blue-50 text-primary border border-blue-200">
                                    IF
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">S1 Teknik Informatika</p>
                                <p class="text-xs text-slate-500 mt-0.5">Jenjang Sarjana (S1) · Akreditasi Unggul</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">TI</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span class="font-medium text-xs text-slate-800">Fakultas Ilmu Komputer</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                    <x-lucide-users class="size-3.5 text-slate-500" />
                                    420 Mahasiswa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-prodi')" title="Edit Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Program Studi S1 Teknik Informatika')" title="Hapus Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    SI
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">S1 Sistem Informasi</p>
                                <p class="text-xs text-slate-500 mt-0.5">Jenjang Sarjana (S1) · Akreditasi Unggul</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">SI</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span class="font-medium text-xs text-slate-800">Fakultas Ilmu Komputer</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                    <x-lucide-users class="size-3.5 text-slate-500" />
                                    350 Mahasiswa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-prodi')" title="Edit Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Program Studi S1 Sistem Informasi')" title="Hapus Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-teal-50 text-teal-700 border border-teal-200">
                                    TK
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">S1 Teknik Komputer</p>
                                <p class="text-xs text-slate-500 mt-0.5">Jenjang Sarjana (S1) · Akreditasi Baik Sekali</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">TK</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    <span class="font-medium text-xs text-slate-800">Fakultas Ilmu Komputer</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                    <x-lucide-users class="size-3.5 text-slate-500" />
                                    190 Mahasiswa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-prodi')" title="Edit Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Program Studi S1 Teknik Komputer')" title="Hapus Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 border border-orange-200">
                                    TE
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">S1 Teknik Elektro</p>
                                <p class="text-xs text-slate-500 mt-0.5">Jenjang Sarjana (S1) · Akreditasi Unggul</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">TE</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span class="font-medium text-xs text-slate-800">Fakultas Teknik</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                    <x-lucide-users class="size-3.5 text-slate-500" />
                                    220 Mahasiswa
                                </span>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-prodi')" title="Edit Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Program Studi S1 Teknik Elektro')" title="Hapus Program Studi" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                <span>Menampilkan 4 dari 8 program studi</span>
                <div class="flex items-center gap-1.5">
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Sebelumnya</button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold shadow-xs">1</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">2</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div id="section-fakultas" class="space-y-4 hidden">
        <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
            <div class="p-5 bg-surface border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="relative min-w-65 max-w-sm flex-1">
                    <input type="text" id="search-fakultas-input" placeholder="Cari Kode Fakultas atau Nama Fakultas..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                    <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                </div>

                <button type="button" onclick="openModal('modal-tambah-fakultas')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2 font-semibold text-xs shadow-sm transition shrink-0 cursor-pointer">
                    <x-lucide-plus-circle class="size-4" />
                    Tambah Fakultas Baru
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Kode Fakultas</th>
                            <th class="px-6 py-4">Nama Lengkap Fakultas</th>
                            <th class="px-6 py-4">Singkatan</th>
                            <th class="px-6 py-4 text-center">Jumlah Prodi Dinaungi</th>
                            <th class="px-6 py-4">Terdaftar Sejak</th>
                            <th class="px-6 py-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 border border-blue-200">
                                    FIK
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                        <x-lucide-laptop class="size-4" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Fakultas Ilmu Komputer</h4>
                                        <p class="text-xs text-slate-500">Menaungi jurusan teknologi informasi & komputasi</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">FIK</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20">
                                    <x-lucide-graduation-cap class="size-3.5" />
                                    3 Program Studi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                14 Okt 2026, 17:08
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-fakultas')" title="Edit Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Fakultas Ilmu Komputer')" title="Hapus Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 border border-orange-200">
                                    FT
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 border border-orange-100">
                                        <x-lucide-wrench class="size-4" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Fakultas Teknik</h4>
                                        <p class="text-xs text-slate-500">Menaungi disiplin rekayasa & teknologi industri</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">FT</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20">
                                    <x-lucide-graduation-cap class="size-3.5" />
                                    2 Program Studi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                14 Okt 2026, 17:08
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-fakultas')" title="Edit Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Fakultas Teknik')" title="Hapus Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    FEB
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                                        <x-lucide-line-chart class="size-4" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Fakultas Ekonomi & Bisnis</h4>
                                        <p class="text-xs text-slate-500">Menaungi manajemen, akuntansi, dan ekonomi</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">FEB</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20">
                                    <x-lucide-graduation-cap class="size-3.5" />
                                    2 Program Studi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                14 Okt 2026, 17:08
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-fakultas')" title="Edit Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Fakultas Ekonomi & Bisnis')" title="Hapus Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 border border-purple-200">
                                    FMIPA
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 border border-purple-100">
                                        <x-lucide-atom class="size-4" />
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Fakultas Matematika & IPA</h4>
                                        <p class="text-xs text-slate-500">Menaungi sains murni, matematika, dan statistika</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-xs text-slate-700">FMIPA</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20">
                                    <x-lucide-graduation-cap class="size-3.5" />
                                    1 Program Studi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                14 Okt 2026, 17:08
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" onclick="openModal('modal-tambah-fakultas')" title="Edit Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button type="button" onclick="confirmDelete('Fakultas Matematika & IPA')" title="Hapus Fakultas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                        <x-lucide-trash-2 class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                <span>Menampilkan 4 dari 4 fakultas</span>
                <div class="flex items-center gap-1.5">
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Sebelumnya</button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold shadow-xs">1</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-tambah-prodi" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-graduation-cap class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Program Studi</h3>
                    <p class="text-xs text-slate-500">Input data prodi baru</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-prodi')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-prodi'); alert('Program Studi berhasil ditambahkan!');" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Fakultas Naungan (id_fakultas) <span class="text-rose-500">*</span>
                </label>
                <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="">-- Pilih Fakultas Naungan --</option>
                    <option value="fik">Fakultas Ilmu Komputer (FIK)</option>
                    <option value="ft">Fakultas Teknik (FT)</option>
                    <option value="feb">Fakultas Ekonomi & Bisnis (FEB)</option>
                    <option value="fmipa">Fakultas Matematika & IPA (FMIPA)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Kode Program Studi (kode_prodi) <span class="text-rose-500">*</span>
                </label>
                <input type="text" required placeholder="Contoh: IF, SI, TI, TE" maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                <p class="text-[10px] text-slate-400 mt-1">Maksimal 10 karakter, unik di dalam database</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Nama Program Studi (nama_prodi) <span class="text-rose-500">*</span>
                </label>
                <input type="text" required placeholder="Contoh: S1 Teknik Informatika" maxlength="100" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Singkatan Program Studi (singkatan)
                </label>
                <input type="text" placeholder="Contoh: TI, SI, TK" maxlength="50" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-prodi')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Simpan Program Studi
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modal-tambah-fakultas" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-building-2 class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Fakultas Baru</h3>
                    <p class="text-xs text-slate-500">Input data fakultas baru</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-fakultas')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-fakultas'); alert('Fakultas baru berhasil ditambahkan!');" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Kode Fakultas (kode_fakultas) <span class="text-rose-500">*</span>
                </label>
                <input type="text" required placeholder="Contoh: FIK, FT, FEB, FKIP" maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                <p class="text-[10px] text-slate-400 mt-1">Maksimal 10 karakter, unik di dalam database</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Nama Lengkap Fakultas (nama_fakultas) <span class="text-rose-500">*</span>
                </label>
                <input type="text" required placeholder="Contoh: Fakultas Ilmu Komputer" maxlength="100" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Singkatan Fakultas (singkatan)
                </label>
                <input type="text" placeholder="Contoh: FIK, FT" maxlength="50" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-fakultas')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Simpan Fakultas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tab) {
        const btnProdi = document.getElementById('btn-tab-prodi');
        const btnFakultas = document.getElementById('btn-tab-fakultas');
        const sectionProdi = document.getElementById('section-prodi');
        const sectionFakultas = document.getElementById('section-fakultas');

        if (tab === 'prodi') {
            btnProdi.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer";
            btnProdi.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white";

            btnFakultas.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer";
            btnFakultas.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700";

            sectionProdi.classList.remove('hidden');
            sectionFakultas.classList.add('hidden');
        } else {
            btnFakultas.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer";
            btnFakultas.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white";

            btnProdi.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer";
            btnProdi.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700";

            sectionFakultas.classList.remove('hidden');
            sectionProdi.classList.add('hidden');
        }
    }

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function confirmDelete(entityName) {
        if (confirm(`Apakah Anda yakin ingin menghapus ${entityName}?\n\nTindakan ini dapat memengaruhi relasi data terkait di sistem.`)) {
            alert(`${entityName} berhasil dihapus.`);
        }
    }

    // Filter Prodi Realtime
    document.getElementById('search-prodi-input')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#section-prodi tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });

    // Filter Fakultas Realtime
    document.getElementById('search-fakultas-input')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#section-fakultas tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    });

    // Filter Prodi by Fakultas Dropdown
    document.getElementById('filter-prodi-fakultas')?.addEventListener('change', function(e) {
        const val = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#section-prodi tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = (!val || text.includes(val)) ? '' : 'none';
        });
    });

    // Backdrop click to close modal
    window.addEventListener('click', function(e) {
        if (e.target.id === 'modal-tambah-prodi') closeModal('modal-tambah-prodi');
        if (e.target.id === 'modal-tambah-fakultas') closeModal('modal-tambah-fakultas');
    });

    // Escape key to close modal
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modal-tambah-prodi');
            closeModal('modal-tambah-fakultas');
        }
    });
</script>
@endsection