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
                    <x-lucide-school class="size-5" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Kelola Program Studi & Fakultas</h1>
                    <p class="text-xs text-slate-600">Manajemen struktur fakultas naungan dan program studi.</p>
                </div>
            </div>

            <div class="inline-flex rounded-2xl bg-surface p-1.5 border border-slate-200 shadow-sm self-start sm:self-auto">
                <button type="button" id="btn-tab-prodi" onclick="switchTab('prodi')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer">
                    <x-lucide-graduation-cap class="size-4" />
                    Program Studi
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white">{{ count($prodi) }}</span>
                </button>
                <button type="button" id="btn-tab-fakultas" onclick="switchTab('fakultas')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer">
                    <x-lucide-building-2 class="size-4" />
                    Fakultas
                    <span
                        class="px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700">{{ count($fakultas) }}</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Program Studi</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ count($prodi) }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-graduation-cap class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Fakultas</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ count($fakultas) }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                    <x-lucide-building-2 class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Mahasiswa Terdaftar</h2>
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-[11px] text-slate-400">Di seluruh prodi</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-lucide-users class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Kurikulum</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalMataKuliah ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center">
                    <x-lucide-book-open class="size-5" />
                </div>
            </div>
        </div>

        <div id="section-prodi" class="space-y-4">
            <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
                <div
                    class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3 flex-1">
                        <div class="relative min-w-65 max-w-sm flex-1">
                            <input type="text" id="search-prodi-input"
                                placeholder="Cari Kode Prodi, Nama Prodi, atau Fakultas..."
                                class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                            <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                        </div>

                        <select id="filter-prodi-fakultas"
                            class="px-3 py-2 max-w-50 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ strtolower($f->nama_fakultas) }}">{{ $f->nama_fakultas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" onclick="openModal('modal-tambah-prodi')"
                        class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2 font-semibold text-xs shadow-sm transition shrink-0 cursor-pointer">
                        <x-lucide-plus-circle class="size-4" />
                        Tambah Program Studi
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="px-6 py-4">Kode Prodi</th>
                                <th class="px-6 py-4">Nama Program Studi</th>
                                <th class="px-6 py-4">Singkatan</th>
                                <th class="px-6 py-4">Fakultas Naungan</th>
                                <th class="px-6 py-4 text-center">Jumlah Mahasiswa</th>
                                <th class="px-6 py-4 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($prodi as $p)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="px-6 py-4">
                                        <span
                                            class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-slate-100 text-slate-800 border border-slate-200">
                                            {{ $p->kode_prodi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-bold text-slate-900">{{ $p->nama_prodi }}</p>
                                            <p class="text-xs text-slate-400">Jenjang Sarjana / Diploma</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-xs text-slate-700">{{ $p->singkatan ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                            <span
                                                class="font-medium text-xs text-slate-800">{{ $p->fakultas->nama_fakultas ?? 'Fakultas Belum Terdaftar' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-800">
                                            <x-lucide-users class="size-3.5 text-slate-500" />
                                            {{ $p->mahasiswa_count ?? 0 }} Mahasiswa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-end">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <button type="button"
                                                onclick="openEditProdi('{{ $p->id }}', '{{ addslashes($p->kode_prodi) }}', '{{ addslashes($p->nama_prodi) }}', '{{ addslashes($p->singkatan ?? '') }}', '{{ $p->id_fakultas }}')"
                                                title="Edit Program Studi"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                                <x-lucide-edit class="size-4" />
                                            </button>
                                            <button type="button"
                                                onclick="confirmDeleteProdi('{{ addslashes($p->nama_prodi) }}', '{{ route('kelola.prodi.destroy', $p->id) }}')"
                                                title="Hapus Program Studi"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                                <x-lucide-trash-2 class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <x-lucide-school class="size-10 mb-2 text-slate-300" />
                                            <p class="text-sm font-semibold text-slate-600">Belum ada Program Studi</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data program studi baru
                                                melalui tombol di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                    <span>Menampilkan {{ count($prodi) }} program studi</span>
                    <div class="flex items-center gap-1.5">
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Sebelumnya</button>
                        <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold shadow-xs">1</button>
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="section-fakultas" class="space-y-4 hidden">
            <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
                <div
                    class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="relative min-w-65 max-w-sm flex-1">
                        <input type="text" id="search-fakultas-input" placeholder="Cari Kode Fakultas atau Nama Fakultas..."
                            class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                        <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    </div>

                    <button type="button" onclick="openModal('modal-tambah-fakultas')"
                        class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2 font-semibold text-xs shadow-sm transition shrink-0 cursor-pointer">
                        <x-lucide-plus-circle class="size-4" />
                        Tambah Fakultas Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="px-6 py-4">Kode Fakultas</th>
                                <th class="px-6 py-4">Nama Lengkap Fakultas</th>
                                <th class="px-6 py-4">Singkatan</th>
                                <th class="px-6 py-4 text-center">Jumlah Prodi Dinaungi</th>
                                <th class="px-6 py-4">Terdaftar Sejak</th>
                                <th class="px-6 py-4 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($fakultas as $f)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="px-6 py-4">
                                        <span
                                            class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $f->kode_fakultas }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                                                <x-lucide-building-2 class="size-4" />
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-900">{{ $f->nama_fakultas }}</h4>
                                                <p class="text-xs text-slate-500">Menaungi disiplin akademik & program studi</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-xs text-slate-700">{{ $f->singkatan }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20">
                                            <x-lucide-graduation-cap class="size-3.5" />
                                            {{ $f->program_studi_count ?? 0 }} Program Studi
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono text-slate-500">
                                        {{ $f->created_at ? $f->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-end">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <button type="button"
                                                onclick="openEditFakultas('{{ $f->id }}', '{{ addslashes($f->kode_fakultas) }}', '{{ addslashes($f->nama_fakultas) }}', '{{ addslashes($f->singkatan) }}')"
                                                title="Edit Fakultas"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-600 transition cursor-pointer">
                                                <x-lucide-edit class="size-4" />
                                            </button>
                                            <button type="button"
                                                onclick="confirmDeleteFakultas('{{ addslashes($f->nama_fakultas) }}', '{{ route('kelola.prodi.destroy', $f->id) }}')"
                                                title="Hapus Fakultas"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                                <x-lucide-trash-2 class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <x-lucide-building-2 class="size-10 mb-2 text-slate-300" />
                                            <p class="text-sm font-semibold text-slate-600">Belum ada Fakultas</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data fakultas baru
                                                melalui tombol di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                    <span>Menampilkan {{ count($fakultas) }} fakultas</span>
                    <div class="flex items-center gap-1.5">
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Sebelumnya</button>
                        <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold shadow-xs">1</button>
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-600 transition cursor-pointer">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Prodi -->
    <div id="modal-tambah-prodi"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
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
                <button type="button" onclick="closeModal('modal-tambah-prodi')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form action="{{ route('kelola.prodi.store') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="tab" value="prodi">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Fakultas Naungan <span class="text-rose-500">*</span>
                    </label>
                    <select required name="id_fakultas"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="">-- Pilih Fakultas Naungan --</option>
                        @foreach ($fakultas as $f)
                            <option value="{{ $f->id }}">{{ $f->nama_fakultas }} ({{ $f->singkatan }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kode Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="kode_prodi" id="kode_prodi" required placeholder="9284PILKOM" maxlength="10"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_prodi" required placeholder="Ilmu Komputer" maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Singkatan Program Studi
                    </label>
                    <input type="text" name="singkatan" id="singkatan_prodi" placeholder="ILKOM" maxlength="50"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-tambah-prodi')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Simpan Program Studi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Prodi -->
    <div id="modal-edit-prodi"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <x-lucide-edit class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Edit Program Studi</h3>
                        <p class="text-xs text-slate-500">Perbarui informasi program studi</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modal-edit-prodi')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form id="form-edit-prodi" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" name="tab" value="prodi">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Fakultas Naungan <span class="text-rose-500">*</span>
                    </label>
                    <select required name="id_fakultas" id="edit-prodi-fakultas"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="">-- Pilih Fakultas Naungan --</option>
                        @foreach ($fakultas as $f)
                            <option value="{{ $f->id }}">{{ $f->nama_fakultas }} ({{ $f->singkatan }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kode Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="kode_prodi" id="edit-prodi-kode" required maxlength="10"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_prodi" id="edit-prodi-nama" required maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Singkatan Program Studi
                    </label>
                    <input type="text" name="singkatan" id="edit-prodi-singkatan" maxlength="50"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-edit-prodi')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Perbarui Program Studi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Fakultas -->
    <div id="modal-tambah-fakultas"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
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
                <button type="button" onclick="closeModal('modal-tambah-fakultas')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form action="{{ route('kelola.prodi.store') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="tab" value="fakultas">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kode Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="kode_fakultas" readonly id="kode_fakultas" required placeholder="FMIPA2305"
                        maxlength="10"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_fakultas" required placeholder="Fakultas MIPA" maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Singkatan Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="singkatan" id="singkatan_fakultas" placeholder="MIPA" required maxlength="50"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-tambah-fakultas')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Simpan Fakultas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Fakultas -->
    <div id="modal-edit-fakultas"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <x-lucide-edit class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Edit Fakultas</h3>
                        <p class="text-xs text-slate-500">Perbarui data fakultas</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modal-edit-fakultas')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form id="form-edit-fakultas" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <input type="hidden" name="tab" value="fakultas">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kode Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="kode_fakultas" id="edit-fakultas-kode" required maxlength="10"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono uppercase" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nama_fakultas" id="edit-fakultas-nama" required maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Singkatan Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="singkatan" id="edit-fakultas-singkatan" required maxlength="50"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition uppercase" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-edit-fakultas')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Perbarui Fakultas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-prodi-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
        <input type="hidden" name="tab" id="delete-prodi-tab" value="prodi">
    </form>

    <script>
        function switchTab(tab) {
            const btnProdi = document.getElementById('btn-tab-prodi');
            const btnFakultas = document.getElementById('btn-tab-fakultas');
            const sectionProdi = document.getElementById('section-prodi');
            const sectionFakultas = document.getElementById('section-fakultas');

            if (tab === 'prodi') {
                const kode_prodi = document.getElementById('kode_prodi');
                const singkatan = document.getElementById('singkatan_prodi');
                const randomNum = Math.floor(1000 + Math.random() * 9000);
                if (kode_prodi && !kode_prodi.dataset.init) {
                    kode_prodi.value = randomNum + 'P';
                    kode_prodi.dataset.init = 'true';
                    singkatan?.addEventListener('keyup', function () {
                        kode_prodi.value = randomNum + 'P' + singkatan.value.toUpperCase();
                    });
                }

                btnProdi.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer";
                btnProdi.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white";

                btnFakultas.className = "px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer";
                btnFakultas.querySelector('span').className = "px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700";

                sectionProdi.classList.remove('hidden');
                sectionFakultas.classList.add('hidden');
            } else {
                const kode_fakultas = document.getElementById('kode_fakultas');
                const singkatan = document.getElementById('singkatan_fakultas');
                const randomNum = Math.floor(1000 + Math.random() * 9000);
                if (kode_fakultas && !kode_fakultas.dataset.init) {
                    kode_fakultas.value = randomNum;
                    kode_fakultas.dataset.init = 'true';
                    singkatan?.addEventListener('keyup', function () {
                        kode_fakultas.value = randomNum + singkatan.value.toUpperCase();
                    });
                }

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

        function openEditProdi(id, kode, nama, singkatan, idFakultas) {
            const form = document.getElementById('form-edit-prodi');
            if (form) {
                form.action = "{{ url('/kelola/prodi/update') }}/" + id;
            }
            document.getElementById('edit-prodi-kode').value = kode;
            document.getElementById('edit-prodi-nama').value = nama;
            document.getElementById('edit-prodi-singkatan').value = singkatan;
            document.getElementById('edit-prodi-fakultas').value = idFakultas;

            openModal('modal-edit-prodi');
        }

        function openEditFakultas(id, kode, nama, singkatan) {
            const form = document.getElementById('form-edit-fakultas');
            if (form) {
                form.action = "{{ url('/kelola/prodi/update') }}/" + id;
            }
            document.getElementById('edit-fakultas-kode').value = kode;
            document.getElementById('edit-fakultas-nama').value = nama;
            document.getElementById('edit-fakultas-singkatan').value = singkatan;

            openModal('modal-edit-fakultas');
        }

        function confirmDeleteProdi(nama, deleteUrl) {
            if (confirm(`Apakah Anda yakin ingin menghapus Program Studi ${nama}?\n\nTindakan ini dapat memengaruhi relasi data terkait di sistem.`)) {
                const form = document.getElementById('delete-prodi-form');
                const tabInput = document.getElementById('delete-prodi-tab');
                if (form && deleteUrl) {
                    form.action = deleteUrl;
                    tabInput.value = 'prodi';
                    form.submit();
                }
            }
        }

        function confirmDeleteFakultas(nama, deleteUrl) {
            if (confirm(`Apakah Anda yakin ingin menghapus Fakultas ${nama}?\n\nTindakan ini dapat memengaruhi relasi data terkait di sistem.`)) {
                const form = document.getElementById('delete-prodi-form');
                const tabInput = document.getElementById('delete-prodi-tab');
                if (form && deleteUrl) {
                    form.action = deleteUrl;
                    tabInput.value = 'fakultas';
                    form.submit();
                }
            }
        }

        document.getElementById('search-prodi-input')?.addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#section-prodi tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        document.getElementById('search-fakultas-input')?.addEventListener('input', function (e) {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#section-fakultas tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        document.getElementById('filter-prodi-fakultas')?.addEventListener('change', function (e) {
            const val = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#section-prodi tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!val || text.includes(val)) ? '' : 'none';
            });
        });

        window.addEventListener('click', function (e) {
            if (e.target.id === 'modal-tambah-prodi') closeModal('modal-tambah-prodi');
            if (e.target.id === 'modal-edit-prodi') closeModal('modal-edit-prodi');
            if (e.target.id === 'modal-tambah-fakultas') closeModal('modal-tambah-fakultas');
            if (e.target.id === 'modal-edit-fakultas') closeModal('modal-edit-fakultas');
        });

        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal('modal-tambah-prodi');
                closeModal('modal-edit-prodi');
                closeModal('modal-tambah-fakultas');
                closeModal('modal-edit-fakultas');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('tab') === 'fakultas') {
                switchTab('fakultas');
            } else {
                switchTab('prodi');
            }
        });
    </script>
@endsection