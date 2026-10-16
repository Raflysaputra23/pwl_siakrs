@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center shrink-0">
                <x-lucide-users class="size-5" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Pengguna</h1>
                <p class="text-xs text-slate-600">Manajemen akun pengguna sistem, data induk mahasiswa, dan data dosen pengajar sesuai skema database.</p>
            </div>
        </div>

        <button type="button" onclick="openModal('modal-tambah-user')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer self-start sm:self-auto">
            <x-lucide-user-plus class="size-4" />
            Tambah Pengguna Baru
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Akun Pengguna</h2>
                <p class="text-2xl font-bold text-slate-900">1,215</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Mahasiswa</h2>
                <p class="text-2xl font-bold text-blue-600">1,180</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                <x-lucide-graduation-cap class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Dosen Pengajar</h2>
                <p class="text-2xl font-bold text-emerald-600">35</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-briefcase class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Mahasiswa Aktif</h2>
                <p class="text-2xl font-bold text-slate-900">1,150</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-badge-check class="size-5" />
            </div>
        </div>
    </div>

    <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
        <div class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <div class="relative min-w-65 max-w-sm flex-1">
                    <input type="text" id="search-user-input" placeholder="Cari NIP, NIM, Nama Lengkap..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                    <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                </div>

                <select id="filter-user-role" class="px-3 py-2 max-w-44 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                    <option value="">Semua Role Pengguna</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                </select>

                <select id="filter-user-status" class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="cuti">Cuti</option>
                    <option value="lulus">Lulus</option>
                    <option value="keluar">Keluar</option>
                </select>
            </div>

            <div class="text-xs text-slate-500 font-medium">
                Total: <span class="font-bold text-slate-800">5 Pengguna</span> ditampilkan
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Role & Identitas (NIM/NIP)</th>
                        <th class="px-6 py-4">Program Studi / Gelar</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0 border border-primary/20">
                                    RS
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">M. Rafly Saputra</h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-mail class="size-3 text-slate-400" />
                                        966raflisaputra@gmail.com
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <x-lucide-graduation-cap class="size-3" />
                                    Mahasiswa
                                </span>
                                <div class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <span class="text-slate-400 font-normal">NIM:</span> 2417051049
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-slate-800 text-xs">S1 Ilmu Komputer</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Angkatan 2024 · PA: Sandi Atim Wibowo, M.Kom.</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="openDetailUser('M. Rafly Saputra', 'Mahasiswa', '2417051049', '966raflisaputra@gmail.com', 'S1 Ilmu Komputer', '2024', 'Sandi Atim Wibowo, M.Kom.', 'Laki-Laki', '08123456789', 'Aktif', 'Bandar Lampung')" title="Lihat Detail Profil" class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                    <x-lucide-eye class="size-4" />
                                </button>
                                <button type="button" onclick="openModal('modal-tambah-user')" title="Edit Data Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button type="button" onclick="confirmDeleteUser('M. Rafly Saputra', '2417051049')" title="Hapus Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                    <x-lucide-trash-2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-2xl bg-emerald-600/10 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-600/20">
                                    HW
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">Dr. Ir. Hendra Wijaya, M.T.</h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-mail class="size-3 text-slate-400" />
                                        hendra.wijaya@univ.ac.id
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <x-lucide-briefcase class="size-3" />
                                    Dosen
                                </span>
                                <div class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <span class="text-slate-400 font-normal">NIP:</span> 198005122005011002
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-slate-800 text-xs">Rekayasa Perangkat Lunak</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Gelar: Dr. Ir. ... M.T.</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Aktif Mengajar
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="openDetailUser('Dr. Ir. Hendra Wijaya, M.T.', 'Dosen', '198005122005011002', 'hendra.wijaya@univ.ac.id', 'Rekayasa Perangkat Lunak', '-', 'Dosen Pembimbing Akademik', 'Laki-Laki', '081234567890', 'Aktif', 'Jl. Pendidikan No. 45')" title="Lihat Detail Profil" class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                    <x-lucide-eye class="size-4" />
                                </button>
                                <button type="button" onclick="openModal('modal-tambah-user')" title="Edit Data Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button type="button" onclick="confirmDeleteUser('Dr. Ir. Hendra Wijaya, M.T.', '198005122005011002')" title="Hapus Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                    <x-lucide-trash-2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs shrink-0 border border-indigo-200">
                                    DF
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">Dian Putri</h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-mail class="size-3 text-slate-400" />
                                        dian@gmail.com
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <x-lucide-graduation-cap class="size-3" />
                                    Mahasiswa
                                </span>
                                <div class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <span class="text-slate-400 font-normal">NPM:</span> 2417051049
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-slate-800 text-xs">S1 Ilmu Komputer</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Angkatan 2024 · PA: Dra. Tri Susilowati, M.Si.</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="openDetailUser('Annisa Putri', 'Mahasiswa', '2201010012', 'annisa.putri@mhs.ac.id', 'S1 Sistem Informasi', '2022', 'Dian Safitri, M.Kom.', 'Perempuan', '081298765432', 'Aktif', 'Gedong Meneng')" title="Lihat Detail Profil" class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                    <x-lucide-eye class="size-4" />
                                </button>
                                <button type="button" onclick="openModal('modal-tambah-user')" title="Edit Data Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button type="button" onclick="confirmDeleteUser('Annisa Putri', '2201010012')" title="Hapus Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                    <x-lucide-trash-2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-xs shrink-0 border border-teal-200">
                                    AF
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">Ahmad Fauzi, M.Kom.</h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-mail class="size-3 text-slate-400" />
                                        ahmad.fauzi@univ.ac.id
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <x-lucide-briefcase class="size-3" />
                                    Dosen
                                </span>
                                <div class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <span class="text-slate-400 font-normal">NIP:</span> 198207142010011003
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-slate-800 text-xs">Pemrograman Web & Basis Data</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Gelar: - ... M.Kom.</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Aktif Mengajar
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="openDetailUser('Ahmad Fauzi, M.Kom.', 'Dosen', '198207142010011003', 'ahmad.fauzi@univ.ac.id', 'Pemrograman Web & Basis Data', '-', 'Dosen Pengajar', 'Laki-Laki', '081345678912', 'Aktif', 'Jl. Mahoni Indah')" title="Lihat Detail Profil" class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                    <x-lucide-eye class="size-4" />
                                </button>
                                <button type="button" onclick="openModal('modal-tambah-user')" title="Edit Data Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button type="button" onclick="confirmDeleteUser('Ahmad Fauzi, M.Kom.', '198207142010011003')" title="Hapus Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                    <x-lucide-trash-2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs shrink-0 border border-amber-200">
                                    BP
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-slate-900 truncate">Bagus Pratama</h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-mail class="size-3 text-slate-400" />
                                        bagus.pratama@mhs.ac.id
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    <x-lucide-graduation-cap class="size-3" />
                                    Mahasiswa
                                </span>
                                <div class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <span class="text-slate-400 font-normal">NIM:</span> 2101010088
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-slate-800 text-xs">S1 Teknik Informatika</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Angkatan 2021 · PA: Dr. Budi Santoso</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                Cuti
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="openDetailUser('Bagus Pratama', 'Mahasiswa', '2101010088', 'bagus.pratama@mhs.ac.id', 'S1 Teknik Informatika', '2021', 'Dr. Budi Santoso, M.Cs.', 'Laki-Laki', '081223344556', 'Cuti', 'Rajabasa')" title="Lihat Detail Profil" class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                    <x-lucide-eye class="size-4" />
                                </button>
                                <button type="button" onclick="openModal('modal-tambah-user')" title="Edit Data Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button type="button" onclick="confirmDeleteUser('Bagus Pratama', '2101010088')" title="Hapus Pengguna" class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                    <x-lucide-trash-2 class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
            <span>Menampilkan 5 dari 1,215 pengguna</span>
            <div class="flex items-center gap-1.5">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Sebelumnya</button>
                <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold shadow-xs">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">2</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">3</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-tambah-user" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-2xl w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-6 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-user-plus class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Pengguna Baru</h3>
                    <p class="text-xs text-slate-500">Pembuatan akun sistem & input data induk sesuai skema database</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-user')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-user'); alert('Pengguna baru berhasil ditambahkan!');" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Pilih Peran Pengguna (Role Database) <span class="text-rose-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" id="role-btn-mahasiswa" onclick="setUserRole('mahasiswa')" class="p-3.5 rounded-2xl border-2 border-primary bg-primary/5 text-primary flex items-center gap-3 transition text-left cursor-pointer">
                        <div class="w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm">
                            <x-lucide-graduation-cap class="size-5" />
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Mahasiswa</p>
                        </div>
                    </button>

                    <button type="button" id="role-btn-dosen" onclick="setUserRole('dosen')" class="p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white text-slate-600 flex items-center gap-3 transition text-left cursor-pointer">
                        <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                            <x-lucide-briefcase class="size-5" />
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Dosen</p>
                        </div>
                    </button>
                </div>
                <input type="hidden" name="role" id="input-selected-role" value="mahasiswa" />
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center gap-2">
                    <x-lucide-key-round class="size-4 text-primary" />
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Kredensial Akun</h4>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Username Login <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="account-username" name="username" required placeholder="Contoh: 2201010045" maxlength="100" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono bg-white" />
                        <p class="text-[10px] text-slate-400 mt-1">Disarankan menggunakan NIM atau NIP</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Password Akun <span class="text-rose-500">*</span>
                        </label>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white" />
                        <p class="text-[10px] text-slate-400 mt-1">Tersimpan dalam format hashed di database</p>
                    </div>
                </div>
            </div>

            <div id="form-section-mahasiswa" class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-2">
                    <x-lucide-graduation-cap class="size-4 text-blue-600" />
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Data Induk Mahasiswa</h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            NIM (Nomor Induk Mahasiswa) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="mhs-nim" name="nim" maxlength="10" placeholder="10 karakter, cth: 2201010045" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="mhs-nama" name="nama_lengkap" maxlength="200" placeholder="Nama lengkap mahasiswa" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Program Studi (id_program_studi) <span class="text-rose-500">*</span>
                        </label>
                        <select name="id_program_studi" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="prodi-ti">S1 Teknik Informatika (IF)</option>
                            <option value="prodi-si">S1 Sistem Informasi (SI)</option>
                            <option value="prodi-tk">S1 Teknik Komputer (TK)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Dosen Pembimbing Akademik (dosen_pa_nip)
                        </label>
                        <select name="dosen_pa_nip" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="">-- Pilih Dosen PA --</option>
                            <option value="198005122005011002">Dr. Ir. Hendra Wijaya, M.T. (198005122005011002)</option>
                            <option value="198207142010011003">Ahmad Fauzi, M.Kom. (198207142010011003)</option>
                            <option value="197801122003121001">Dr. Budi Santoso, M.Cs. (197801122003121001)</option>
                            <option value="198611292012102001">Dian Safitri, M.Kom. (198611292012102001)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Angkatan <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="angkatan" maxlength="10" placeholder="Contoh: 2026" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Jenis Kelamin <span class="text-rose-500">*</span>
                        </label>
                        <select name="jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Email Mahasiswa
                        </label>
                        <input type="email" name="email_mhs" maxlength="200" placeholder="nama@mhs.ac.id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            No. Telepon / WhatsApp
                        </label>
                        <input type="tel" name="no_telp_mhs" maxlength="20" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Status Mahasiswa <span class="text-rose-500">*</span>
                        </label>
                        <select name="status_mhs" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="aktif" selected>Aktif</option>
                            <option value="cuti">Cuti</option>
                            <option value="lulus">Lulus</option>
                            <option value="keluar">Keluar</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Tempat Lahir
                        </label>
                        <input type="text" name="tempat_lahir" placeholder="Kota Kelahiran" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Tanggal Lahir
                        </label>
                        <input type="date" name="tgl_lahir" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Alamat Tinggal
                        </label>
                        <textarea name="alamat_mhs" rows="2" placeholder="Alamat domisili saat ini..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition"></textarea>
                    </div>
                </div>
            </div>

            <div id="form-section-dosen" class="space-y-4 hidden">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-2">
                    <x-lucide-briefcase class="size-4 text-emerald-600" />
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Data Induk Dosen</h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            NIP (Nomor Induk Pegawai) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="dsn-nip" name="nip" maxlength="20" placeholder="20 karakter, cth: 198005122005011002" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Nama Lengkap (Tanpa Gelar) <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="dsn-nama" name="nama_dosen" maxlength="200" placeholder="Contoh: Hendra Wijaya" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Gelar Depan
                        </label>
                        <input type="text" name="gelar_depan" maxlength="100" placeholder="Contoh: Dr. Ir., Prof." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Gelar Belakang
                        </label>
                        <input type="text" name="gelar_belakang" maxlength="100" placeholder="Contoh: M.T., M.Kom., Ph.D." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Email Resmi Dosen <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" name="email_dosen" maxlength="200" placeholder="dosen@univ.ac.id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            No. Telepon / WhatsApp
                        </label>
                        <input type="tel" name="no_telp_dosen" maxlength="20" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                            Alamat Tinggal
                        </label>
                        <textarea name="alamat_dosen" rows="2" placeholder="Alamat domisili saat ini..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition"></textarea>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-user')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Simpan Data Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modal-detail-user" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-user class="size-5" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900">Detail Profil Pengguna</h3>
                    <p class="text-xs text-slate-500">Rincian data user</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-detail-user')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <div class="space-y-4 text-xs">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2.5">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Nama Lengkap</span>
                    <span id="detail-nama" class="font-bold text-slate-900 text-sm">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Peran (Role)</span>
                    <span id="detail-role" class="font-semibold text-primary px-2 py-0.5 rounded-full bg-primary/10">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Nomor Induk (NIM/NIP)</span>
                    <span id="detail-nomor" class="font-mono font-bold text-slate-800">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Email</span>
                    <span id="detail-email" class="text-slate-700">-</span>
                </div>
            </div>

            <div class="space-y-2 border-t border-slate-100 pt-3">
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Prodi / Keahlian</span>
                    <span id="detail-prodi" class="font-semibold text-slate-800">-</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Angkatan / Dosen PA</span>
                    <span id="detail-pa" class="text-slate-700">-</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Jenis Kelamin</span>
                    <span id="detail-jk" class="text-slate-700">-</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">No. Telepon</span>
                    <span id="detail-telp" class="font-mono text-slate-700">-</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-slate-50">
                    <span class="text-slate-500">Status Akun</span>
                    <span id="detail-status" class="font-bold text-emerald-600">-</span>
                </div>
                <div class="flex justify-between items-start py-1">
                    <span class="text-slate-500">Alamat</span>
                    <span id="detail-alamat" class="text-slate-700 text-right max-w-xs">-</span>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="button" onclick="closeModal('modal-detail-user')" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function setUserRole(role) {
        const inputRole = document.getElementById('input-selected-role');
        const btnMhs = document.getElementById('role-btn-mahasiswa');
        const btnDsn = document.getElementById('role-btn-dosen');
        const formMhs = document.getElementById('form-section-mahasiswa');
        const formDsn = document.getElementById('form-section-dosen');
        const mhsNim = document.getElementById('mhs-nim');
        const mhsNama = document.getElementById('mhs-nama');
        const dsnNip = document.getElementById('dsn-nip');
        const dsnNama = document.getElementById('dsn-nama');

        inputRole.value = role;

        if (role === 'mahasiswa') {
            btnMhs.className = "p-3.5 rounded-2xl border-2 border-primary bg-primary/5 text-primary flex items-center gap-3 transition text-left cursor-pointer";
            btnMhs.querySelector('div').className = "w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm";

            btnDsn.className = "p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white text-slate-600 flex items-center gap-3 transition text-left cursor-pointer";
            btnDsn.querySelector('div').className = "w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0";

            formMhs.classList.remove('hidden');
            formDsn.classList.add('hidden');

            if (mhsNim) mhsNim.required = true;
            if (mhsNama) mhsNama.required = true;
            if (dsnNip) dsnNip.required = false;
            if (dsnNama) dsnNama.required = false;
        } else {
            btnDsn.className = "p-3.5 rounded-2xl border-2 border-emerald-600 bg-emerald-50 text-emerald-800 flex items-center gap-3 transition text-left cursor-pointer";
            btnDsn.querySelector('div').className = "w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm";

            btnMhs.className = "p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white text-slate-600 flex items-center gap-3 transition text-left cursor-pointer";
            btnMhs.querySelector('div').className = "w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0";

            formDsn.classList.remove('hidden');
            formMhs.classList.add('hidden');

            if (mhsNim) mhsNim.required = false;
            if (mhsNama) mhsNama.required = false;
            if (dsnNip) dsnNip.required = true;
            if (dsnNama) dsnNama.required = true;
        }
    }

    document.getElementById('mhs-nim')?.addEventListener('input', function(e) {
        const username = document.getElementById('account-username');
        if (username && (username.dataset.manual !== 'true')) {
            username.value = e.target.value;
        }
    });

    document.getElementById('dsn-nip')?.addEventListener('input', function(e) {
        const username = document.getElementById('account-username');
        if (username && (username.dataset.manual !== 'true')) {
            username.value = e.target.value;
        }
    });

    document.getElementById('account-username')?.addEventListener('input', function() {
        this.dataset.manual = 'true';
    });

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

    function openDetailUser(nama, role, nomor, email, prodi, angkatan, pa, jk, telp, status, alamat) {
        document.getElementById('detail-nama').textContent = nama;
        document.getElementById('detail-role').textContent = role;
        document.getElementById('detail-nomor').textContent = nomor;
        document.getElementById('detail-email').textContent = email;
        document.getElementById('detail-prodi').textContent = prodi;
        document.getElementById('detail-pa').textContent = role === 'Mahasiswa' ? `Angkatan ${angkatan} · PA: ${pa}` : pa;
        document.getElementById('detail-jk').textContent = jk;
        document.getElementById('detail-telp').textContent = telp;
        document.getElementById('detail-status').textContent = status;
        document.getElementById('detail-alamat').textContent = alamat;

        openModal('modal-detail-user');
    }

    function confirmDeleteUser(nama, nomor) {
        if (confirm(`Apakah Anda yakin ingin menghapus data pengguna:\n\nNama: ${nama}\nIdentitas: ${nomor}\n.`)) {
            alert(`Pengguna ${nama} (${nomor}) berhasil dihapus.`);
        }
    }

    document.getElementById('filter-user-role')?.addEventListener('change', function(e) {
        const val = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (!val || text.includes(val)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('search-user-input')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    window.addEventListener('click', function(e) {
        if (e.target.id === 'modal-tambah-user') closeModal('modal-tambah-user');
        if (e.target.id === 'modal-detail-user') closeModal('modal-detail-user');
    });

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modal-tambah-user');
            closeModal('modal-detail-user');
        }
    });
</script>
@endsection