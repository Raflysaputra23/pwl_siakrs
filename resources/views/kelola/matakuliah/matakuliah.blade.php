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
                    <x-lucide-library-big class="size-5" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Kelola Mata Kuliah & Kelas</h1>
                    <p class="text-xs text-slate-600">Manajemen kurikulum program studi, bobot SKS, alokasi kelas, dan
                        jadwal perkuliahan.</p>
                </div>
            </div>

            <div class="inline-flex rounded-2xl bg-surface p-1.5 border border-slate-200 shadow-sm self-start sm:self-auto">
                <button type="button" id="btn-tab-matakuliah" onclick="switchTab('matakuliah')"
                    class="tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer">
                    <x-lucide-book-open class="size-4" />
                    Mata Kuliah
                    <span
                        class="px-1.5 py-0.5 rounded-full text-[10px] bg-white/20 text-white">{{ count($matakuliah) }}</span>
                </button>
                <button type="button" id="btn-tab-kelas" onclick="switchTab('kelas')"
                    class="tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer">
                    <x-lucide-calendar class="size-4" />
                    Kelas Perkuliahan
                    <span
                        class="px-1.5 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700">{{ count($kelas) }}</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Mata Kuliah</h2>
                    <p class="text-2xl font-bold text-slate-900">
                        {{ number_format($totalMatakuliah ?? count($matakuliah), 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-book-open class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Wajib</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalWajib ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                    <x-lucide-bookmark class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Mata Kuliah Peminatan</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalPeminatan ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center">
                    <x-lucide-sparkles class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Kelas Aktif</h2>
                    <p class="text-2xl font-bold text-slate-900">
                        {{ number_format($totalKelas ?? count($kelas), 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-lucide-door-open class="size-5" />
                </div>
            </div>
        </div>

        {{-- SECTION MATA KULIAH --}}
        <div id="section-matakuliah" class="space-y-4">
            <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
                <div
                    class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3 flex-1">
                        <div class="relative min-w-65 max-w-sm flex-1">
                            <input type="text" id="search-mk-input" placeholder="Cari Kode MK atau Nama Mata Kuliah..."
                                class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                            <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                        </div>

                        <select id="filter-mk-prodi"
                            class="px-3 py-2 max-w-50 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Program Studi</option>
                            @foreach ($programStudiList as $prodi)
                                <option value="{{ strtolower($prodi->nama_prodi) }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>

                        <select id="filter-mk-jenis"
                            class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Jenis</option>
                            <option value="wajib">Wajib</option>
                            <option value="peminatan">Peminatan</option>
                        </select>

                        <select id="filter-mk-semester"
                            class="px-3 py-2 max-w-35 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Semester</option>
                            @for ($s = 1; $s <= 8; $s++)
                                <option value="smt {{ $s }}">Semester {{ $s }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="button" onclick="openModal('modal-tambah-matakuliah')"
                        class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer">
                        <x-lucide-plus-circle class="size-4" />
                        Tambah Mata Kuliah
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
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
                        <tbody id="tbody-matakuliah" class="divide-y divide-slate-100">
                            @forelse ($matakuliah as $mk)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4">
                                        <span
                                            class="font-mono text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg">
                                            {{ $mk->kode_mk }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-900">{{ $mk->nama_mk }}</p>
                                        <p class="text-xs text-slate-500">{{ $mk->programStudi->nama_prodi ?? 'Program Studi' }}
                                            · Smt {{ $mk->semester }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">
                                            {{ $mk->programStudi->nama_prodi ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $mk->jenis === 'wajib' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200' }} inline-block capitalize">
                                            {{ ucfirst($mk->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-slate-700">
                                        Smt {{ $mk->semester }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-slate-900 bg-slate-100 rounded-lg px-2.5 py-1 text-xs">
                                            {{ $mk->sks }} SKS
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                            <x-lucide-door-open class="size-3.5" />
                                            {{ $mk->kelas_count ?? count($mk->kelas) }} Kelas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button"
                                                onclick="openEditMatakuliah('{{ $mk->id }}', '{{ addslashes($mk->kode_mk) }}', '{{ addslashes($mk->nama_mk) }}', '{{ $mk->id_program_studi }}', '{{ $mk->jenis }}', '{{ $mk->semester }}', '{{ $mk->sks }}')"
                                                title="Edit Mata Kuliah"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                                <x-lucide-edit class="size-4" />
                                            </button>
                                            <button type="button"
                                                onclick="confirmDeleteMatakuliah('{{ addslashes($mk->nama_mk) }}', '{{ $mk->kode_mk }}', '{{ route('kelola.matakuliah.destroy', $mk->id) }}')"
                                                title="Hapus Mata Kuliah"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                                <x-lucide-trash class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <x-lucide-book-open class="size-10 mb-2 text-slate-300" />
                                            <p class="text-sm font-semibold text-slate-600">Belum ada Mata Kuliah</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data mata kuliah baru
                                                melalui tombol di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
                    <span>Menampilkan {{ count($matakuliah) }} mata kuliah</span>
                    <div class="flex items-center gap-1">
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Sebelumnya</button>
                        <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION KELAS PERKULIAHAN --}}
        <div id="section-kelas" class="space-y-4 hidden">
            <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
                <div
                    class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3 flex-1">
                        <div class="relative min-w-65 max-w-sm flex-1">
                            <input type="text" id="search-kelas-input" placeholder="Cari Nama Kelas, Ruangan, Dosen..."
                                class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                            <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                        </div>

                        <select id="filter-kelas-hari"
                            class="px-3 py-2 max-w-37.5 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                        </select>

                        <select id="filter-kelas-mk"
                            class="px-3 py-2 max-w-55 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                            <option value="">Semua Mata Kuliah</option>
                            @foreach ($matakuliah as $mk)
                                <option value="{{ strtolower($mk->nama_mk) }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" onclick="openModal('modal-tambah-kelas')"
                        class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer">
                        <x-lucide-plus-circle class="size-4" />
                        Buka Kelas Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="px-6 py-4">KELAS</th>
                                <th class="px-6 py-4">MATA KULIAH</th>
                                <th class="px-6 py-4">DOSEN PENGAMPU</th>
                                <th class="px-6 py-4">JADWAL KULIAH</th>
                                <th class="px-6 py-4">RUANGAN</th>
                                <th class="px-6 py-4 text-center">KAPASITAS / KUOTA</th>
                                <th class="px-6 py-4 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-kelas" class="divide-y divide-slate-100">
                            @forelse ($kelas as $kls)
                                @php
                                    $mkKls = $kls->mataKuliah;
                                    $dsnKoor = $kls->dosenKoor;
                                    $dsnPendamping = $kls->dosenPendamping;
                                    $namaKoor = $dsnKoor ? (($dsnKoor->gelar_depan ? $dsnKoor->gelar_depan . ' ' : '') . $dsnKoor->nama_lengkap . ($dsnKoor->gelar_belakang ? ', ' . $dsnKoor->gelar_belakang : '')) : '-';
                                    $namaPendamping = $dsnPendamping ? (($dsnPendamping->gelar_depan ? $dsnPendamping->gelar_depan . ' ' : '') . $dsnPendamping->nama_lengkap . ($dsnPendamping->gelar_belakang ? ', ' . $dsnPendamping->gelar_belakang : '')) : null;

                                    $durasiMenit = 0;
                                    if ($kls->jam_mulai && $kls->jam_selesai) {
                                        $start = \Carbon\Carbon::parse($kls->jam_mulai);
                                        $end = \Carbon\Carbon::parse($kls->jam_selesai);
                                        $durasiMenit = $start->diffInMinutes($end);
                                    }
                                @endphp
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4">
                                        <span
                                            class="font-bold text-slate-900 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-xs inline-block">
                                            {{ $kls->nama_kelas }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-900">{{ $mkKls->nama_mk ?? '-' }}</p>
                                        <span class="font-mono text-xs text-slate-500">Kode: {{ $mkKls->kode_mk ?? '-' }} ·
                                            {{ $mkKls->sks ?? 0 }} SKS</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-semibold text-slate-800 text-xs">{{ $namaKoor }}</p>
                                            <p class="text-[11px] text-primary font-medium">Koordinator · NIP
                                                {{ $dsnKoor->nip ?? '-' }}</p>
                                        </div>
                                        @if ($namaPendamping)
                                            <div class="mt-1">
                                                <p class="text-xs text-slate-600">{{ $namaPendamping }}</p>
                                                <p class="text-[11px] text-slate-400">Pendamping · NIP
                                                    {{ $dsnPendamping->nip ?? '-' }}</p>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-slate-800 text-xs flex items-center gap-1.5">
                                            <x-lucide-clock class="size-3.5 text-primary" />
                                            {{ ucfirst($kls->hari) }}, {{ substr($kls->jam_mulai, 0, 5) }} -
                                            {{ substr($kls->jam_selesai, 0, 5) }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-0.5">Durasi {{ $durasiMenit }} Menit</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1.5 text-xs font-medium text-slate-700">
                                            <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                            {{ $kls->ruangan }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="space-y-1">
                                            <span class="font-bold text-slate-800 text-xs">{{ $kls->kapasitas }} Kursi</span>
                                            <div class="w-28 mx-auto bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                                            </div>
                                            <span class="text-[10px] font-semibold text-emerald-600">Kapasitas Penuh</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button"
                                                onclick="openEditKelas('{{ $kls->id }}', '{{ $kls->id_mata_kuliah }}', '{{ addslashes($kls->nama_kelas) }}', '{{ $kls->kapasitas }}', '{{ $kls->dosen_koor }}', '{{ $kls->dosen_pendamping }}', '{{ $kls->hari }}', '{{ substr($kls->jam_mulai, 0, 5) }}', '{{ substr($kls->jam_selesai, 0, 5) }}', '{{ addslashes($kls->ruangan) }}')"
                                                title="Edit Kelas"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-600 hover:bg-yellow-500/20 transition cursor-pointer">
                                                <x-lucide-edit class="size-4" />
                                            </button>
                                            <button type="button"
                                                onclick="confirmDeleteKelas('{{ addslashes($kls->nama_kelas) }}', '{{ addslashes($mkKls->nama_mk ?? '') }}', '{{ route('kelola.matakuliah.destroy', $kls->id) }}')"
                                                title="Hapus Kelas"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger hover:bg-danger/20 transition cursor-pointer">
                                                <x-lucide-trash class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <x-lucide-door-open class="size-10 mb-2 text-slate-300" />
                                            <p class="text-sm font-semibold text-slate-600">Belum ada Kelas Perkuliahan</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Silakan buka kelas baru melalui tombol di
                                                atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
                    <span>Menampilkan {{ count($kelas) }} kelas perkuliahan aktif</span>
                    <div class="flex items-center gap-1">
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Sebelumnya</button>
                        <button class="px-3 py-1.5 rounded-lg bg-primary text-white font-semibold transition">1</button>
                        <button
                            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 font-semibold text-slate-700 transition cursor-pointer">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH MATA KULIAH --}}
    <div id="modal-tambah-matakuliah"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
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
                <button type="button" onclick="closeModal('modal-tambah-matakuliah')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form action="{{ route('kelola.matakuliah.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="tab" value="matakuliah">

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <select name="id_program_studi" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled selected>Pilih Program Studi</option>
                        @foreach ($programStudiList as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }} ({{ $prodi->singkatan }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kode MK <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="kode_mk" required placeholder="IF5101" maxlength="10"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono uppercase focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        <p class="text-[10px] text-slate-400 mt-1">Maks 10 karakter unik</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Mata Kuliah <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nama_mk" required placeholder="Contoh: Pemrograman Web Lanjut"
                            maxlength="100"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jenis MK <span class="text-rose-500">*</span>
                        </label>
                        <select name="jenis" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="wajib" selected>Wajib</option>
                            <option value="peminatan">Peminatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Semester <span class="text-rose-500">*</span>
                        </label>
                        <select name="semester" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Bobot SKS <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" name="sks" required min="1" max="6" value="3"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-tambah-matakuliah')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Simpan Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT MATA KULIAH --}}
    <div id="modal-edit-matakuliah"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 text-yellow-600 flex items-center justify-center">
                        <x-lucide-edit class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Edit Mata Kuliah</h3>
                        <p class="text-xs text-slate-500">Perbarui informasi kurikulum mata kuliah</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modal-edit-matakuliah')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form id="form-edit-matakuliah" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="tab" value="matakuliah">

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <select id="edit-mk-prodi" name="id_program_studi" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled>Pilih Program Studi</option>
                        @foreach ($programStudiList as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }} ({{ $prodi->singkatan }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kode MK <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="edit-mk-kode" name="kode_mk" required maxlength="10"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-mono uppercase focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Mata Kuliah <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="edit-mk-nama" name="nama_mk" required maxlength="100"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jenis MK <span class="text-rose-500">*</span>
                        </label>
                        <select id="edit-mk-jenis" name="jenis" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="wajib">Wajib</option>
                            <option value="peminatan">Peminatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Semester <span class="text-rose-500">*</span>
                        </label>
                        <select id="edit-mk-semester" name="semester" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Bobot SKS <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="edit-mk-sks" name="sks" required min="1" max="6"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-edit-matakuliah')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Perbarui Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TAMBAH KELAS --}}
    <div id="modal-tambah-kelas"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-xl w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
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
                <button type="button" onclick="closeModal('modal-tambah-kelas')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form action="{{ route('kelola.matakuliah.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="tab" value="kelas">

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Mata Kuliah <span class="text-rose-500">*</span>
                    </label>
                    <select name="id_mata_kuliah" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled selected>Pilih Mata Kuliah yang Dibuka</option>
                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Kelas <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nama_kelas" required placeholder="Contoh: IF-5A atau Kelas A"
                            maxlength="50"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        <p class="text-[10px] text-slate-400 mt-1">Format: Nama/Kode Paralel Kelas</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kapasitas / Kuota Mahasiswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="kapasitas" required min="5" max="150" value="40"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-medium">Kursi</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Dosen Koordinator (Utama) <span class="text-rose-500">*</span>
                    </label>
                    <select name="dosen_koor" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled selected>Pilih Dosen Koordinator</option>
                        @foreach ($dosenList as $dsn)
                            @php
                                $namaGelar = ($dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '') . $dsn->nama_lengkap . ($dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '');
                            @endphp
                            <option value="{{ $dsn->nip }}">{{ $namaGelar }} (NIP: {{ $dsn->nip }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Dosen Pendamping / Team Teaching <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <select name="dosen_pendamping"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="">Tidak Ada (Dosen Tunggal)</option>
                        @foreach ($dosenList as $dsn)
                            @php
                                $namaGelar = ($dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '') . $dsn->nama_lengkap . ($dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '');
                            @endphp
                            <option value="{{ $dsn->nip }}">{{ $namaGelar }} (NIP: {{ $dsn->nip }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Hari <span class="text-rose-500">*</span>
                        </label>
                        <select name="hari" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
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
                        <input type="time" name="jam_mulai" required value="08:00"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jam Selesai <span class="text-rose-500">*</span>
                        </label>
                        <input type="time" name="jam_selesai" required value="10:30"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Ruangan Perkuliahan <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="ruangan" required
                        placeholder="Contoh: Lab Rekayasa Komputer (LRK-02) / Gedung D Ruang D304" maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-tambah-kelas')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Buka Kelas Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT KELAS --}}
    <div id="modal-edit-kelas"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-xl w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-5 relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 text-yellow-600 flex items-center justify-center">
                        <x-lucide-edit class="size-5" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Edit Kelas Perkuliahan</h3>
                        <p class="text-xs text-slate-500">Perbarui data alokasi kelas, jadwal, ruangan dan dosen</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modal-edit-kelas')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form id="form-edit-kelas" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="tab" value="kelas">

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Mata Kuliah <span class="text-rose-500">*</span>
                    </label>
                    <select id="edit-kelas-mk" name="id_mata_kuliah" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled>Pilih Mata Kuliah yang Dibuka</option>
                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Kelas <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="edit-kelas-nama" name="nama_kelas" required maxlength="50"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kapasitas / Kuota Mahasiswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="edit-kelas-kapasitas" name="kapasitas" required min="5" max="150"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-medium">Kursi</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Dosen Koordinator (Utama) <span class="text-rose-500">*</span>
                    </label>
                    <select id="edit-kelas-dosen-koor" name="dosen_koor" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="" disabled>Pilih Dosen Koordinator</option>
                        @foreach ($dosenList as $dsn)
                            @php
                                $namaGelar = ($dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '') . $dsn->nama_lengkap . ($dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '');
                            @endphp
                            <option value="{{ $dsn->nip }}">{{ $namaGelar }} (NIP: {{ $dsn->nip }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Dosen Pendamping / Team Teaching <span class="text-slate-400 font-normal">(Opsional)</span>
                    </label>
                    <select id="edit-kelas-dosen-pendamping" name="dosen_pendamping"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                        <option value="">Tidak Ada (Dosen Tunggal)</option>
                        @foreach ($dosenList as $dsn)
                            @php
                                $namaGelar = ($dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '') . $dsn->nama_lengkap . ($dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '');
                            @endphp
                            <option value="{{ $dsn->nip }}">{{ $namaGelar }} (NIP: {{ $dsn->nip }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Hari <span class="text-rose-500">*</span>
                        </label>
                        <select id="edit-kelas-hari" name="hari" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                            <option value="senin">Senin</option>
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
                        <input type="time" id="edit-kelas-jam-mulai" name="jam_mulai" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jam Selesai <span class="text-rose-500">*</span>
                        </label>
                        <input type="time" id="edit-kelas-jam-selesai" name="jam_selesai" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Ruangan Perkuliahan <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="edit-kelas-ruangan" name="ruangan" required maxlength="100"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-edit-kelas')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Perbarui Kelas Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-action-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
        <input type="hidden" name="type" id="delete-action-type" value="matakuliah">
    </form>

    <script>
        function switchTab(tab) {
            const btnMk = document.getElementById('btn-tab-matakuliah');
            const btnKelas = document.getElementById('btn-tab-kelas');
            const secMk = document.getElementById('section-matakuliah');
            const secKelas = document.getElementById('section-kelas');

            if (tab === 'matakuliah') {
                btnMk.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer';
                btnKelas.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer';
                secMk.classList.remove('hidden');
                secKelas.classList.add('hidden');
            } else {
                btnKelas.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-primary text-white shadow-sm cursor-pointer';
                btnMk.className = 'tab-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 text-slate-600 hover:text-slate-900 cursor-pointer';
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

        function openEditMatakuliah(id, kode, nama, prodiId, jenis, semester, sks) {
            const form = document.getElementById('form-edit-matakuliah');
            if (form) {
                form.action = "{{ url('/kelola/matakuliah/update') }}/" + id;
            }
            document.getElementById('edit-mk-kode').value = kode;
            document.getElementById('edit-mk-nama').value = nama;
            document.getElementById('edit-mk-prodi').value = prodiId;
            document.getElementById('edit-mk-jenis').value = jenis;
            document.getElementById('edit-mk-semester').value = semester;
            document.getElementById('edit-mk-sks').value = sks;

            openModal('modal-edit-matakuliah');
        }

        function openEditKelas(id, mkId, namaKelas, kapasitas, dosenKoor, dosenPendamping, hari, jamMulai, jamSelesai, ruangan) {
            const form = document.getElementById('form-edit-kelas');
            if (form) {
                form.action = "{{ url('/kelola/matakuliah/update') }}/" + id;
            }
            document.getElementById('edit-kelas-mk').value = mkId;
            document.getElementById('edit-kelas-nama').value = namaKelas;
            document.getElementById('edit-kelas-kapasitas').value = kapasitas;
            document.getElementById('edit-kelas-dosen-koor').value = dosenKoor;
            document.getElementById('edit-kelas-dosen-pendamping').value = dosenPendamping || '';
            document.getElementById('edit-kelas-hari').value = hari;
            document.getElementById('edit-kelas-jam-mulai').value = jamMulai;
            document.getElementById('edit-kelas-jam-selesai').value = jamSelesai;
            document.getElementById('edit-kelas-ruangan').value = ruangan;

            openModal('modal-edit-kelas');
        }

        function confirmDeleteMatakuliah(nama, kode, deleteUrl) {
            if (confirm(`Apakah Anda yakin ingin menghapus mata kuliah:\n\n${kode} - ${nama}?\n\nSemua kelas yang terhubung dengan mata kuliah ini juga akan ikut terhapus.`)) {
                const form = document.getElementById('delete-action-form');
                const typeInput = document.getElementById('delete-action-type');
                if (form && deleteUrl) {
                    form.action = deleteUrl;
                    typeInput.value = 'matakuliah';
                    form.submit();
                }
            }
        }

        function confirmDeleteKelas(namaKelas, namaMk, deleteUrl) {
            if (confirm(`Apakah Anda yakin ingin menghapus kelas perkuliahan:\n\n${namaKelas} (${namaMk})?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                const form = document.getElementById('delete-action-form');
                const typeInput = document.getElementById('delete-action-type');
                if (form && deleteUrl) {
                    form.action = deleteUrl;
                    typeInput.value = 'kelas';
                    form.submit();
                }
            }
        }

        function applyMatakuliahFilters() {
            const search = document.getElementById('search-mk-input')?.value.toLowerCase() || '';
            const prodi = document.getElementById('filter-mk-prodi')?.value.toLowerCase() || '';
            const jenis = document.getElementById('filter-mk-jenis')?.value.toLowerCase() || '';
            const semester = document.getElementById('filter-mk-semester')?.value.toLowerCase() || '';

            const rows = document.querySelectorAll('#tbody-matakuliah tr');
            rows.forEach(row => {
                if (row.children.length < 8) return;
                const text = row.textContent.toLowerCase();
                const matchSearch = !search || text.includes(search);
                const matchProdi = !prodi || text.includes(prodi);
                const matchJenis = !jenis || text.includes(jenis);
                const matchSemester = !semester || text.includes(semester);

                if (matchSearch && matchProdi && matchJenis && matchSemester) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('search-mk-input')?.addEventListener('input', applyMatakuliahFilters);
        document.getElementById('filter-mk-prodi')?.addEventListener('change', applyMatakuliahFilters);
        document.getElementById('filter-mk-jenis')?.addEventListener('change', applyMatakuliahFilters);
        document.getElementById('filter-mk-semester')?.addEventListener('change', applyMatakuliahFilters);

        function applyKelasFilters() {
            const search = document.getElementById('search-kelas-input')?.value.toLowerCase() || '';
            const hari = document.getElementById('filter-kelas-hari')?.value.toLowerCase() || '';
            const mk = document.getElementById('filter-kelas-mk')?.value.toLowerCase() || '';

            const rows = document.querySelectorAll('#tbody-kelas tr');
            rows.forEach(row => {
                if (row.children.length < 7) return;
                const text = row.textContent.toLowerCase();
                const matchSearch = !search || text.includes(search);
                const matchHari = !hari || text.includes(hari);
                const matchMk = !mk || text.includes(mk);

                if (matchSearch && matchHari && matchMk) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('search-kelas-input')?.addEventListener('input', applyKelasFilters);
        document.getElementById('filter-kelas-hari')?.addEventListener('change', applyKelasFilters);
        document.getElementById('filter-kelas-mk')?.addEventListener('change', applyKelasFilters);

        window.addEventListener('click', function (e) {
            if (e.target.id === 'modal-tambah-matakuliah') closeModal('modal-tambah-matakuliah');
            if (e.target.id === 'modal-edit-matakuliah') closeModal('modal-edit-matakuliah');
            if (e.target.id === 'modal-tambah-kelas') closeModal('modal-tambah-kelas');
            if (e.target.id === 'modal-edit-kelas') closeModal('modal-edit-kelas');
        });

        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal('modal-tambah-matakuliah');
                closeModal('modal-edit-matakuliah');
                closeModal('modal-tambah-kelas');
                closeModal('modal-edit-kelas');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('tab') === 'kelas') {
                switchTab('kelas');
            }
        });
    </script>
@endsection