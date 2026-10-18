@extends('layouts.app')

@section('content')
<div class="space-y-6">
        @if (session('error'))
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-3.5 text-xs text-red-700">
                <x-lucide-alert-circle class="size-4 shrink-0 text-red-600 mt-0.5" />
                <span>{{ session('error') }}</span>
            </div>
        @elseif(session('success'))
            <div
                class="mb-5 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-3.5 text-xs text-green-700">
                <x-lucide-alert-circle class="size-4 shrink-0 text-green-600 mt-0.5" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-3.5 text-xs text-red-700">
                <x-lucide-alert-circle class="size-4 shrink-0 text-red-600 mt-0.5" />
                <span>Data gagal disimpan, Silahkan cek kembali isian form anda</span>
            </div>
        @endif

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
                @if($tahunAkademikAktif)
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold backdrop-blur-md">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Semester {{ ucfirst($tahunAkademikAktif->semester) }} (Aktif)
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tahun Akademik {{ $tahunAkademikAktif->tahun }} - {{ ucfirst($tahunAkademikAktif->semester) }}</h2>
                @else
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold backdrop-blur-md">
                        <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span>
                        Belum Ada Periode Aktif
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Tidak Ada Tahun Akademik Aktif</h2>
                @endif
                <p class="text-blue-100 text-sm max-w-2xl leading-relaxed">
                    Seluruh proses perkuliahan tahun akademik dikelola disini.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 shrink-0">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">Mahasiswa Terdaftar</p>
                    <p class="text-xl font-extrabold text-white mt-0.5">{{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">KRS Diajukan</p>
                    <p class="text-xl font-extrabold text-white mt-0.5">{{ number_format($totalKrs ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-2 sm:col-span-1 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-3.5 text-center">
                    <p class="text-[11px] text-blue-200 uppercase font-semibold">Status Sistem</p>
                    <p class="text-sm font-bold {{ $tahunAkademikAktif ? 'text-emerald-300' : 'text-slate-300' }} mt-1">
                        {{ $tahunAkademikAktif ? 'Aktif' : 'Non-Aktif' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Tahun Akademik Aktif</h2>
                <p class="text-xl font-bold text-slate-900">{{ $tahunAkademikAktif->tahun ?? '-' }}</p>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold {{ $tahunAkademikAktif ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                    Semester {{ ucfirst($tahunAkademikAktif->semester ?? '-') }}
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <x-lucide-check-circle-2 class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Periode Riwayat</h2>
                <p class="text-2xl font-bold text-slate-900">{{ count($tahunAkademik) }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-history class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Status Tahun Berjalan</h2>
                <p class="text-xl font-bold {{ $tahunAkademikAktif ? 'text-emerald-600' : 'text-slate-400' }}">
                    {{ $tahunAkademikAktif ? 'Aktif' : 'Non-Aktif' }}
                </p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow-sm {{ $tahunAkademikAktif ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center">
                <x-lucide-power class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500 font-medium">Total Data Mahasiswa</h2>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }}</p>
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
                    <input type="text" id="search-akademik-input" placeholder="Cari Tahun Akademik (contoh: 2026/2027)..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                    <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                </div>

                <select id="filter-akademik-semester" class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                    <option value="">Semua Semester</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>

                <select id="filter-akademik-status" class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="non-aktif">Non-Aktif</option>
                </select>
            </div>

            <div class="text-xs text-slate-500 font-medium">
                Total: <span class="font-bold text-slate-800">{{ count($tahunAkademik) }} Periode</span> terdaftar
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
                <tbody id="tbody-akademik" class="divide-y divide-slate-100">
                    @forelse ($tahunAkademik as $ta)
                        @php
                            $isAktif = $ta->status === 'aktif';
                        @endphp
                        <tr class="{{ $isAktif ? 'bg-emerald-50/20 hover:bg-emerald-50/40' : 'hover:bg-slate-50/70' }} transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl {{ $isAktif ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-bold text-xs">
                                        @if($isAktif)
                                            <x-lucide-calendar-check class="size-4" />
                                        @else
                                            <x-lucide-calendar class="size-4" />
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-900 text-sm">{{ $ta->tahun }}</span>
                                        <span class="block text-xs {{ $isAktif ? 'text-emerald-600 font-semibold' : 'text-slate-400' }}">
                                            {{ $isAktif ? 'Tahun Ajaran Berjalan' : 'Arsip Perkuliahan' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $ta->semester === 'ganjil' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200' }} inline-block capitalize">
                                    {{ ucfirst($ta->semester) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($isAktif)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center {{ $isAktif ? 'font-bold text-slate-800' : 'font-medium text-slate-700' }}">
                                {{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }} <span class="text-xs font-normal text-slate-400">Mahasiswa</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $ta->created_at ? $ta->created_at->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if($isAktif)
                                        <button title="Tahun Akademik Sedang Aktif" disabled class="px-2.5 py-1.5 rounded-xl bg-slate-100 text-slate-400 text-xs font-semibold cursor-not-allowed border border-slate-200">
                                            Aktif
                                        </button>
                                    @else
                                        <button type="button" onclick="confirmActivate('{{ $ta->tahun }}', '{{ ucfirst($ta->semester) }}', '{{ route('kelola.akademik.set-aktif', $ta->id) }}')" class="px-2.5 py-1.5 rounded-xl bg-primary/10 border border-primary/30 text-primary hover:bg-primary hover:text-white text-xs font-semibold transition cursor-pointer">
                                            Set Aktif
                                        </button>
                                    @endif

                                    <button type="button" onclick="openEditAkademik('{{ $ta->id }}', '{{ $ta->tahun }}', '{{ $ta->semester }}', '{{ $ta->status }}')" title="Edit Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                        <x-lucide-edit class="size-4" />
                                    </button>

                                    @if($isAktif)
                                        <button title="Tahun Akademik Aktif tidak dapat dihapus" disabled class="w-8 h-8 flex items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-300 cursor-not-allowed">
                                            <x-lucide-trash class="size-4" />
                                        </button>
                                    @else
                                        <button type="button" onclick="confirmDeleteAkademik('{{ $ta->tahun }}', '{{ ucfirst($ta->semester) }}', '{{ route('kelola.akademik.destroy', $ta->id) }}')" title="Hapus Tahun Akademik" class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                            <x-lucide-trash class="size-4" />
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center">
                                    <x-lucide-calendar class="size-10 mb-2 text-slate-300" />
                                    <p class="text-sm font-semibold text-slate-600">Belum ada Periode Tahun Akademik</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan tahun akademik baru melalui tombol di atas.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan {{ count($tahunAkademik) }} periode tahun akademik</span>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Sebelumnya</button>
                <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH TAHUN AKADEMIK --}}
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

        <form action="{{ route('kelola.akademik.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Tahun Akademik <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="tahun" required placeholder="Contoh: 2026/2027" maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    <p class="text-[10px] text-slate-400 mt-1">Format: YYYY/YYYY (maks 10 karakter)</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <select name="semester" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="ganjil" selected>Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Status Tahun Akademik <span class="text-rose-500">*</span>
                </label>
                <select name="status" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="non-aktif" selected>Non-Aktif</option>
                    <option value="aktif">Aktif</option>
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

{{-- MODAL EDIT TAHUN AKADEMIK --}}
<div id="modal-edit-akademik" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
    <div class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-yellow-500/10 text-yellow-600 flex items-center justify-center">
                    <x-lucide-edit class="size-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Edit Tahun Akademik</h3>
                    <p class="text-xs text-slate-500">Perbarui informasi periode tahun akademik perkuliahan</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modal-edit-akademik')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <form id="form-edit-akademik" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Tahun Akademik <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="edit-akademik-tahun" name="tahun" required maxlength="10" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    <p class="text-[10px] text-slate-400 mt-1">Format: YYYY/YYYY</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <select id="edit-akademik-semester" name="semester" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Status Tahun Akademik <span class="text-rose-500">*</span>
                </label>
                <select id="edit-akademik-status" name="status" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                    <option value="non-aktif">Non-Aktif</option>
                    <option value="aktif">Aktif (Akan menonaktifkan tahun berjalan saat ini)</option>
                </select>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-edit-akademik')" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                    <x-lucide-check-circle-2 class="size-4" />
                    Perbarui Tahun Akademik
                </button>
            </div>
        </form>
    </div>
</div>

<form id="activate-akademik-form" action="" method="POST" class="hidden">
    @csrf
</form>

<form id="delete-akademik-form" action="" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

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

    function openEditAkademik(id, tahun, semester, status) {
        const form = document.getElementById('form-edit-akademik');
        if (form) {
            form.action = "{{ url('/kelola/akademik/update') }}/" + id;
        }
        document.getElementById('edit-akademik-tahun').value = tahun;
        document.getElementById('edit-akademik-semester').value = semester;
        document.getElementById('edit-akademik-status').value = status;

        openModal('modal-edit-akademik');
    }

    function confirmActivate(tahun, semester, activateUrl) {
        if (confirm(`Apakah Anda yakin ingin mengaktifkan Tahun Akademik:\n\n${tahun} - Semester ${semester}?\n\nTindakan ini akan menonaktifkan tahun akademik yang sedang aktif saat ini.`)) {
            const form = document.getElementById('activate-akademik-form');
            if (form && activateUrl) {
                form.action = activateUrl;
                form.submit();
            }
        }
    }

    function confirmDeleteAkademik(tahun, semester, deleteUrl) {
        if (confirm(`Apakah Anda yakin ingin menghapus Tahun Akademik:\n\n${tahun} - Semester ${semester}?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            const form = document.getElementById('delete-akademik-form');
            if (form && deleteUrl) {
                form.action = deleteUrl;
                form.submit();
            }
        }
    }

    function applyAkademikFilters() {
        const search = document.getElementById('search-akademik-input')?.value.toLowerCase() || '';
        const semester = document.getElementById('filter-akademik-semester')?.value.toLowerCase() || '';
        const status = document.getElementById('filter-akademik-status')?.value.toLowerCase() || '';

        const rows = document.querySelectorAll('#tbody-akademik tr');
        rows.forEach(row => {
            if (row.children.length < 6) return;
            const text = row.textContent.toLowerCase();
            const matchSearch = !search || text.includes(search);
            const matchSemester = !semester || text.includes(semester);
            const matchStatus = !status || text.includes(status);

            if (matchSearch && matchSemester && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    document.getElementById('search-akademik-input')?.addEventListener('input', applyAkademikFilters);
    document.getElementById('filter-akademik-semester')?.addEventListener('change', applyAkademikFilters);
    document.getElementById('filter-akademik-status')?.addEventListener('change', applyAkademikFilters);

    window.addEventListener('click', function(e) {
        if (e.target.id === 'modal-tambah-akademik') closeModal('modal-tambah-akademik');
        if (e.target.id === 'modal-edit-akademik') closeModal('modal-edit-akademik');
    });

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modal-tambah-akademik');
            closeModal('modal-edit-akademik');
        }
    });
</script>
@endsection
