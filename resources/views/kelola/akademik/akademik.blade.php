@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center shrink-0">
                <x-lucide-calendar class="size-5" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Tahun Akademik</h1>
                <p class="text-xs text-slate-600">Manajemen periode tahun ajaran, semester ganjil/genap, dan penetapan status tahun akademik aktif.</p>
            </div>
        </div>

        <button type="button" onclick="openModal('modal-tambah-akademik')" class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer self-start sm:self-auto">
            <x-lucide-plus-circle class="size-4" />
            Tambah Tahun Akademik
        </button>
    </div>

    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold backdrop-blur-md">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Semester (Aktif)
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tahun Akademik 2026/2027 - Ganjil</h2>
                <p class="text-blue-100 text-sm max-w-2xl leading-relaxed">
                    Seluruh proses perkuliahan tahun akademik dikelola disini.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 shrink-0">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">Mahasiswa Terdaftar</p>
                    <p class="text-xl font-extrabold text-white mt-0.5">1,180</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">KRS Diajukan</p>
                    <p class="text-xl font-extrabold text-white mt-0.5">920</p>
                </div>
                <div class="col-span-2 sm:col-span-1 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">Status Sistem</p>
                    <p class="text-sm font-bold text-emerald-300 mt-1">Aktif</p>
                </div>
            </div>
        </div>
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Tahun Akademik Aktif</h2>
                <p class="text-xl font-bold text-slate-900">2026/2027</p>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Semester Ganjil
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-check-circle-2 class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Periode Riwayat</h2>
                <p class="text-2xl font-bold text-slate-900">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-history class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Status Tahun Berjalan</h2>
                <p class="text-xl font-bold text-emerald-600">Aktif</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-power class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Data Mahasiswa</h2>
                <p class="text-2xl font-bold text-slate-900">1,180</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>
    </div>

    <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
        <div class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3 flex-1">
                <div class="relative min-w-65 max-w-sm flex-1">
                    <input type="text" placeholder="Cari Tahun Akademik (contoh: 2026/2027)..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                    <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                </div>

                <select class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                    <option value="">Semua Semester</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>

                <select class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="non-aktif">Non-Aktif</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">TAHUN AKADEMIK</th>
                        <th class="px-6 py-4 text-center">SEMESTER</th>
                        <th class="px-6 py-4 text-center">STATUS</th>
                        <th class="px-6 py-4 text-center">MAHASISWA TERDAFTAR</th>
                        <th class="px-6 py-4">TANGGAL DIBUAT</th>
                        <th class="px-6 py-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="bg-emerald-50/20 hover:bg-emerald-50/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                    <x-lucide-calendar-check class="size-4" />
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 text-sm">2026/2027</span>
                                    <span class="block text-xs text-emerald-600 font-semibold">Tahun Ajaran Berjalan</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                Ganjil
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-800">
                            1,180 <span class="text-xs font-normal text-slate-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 font-mono">
                            14 Okt 2026 17:08
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button title="Tahun Akademik Sedang Aktif" disabled class="px-2.5 py-1.5 rounded-xl bg-slate-100 text-slate-400 text-xs font-semibold cursor-not-allowed border border-slate-200">
                                    Aktif
                                </button>
                                <button title="Edit Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button title="Hapus Tahun Akademik" disabled class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-300 cursor-not-allowed">
                                    <x-lucide-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                                    <x-lucide-calendar class="size-4" />
                                </div>
                                <div>
                                    <span class="font-bold text-slate-800 text-sm">2025/2026</span>
                                    <span class="block text-xs text-slate-400">Arsip Perkuliahan</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200 inline-block capitalize">
                                Genap
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                Non-Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-slate-700">
                            1,152 <span class="text-xs font-normal text-slate-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 font-mono">
                            15 Jan 2026 09:30
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="confirmActivate('2025/2026', 'Genap')" class="px-2.5 py-1.5 rounded-xl bg-primary/10 border border-primary/30 text-primary hover:bg-primary hover:text-white text-xs font-semibold transition cursor-pointer">
                                    Set Aktif
                                </button>
                                <button title="Edit Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button title="Hapus Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                    <x-lucide-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                                    <x-lucide-calendar class="size-4" />
                                </div>
                                <div>
                                    <span class="font-bold text-slate-800 text-sm">2025/2026</span>
                                    <span class="block text-xs text-slate-400">Arsip Perkuliahan</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 inline-block capitalize">
                                Ganjil
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                Non-Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-slate-700">
                            1,120 <span class="text-xs font-normal text-slate-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 font-mono">
                            20 Agu 2025 10:15
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="confirmActivate('2025/2026', 'Ganjil')" class="px-2.5 py-1.5 rounded-xl bg-primary/10 border border-primary/30 text-primary hover:bg-primary hover:text-white text-xs font-semibold transition cursor-pointer">
                                    Set Aktif
                                </button>
                                <button title="Edit Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button title="Hapus Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                    <x-lucide-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                                    <x-lucide-calendar class="size-4" />
                                </div>
                                <div>
                                    <span class="font-bold text-slate-800 text-sm">2024/2025</span>
                                    <span class="block text-xs text-slate-400">Arsip Perkuliahan</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200 inline-block capitalize">
                                Genap
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                Non-Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center font-medium text-slate-700">
                            1,085 <span class="text-xs font-normal text-slate-400">Mahasiswa</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 font-mono">
                            10 Jan 2025 14:00
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="confirmActivate('2024/2025', 'Genap')" class="px-2.5 py-1.5 rounded-xl bg-primary/10 border border-primary/30 text-primary hover:bg-primary hover:text-white text-xs font-semibold transition cursor-pointer">
                                    Set Aktif
                                </button>
                                <button title="Edit Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                    <x-lucide-edit class="size-4" />
                                </button>
                                <button title="Hapus Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                    <x-lucide-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan 4 dari 8 periode tahun akademik</span>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Sebelumnya</button>
                <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">2</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-tambah-akademik" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-calendar-plus class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Tahun Akademik</h3>
                    <p class="text-xs text-slate-500">Buat periode kalender akademik perkuliahan baru</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-tambah-akademik')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form onsubmit="event.preventDefault(); closeModal('modal-tambah-akademik');" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Tahun Akademik <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="Contoh: 2027/2028" maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono" />
                    <p class="text-[10px] text-slate-400 mt-1">Format: YYYY/YYYY (maks 10 karakter)</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="ganjil" selected>Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Status Tahun Akademik <span class="text-rose-500">*</span>
                </label>
                <select required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="non-aktif" selected>Non-Aktif (Default)</option>
                    <option value="aktif">Aktif (Akan menonaktifkan tahun berjalan saat ini)</option>
                </select>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah-akademik')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Simpan Tahun Akademik
                </button>
            </div>
        </form>
    </div>
</div>

<script>
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

    function confirmActivate(tahun, semester) {
        if (confirm(`Apakah Anda yakin ingin mengaktifkan Tahun Akademik ${tahun} - Semester ${semester}?\n\nTindakan ini akan menonaktifkan tahun akademik yang sedang aktif saat ini.`)) {
            alert(`Tahun Akademik ${tahun} - ${semester} berhasil diaktifkan!`);
        }
    }

    // Backdrop click to close
    window.addEventListener('click', function(e) {
        if (e.target.id === 'modal-tambah-akademik') closeModal('modal-tambah-akademik');
    });

    // Escape key to close
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modal-tambah-akademik');
        }
    });
</script>
@endsection
