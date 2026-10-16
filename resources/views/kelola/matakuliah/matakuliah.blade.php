@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center shrink-0">
                <x-lucide-library-big class="size-5" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Mata Kuliah & Kelas</h1>
                <p class="text-xs text-slate-600">Manajemen kurikulum program studi, bobot SKS, alokasi kelas, dan jadwal perkuliahan.</p>
            </div>
        </div>

        <div class="inline-flex rounded-2xl bg-surface p-1.5 border border-slate-200 shadow-sm self-start sm:self-auto">
            <button type="button" id="btn-tab-matakuliah" onclick="switchTab('matakuliah')" class="tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm">
                <x-lucide-book-open class="size-4" />
                Mata Kuliah
                <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white">142</span>
            </button>
            <button type="button" id="btn-tab-kelas" onclick="switchTab('kelas')" class="tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900">
                <x-lucide-calendar class="size-4" />
                Kelas Perkuliahan
                <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700">58</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Mata Kuliah</h2>
                <p class="text-2xl font-bold text-slate-900">142</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-book-open class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Wajib</h2>
                <p class="text-2xl font-bold text-slate-900">110</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                <x-lucide-bookmark class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Peminatan</h2>
                <p class="text-2xl font-bold text-slate-900">32</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center">
                <x-lucide-sparkles class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Kelas Aktif</h2>
                <p class="text-2xl font-bold text-slate-900">58</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-door-open class="size-5" />
            </div>
        </div>
    </div>

    <div id="section-matakuliah" class="space-y-4">
        <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
            <div class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    <div class="relative min-w-65 max-w-sm flex-1">
                        <input type="text" placeholder="Cari Kode MK atau Nama Mata Kuliah..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                        <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    </div>

                    <select class="px-3 py-2 max-w-50 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Semua Program Studi</option>
                        <option value="if">S1 Teknik Informatika</option>
                        <option value="si">S1 Sistem Informasi</option>
                        <option value="rpl">S1 Rekayasa Perangkat Lunak</option>
                        <option value="mi">D3 Manajemen Informatika</option>
                    </select>

                    <select class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Semua Jenis</option>
                        <option value="wajib">Wajib</option>
                        <option value="peminatan">Peminatan</option>
                    </select>

                    <select class="px-3 py-2 max-w-35 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Semua Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>

                <button type="button" onclick="openModal('modal-tambah-matakuliah')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer">
                    <x-lucide-plus-circle class="size-4" />
                    Tambah Mata Kuliah
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">KODE MK</th>
                            <th class="px-6 py-4">NAMA MATA KULIAH</th>
                            <th class="px-6 py-4">PROGRAM STUDI</th>
                            <th class="px-6 py-4 text-center">JENIS</th>
                            <th class="px-6 py-4 text-center">SEMESTER</th>
                            <th class="px-6 py-4 text-center">SKS</th>
                            <th class="px-6 py-4 text-center">KELAS TERBUKA</th>
                            <th class="px-6 py-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                    IF5101
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Pemrograman Web Lanjut</p>
                                <p class="text-xs text-slate-500">Full-Stack Development, REST API & Security</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                    S1 Teknik Informatika
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                    Wajib
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                Smt 5
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                    3 SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <x-lucide-door-open class="size-3.5" />
                                    2 Kelas
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                    IF5102
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Rekayasa Perangkat Lunak</p>
                                <p class="text-xs text-slate-500">SDLC, Scrum, UML Modeling & Testing</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                    S1 Teknik Informatika
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                    Wajib
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                Smt 5
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                    3 SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <x-lucide-door-open class="size-3.5" />
                                    2 Kelas
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                    IF5103
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Kecerdasan Buatan (Artificial Intelligence)</p>
                                <p class="text-xs text-slate-500">Machine Learning, Neural Networks & Reasoning</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                    S1 Teknik Informatika
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                    Wajib
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                Smt 5
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                    3 SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <x-lucide-door-open class="size-3.5" />
                                    2 Kelas
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                    IF5201
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Cloud Computing & DevOps</p>
                                <p class="text-xs text-slate-500">Docker, Kubernetes, AWS, CI/CD Pipeline</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                    S1 Teknik Informatika
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200 inline-block capitalize">
                                    Peminatan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                Smt 5
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                    3 SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <x-lucide-door-open class="size-3.5" />
                                    1 Kelas
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                    SI3101
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Analisis & Perancangan Sistem Informasi</p>
                                <p class="text-xs text-slate-500">Business Process Reengineering & Requirements</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                    S1 Sistem Informasi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                    Wajib
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                Smt 3
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                    3 SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <x-lucide-door-open class="size-3.5" />
                                    2 Kelas
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Mata Kuliah" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
                <span>Menampilkan 5 dari 142 mata kuliah</span>
                <div class="flex items-center gap-1">
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Sebelumnya</button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">2</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">3</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div id="section-kelas" class="space-y-4 hidden">
        <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
            <div class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    <div class="relative min-w-65 max-w-sm flex-1">
                        <input type="text" placeholder="Cari Nama Kelas, Ruangan, Dosen..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                        <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    </div>

                    <select class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Semua Hari</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>

                    <select class="px-3 py-2 max-w-55 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Semua Mata Kuliah</option>
                        <option value="IF5101">Pemrograman Web Lanjut</option>
                        <option value="IF5102">Rekayasa Perangkat Lunak</option>
                        <option value="IF5103">Kecerdasan Buatan</option>
                        <option value="IF5201">Cloud Computing & DevOps</option>
                    </select>

                    <select class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                        <option value="">Status Kuota</option>
                        <option value="tersedia">Masih Tersedia</option>
                        <option value="penuh">Penuh (100%)</option>
                    </select>
                </div>

                <button type="button" onclick="openModal('modal-tambah-kelas')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer">
                    <x-lucide-plus-circle class="size-4" />
                    Buka Kelas Baru
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">KELAS</th>
                            <th class="px-6 py-4">MATA KULIAH</th>
                            <th class="px-6 py-4">DOSEN PENGAMPU</th>
                            <th class="px-6 py-4">JADWAL KULIAH</th>
                            <th class="px-6 py-4">RUANGAN</th>
                            <th class="px-6 py-4 text-center">KAPASITAS / KUOTA</th>
                            <th class="px-6 py-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-xs inline-block">
                                    IF-5A
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Pemrograman Web Lanjut</p>
                                <span class="font-mono text-xs text-slate-500">Kode: IF5101 · 3 SKS</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800 text-xs">Ahmad Fauzi, M.Kom.</p>
                                    <p class="text-[11px] text-primary font-medium">Koordinator · NIP 198207142010011003</p>
                                </div>
                                <div class="mt-1">
                                    <p class="text-xs text-slate-600">Rian Hidayat, M.T.</p>
                                    <p class="text-[11px] text-slate-400">Pendamping · NIP 198902112015041001</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Senin, 08:00 - 10:30
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Durasi 150 Menit</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-xs font-medium text-slate-700">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Rekayasa Komputer (LRK-02)
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="space-y-1">
                                    <span class="font-bold text-slate-800 text-xs">38 / 40 Kursi</span>
                                    <div class="w-28 mx-auto bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 95%"></div>
                                    </div>
                                    <span class="text-[10px] font-semibold text-emerald-600">Sisa 2 Kursi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-xs inline-block">
                                    IF-5B
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Pemrograman Web Lanjut</p>
                                <span class="font-mono text-xs text-slate-500">Kode: IF5101 · 3 SKS</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800 text-xs">Ahmad Fauzi, M.Kom.</p>
                                    <p class="text-[11px] text-primary font-medium">Koordinator · NIP 198207142010011003</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Senin, 10:45 - 13:15
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Durasi 150 Menit</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-xs font-medium text-slate-700">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Rekayasa Komputer (LRK-02)
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="space-y-1">
                                    <span class="font-bold text-slate-800 text-xs">40 / 40 Kursi</span>
                                    <div class="w-28 mx-auto bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-rose-500 h-1.5 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-[10px] font-bold text-rose-600">Penuh (100%)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-xs inline-block">
                                    IF-5A
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Rekayasa Perangkat Lunak</p>
                                <span class="font-mono text-xs text-slate-500">Kode: IF5102 · 3 SKS</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800 text-xs">Dr. Ir. Hendra Wijaya, M.T.</p>
                                    <p class="text-[11px] text-primary font-medium">Koordinator · NIP 198005122005011002</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Senin, 13:00 - 15:30
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Durasi 150 Menit</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-xs font-medium text-slate-700">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Gedung D - Ruang D304
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="space-y-1">
                                    <span class="font-bold text-slate-800 text-xs">38 / 40 Kursi</span>
                                    <div class="w-28 mx-auto bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 95%"></div>
                                    </div>
                                    <span class="text-[10px] font-semibold text-emerald-600">Sisa 2 Kursi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-xs inline-block">
                                    IF-P1
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Cloud Computing & DevOps</p>
                                <span class="font-mono text-xs text-slate-500">Kode: IF5201 · 3 SKS</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-800 text-xs">Eko Prasetyo, M.T.</p>
                                    <p class="text-[11px] text-primary font-medium">Koordinator · NIP 198904152014041002</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Rabu, 10:00 - 12:30
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">Durasi 150 Menit</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-xs font-medium text-slate-700">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Gedung D - Ruang D201
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="space-y-1">
                                    <span class="font-bold text-slate-800 text-xs">30 / 35 Kursi</span>
                                    <div class="w-28 mx-auto bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 85.7%"></div>
                                    </div>
                                    <span class="text-[10px] font-semibold text-emerald-600">Sisa 5 Kursi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button title="Edit Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition">
                                        <x-lucide-edit class="size-4" />
                                    </button>
                                    <button title="Hapus Kelas" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition">
                                        <x-lucide-trash class="size-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
                <span>Menampilkan 4 dari 58 kelas perkuliahan aktif</span>
                <div class="flex items-center gap-1">
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Sebelumnya</button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">2</button>
                    <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-tambah-matakuliah" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-book-open class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Mata Kuliah</h3>
                    <p class="text-xs text-slate-500">Input data mata kuliah baru ke dalam kurikulum</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-matakuliah')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-matakuliah');" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Program Studi <span class="text-rose-500">*</span>
                </label>
                <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="" disabled selected>Pilih Program Studi</option>
                    <option value="if">S1 Teknik Informatika (Fakultas Ilmu Komputer)</option>
                    <option value="si">S1 Sistem Informasi (Fakultas Ilmu Komputer)</option>
                    <option value="rpl">S1 Rekayasa Perangkat Lunak (Fakultas Teknik)</option>
                    <option value="mi">D3 Manajemen Informatika (Vokasi)</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="sm:col-span-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kode MK <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="IF5101" maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono uppercase focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    <p class="text-[10px] text-slate-400 mt-1">Maks 10 karakter unik</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Mata Kuliah <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="Contoh: Pemrograman Web Lanjut" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Jenis MK <span class="text-rose-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="wajib" selected>Wajib</option>
                        <option value="peminatan">Peminatan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ $i == 5 ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Bobot SKS <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" required min="1" max="6" value="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-matakuliah')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Simpan Mata Kuliah
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modal-tambah-kelas" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-xl w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-lucide-door-open class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Buka Kelas Perkuliahan Baru</h3>
                    <p class="text-xs text-slate-500">Alokasikan mata kuliah, dosen pengampu, jadwal dan ruangan</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-kelas')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-kelas');" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Mata Kuliah <span class="text-rose-500">*</span>
                </label>
                <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="" disabled selected>Pilih Mata Kuliah yang Dibuka</option>
                    <option value="mk-1">IF5101 - Pemrograman Web Lanjut (3 SKS)</option>
                    <option value="mk-2">IF5102 - Rekayasa Perangkat Lunak (3 SKS)</option>
                    <option value="mk-3">IF5103 - Kecerdasan Buatan (3 SKS)</option>
                    <option value="mk-4">IF5201 - Cloud Computing & DevOps (3 SKS)</option>
                    <option value="mk-5">SI3101 - Analisis & Perancangan SI (3 SKS)</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Kelas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="Contoh: IF-5A atau Kelas A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    <p class="text-[10px] text-slate-400 mt-1">Format: Nama/Kode Paralel Kelas</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kapasitas / Kuota Mahasiswa <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" required min="5" max="150" value="40" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-medium">Kursi</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Dosen Koordinator (Utama) <span class="text-rose-500">*</span>
                </label>
                <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="" disabled selected>Pilih Dosen Koordinator</option>
                    <option value="198207142010011003">Ahmad Fauzi, M.Kom. (NIP: 198207142010011003)</option>
                    <option value="198005122005011002">Dr. Ir. Hendra Wijaya, M.T. (NIP: 198005122005011002)</option>
                    <option value="198503202008122001">Siti Rahmawati, M.Cs. (NIP: 198503202008122001)</option>
                    <option value="198904152014041002">Eko Prasetyo, M.T. (NIP: 198904152014041002)</option>
                    <option value="198611292012102001">Dian Safitri, M.Kom. (NIP: 198611292012102001)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Dosen Pendamping / Team Teaching <span class="text-slate-400 font-normal">(Opsional)</span>
                </label>
                <select class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="">Tidak Ada (Dosen Tunggal)</option>
                    <option value="198902112015041001">Rian Hidayat, M.T. (NIP: 198902112015041001)</option>
                    <option value="199008242018032002">Rina Kusuma, M.Ds. (NIP: 199008242018032002)</option>
                    <option value="198503202008122001">Siti Rahmawati, M.Cs. (NIP: 198503202008122001)</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Hari <span class="text-rose-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="senin" selected>Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Jam Mulai <span class="text-rose-500">*</span>
                    </label>
                    <input type="time" required value="08:00" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Jam Selesai <span class="text-rose-500">*</span>
                    </label>
                    <input type="time" required value="10:30" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Ruangan Perkuliahan <span class="text-rose-500">*</span>
                </label>
                <input type="text" required placeholder="Contoh: Lab Rekayasa Komputer (LRK-02) / Gedung D Ruang D304" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-kelas')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Buka Kelas Kuliah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tab) {
        const btnMk = document.getElementById('btn-tab-matakuliah');
        const btnKelas = document.getElementById('btn-tab-kelas');
        const secMk = document.getElementById('section-matakuliah');
        const secKelas = document.getElementById('section-kelas');

        if (tab === 'matakuliah') {
            btnMk.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm';
            btnKelas.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900';
            secMk.classList.remove('hidden');
            secKelas.classList.add('hidden');
        } else {
            btnKelas.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm';
            btnMk.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900';
            secKelas.classList.remove('hidden');
            secMk.classList.add('hidden');
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

    window.addEventListener('click', function(e) {
        if (e.target.id === 'modal-tambah-matakuliah') closeModal('modal-tambah-matakuliah');
        if (e.target.id === 'modal-tambah-kelas') closeModal('modal-tambah-kelas');
    });

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modal-tambah-matakuliah');
            closeModal('modal-tambah-kelas');
        }
    });
</script>
@endsection
