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
                    <x-lucide-users class="size-5" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Kelola Pengguna</h1>
                    <p class="text-xs text-slate-600">Manajemen akun pengguna sistem, data induk mahasiswa, dan data dosen
                        pengajar sesuai skema database.</p>
                </div>
            </div>

            <button type="button" onclick="openModal('modal-tambah-user')"
                class="inline-flex items-center justify-center text-white gap-2 rounded-xl bg-primary hover:bg-primary-hover px-4 py-2.5 font-semibold text-sm shadow-sm transition shrink-0 cursor-pointer self-start sm:self-auto">
                <x-lucide-user-plus class="size-4" />
                Tambah Pengguna Baru
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Akun Pengguna</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalUser ?? count($users), 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center">
                    <x-lucide-users class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Mahasiswa</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($totalMahasiswa ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center">
                    <x-lucide-graduation-cap class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Total Dosen Pengajar</h2>
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($totalDosen ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-lucide-briefcase class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">Mahasiswa Aktif</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format($totalMahasiswaAktif ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <x-lucide-badge-check class="size-5" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
            <div
                class="p-5 bg-surface border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    <div class="relative min-w-65 max-w-sm flex-1">
                        <input type="text" id="search-user-input" placeholder="Cari NIP, NIM, Nama Lengkap..."
                            class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                        <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    </div>

                    <select id="filter-user-role"
                        class="px-3 py-2 max-w-44 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                        <option value="">Semua Role Pengguna</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>

                    <select id="filter-user-status"
                        class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-white">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="cuti">Cuti</option>
                        <option value="lulus">Lulus</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>

                <div class="text-xs text-slate-500 font-medium">
                    Total: <span class="font-bold text-slate-800">{{ count($users) }} Pengguna</span> ditampilkan
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Role & Identitas (NIM/NIP)</th>
                            <th class="px-6 py-4">Program Studi / Gelar</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                            @php
                                $role = $user->role;
                                $namaLengkap = $user->username;
                                $email = '-';
                                $identitasLabel = 'ID';
                                $identitasNomor = $user->username;
                                $badgeRoleClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                $prodiGelarTitle = '-';
                                $prodiGelarSubtitle = '-';
                                $statusBadge = 'Aktif';
                                $statusBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                $avatarColorClass = 'bg-primary/10 text-primary border-primary/20';
                                $jk = '-';
                                $telp = '-';
                                $alamat = '-';
                                $angkatan = '-';
                                $pa = '-';

                                if ($role === 'mahasiswa' && $user->mahasiswa) {
                                    $mhs = $user->mahasiswa;
                                    $namaLengkap = $mhs->nama_lengkap ?? $user->username;
                                    $email = $mhs->email ?? '-';
                                    $identitasLabel = 'NIM';
                                    $identitasNomor = $mhs->nim ?? $user->username;
                                    $badgeRoleClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                    $avatarColorClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                    $prodiGelarTitle = $mhs->programStudi->nama_prodi ?? 'Program Studi';
                                    $paName = $mhs->dosenPa ? (($mhs->dosenPa->gelar_depan ? $mhs->dosenPa->gelar_depan . ' ' : '') . $mhs->dosenPa->nama_lengkap . ($mhs->dosenPa->gelar_belakang ? ', ' . $mhs->dosenPa->gelar_belakang : '')) : '-';
                                    $prodiGelarSubtitle = 'Angkatan ' . ($mhs->angkatan ?? '-') . ' · PA: ' . $paName;
                                    $statusBadge = ucfirst($mhs->status ?? 'aktif');
                                    if ($mhs->status === 'cuti') {
                                        $statusBadgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                    } elseif ($mhs->status === 'lulus') {
                                        $statusBadgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                                    } elseif ($mhs->status === 'keluar') {
                                        $statusBadgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                    }
                                    $jk = ucfirst($mhs->jenis_kelamin ?? '-');
                                    $telp = $mhs->no_telp ?? '-';
                                    $alamat = $mhs->alamat ?? '-';
                                    $angkatan = $mhs->angkatan ?? '-';
                                    $pa = $paName;
                                } elseif ($role === 'dosen' && $user->dosen) {
                                    $dsn = $user->dosen;
                                    $gelarDepan = $dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '';
                                    $gelarBelakang = $dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '';
                                    $namaLengkap = $gelarDepan . $dsn->nama_lengkap . $gelarBelakang;
                                    $email = $dsn->email ?? '-';
                                    $identitasLabel = 'NIP';
                                    $identitasNomor = $dsn->nip ?? $user->username;
                                    $badgeRoleClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                    $avatarColorClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                    $prodiGelarTitle = 'Dosen Pengajar';
                                    $prodiGelarSubtitle = 'Gelar: ' . ($dsn->gelar_depan ?: '-') . ' ... ' . ($dsn->gelar_belakang ?: '-');
                                    $statusBadge = 'Aktif Mengajar';
                                    $statusBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                    $jk = '-';
                                    $telp = $dsn->no_telp ?? '-';
                                    $alamat = $dsn->alamat ?? '-';
                                    $pa = 'Dosen Pembimbing Akademik';
                                } else {
                                    $namaLengkap = $user->username;
                                    $identitasLabel = 'Username';
                                    $identitasNomor = $user->username;
                                    $badgeRoleClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                    $avatarColorClass = 'bg-purple-50 text-purple-700 border-purple-200';
                                    $prodiGelarTitle = 'Administrator Sistem';
                                    $prodiGelarSubtitle = 'Hak Akses Penuh Sistem';
                                    $statusBadge = 'Aktif Sistem';
                                    $statusBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                }

                                $parts = preg_split('/\s+/', trim($namaLengkap));
                                $initials = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : (strlen($parts[0] ?? '') > 1 ? substr($parts[0], 1, 1) : 'S')));
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition" data-role="{{ strtolower($role) }}" data-status="{{ strtolower($statusBadge) }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3.5">
                                        <div
                                            class="w-10 h-10 rounded-2xl {{ $avatarColorClass }} flex items-center justify-center font-bold text-xs shrink-0 border">
                                            {{ $initials }}
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-bold text-slate-900 truncate">{{ $namaLengkap }}</h4>
                                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                                <x-lucide-mail class="size-3 text-slate-400" />
                                                {{ $email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $badgeRoleClass }}">
                                            @if ($role === 'mahasiswa')
                                                <x-lucide-graduation-cap class="size-3" />
                                            @elseif ($role === 'dosen')
                                                <x-lucide-briefcase class="size-3" />
                                            @else
                                                <x-lucide-shield-check class="size-3" />
                                            @endif
                                            {{ ucfirst($role) }}
                                        </span>
                                        <div
                                            class="font-mono text-xs font-semibold text-slate-800 flex items-center gap-1 mt-0.5">
                                            <span class="text-slate-400 font-normal">{{ $identitasLabel }}:</span> {{ $identitasNomor }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-slate-800 text-xs">{{ $prodiGelarTitle }}</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $prodiGelarSubtitle }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusBadgeClass }}">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        {{ $statusBadge }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-end">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button"
                                            onclick="openDetailUser('{{ addslashes($namaLengkap) }}', '{{ ucfirst($role) }}', '{{ $identitasNomor }}', '{{ $email }}', '{{ addslashes($prodiGelarTitle) }}', '{{ $angkatan }}', '{{ addslashes($pa) }}', '{{ $jk }}', '{{ $telp }}', '{{ $statusBadge }}', '{{ addslashes($alamat) }}')"
                                            title="Lihat Detail Profil"
                                            class="w-8 h-8 flex items-center justify-center rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 transition cursor-pointer">
                                            <x-lucide-eye class="size-4" />
                                        </button>
                                        @if ($role !== 'admin')
                                            <button type="button"
                                                onclick="confirmDeleteUser('{{ addslashes($namaLengkap) }}', '{{ $identitasNomor }}', '{{ route('kelola.user.destroy', $user->id) }}')"
                                                title="Hapus Pengguna"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 transition cursor-pointer">
                                                <x-lucide-trash-2 class="size-4" />
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-lucide-users class="size-10 mb-2 text-slate-300" />
                                        <p class="text-sm font-semibold text-slate-600">Belum ada Pengguna</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data pengguna baru melalui tombol di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div
                class="p-4 bg-surface border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
                <span>Menampilkan {{ count($users) }} pengguna</span>
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

    <!-- Modal Tambah User -->
    <div id="modal-tambah-user"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-2xl w-full max-h-[92vh] overflow-y-auto p-6 sm:p-7 space-y-6 relative">
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
                <button type="button" onclick="closeModal('modal-tambah-user')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <form action="{{ route('kelola.user.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Pilih Peran Pengguna <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" id="role-btn-mahasiswa" onclick="setUserRole('mahasiswa')"
                            class="p-3.5 rounded-2xl border-2 border-primary bg-primary/5 text-primary flex items-center gap-3 transition text-left cursor-pointer">
                            <div
                                class="w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm">
                                <x-lucide-graduation-cap class="size-5" />
                            </div>
                            <div>
                                <p class="font-bold text-sm text-slate-900">Mahasiswa</p>
                            </div>
                        </button>

                        <button type="button" id="role-btn-dosen" onclick="setUserRole('dosen')"
                            class="p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white text-slate-600 flex items-center gap-3 transition text-left cursor-pointer">
                            <div
                                class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
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
                                Username Akun <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="account-username" name="username" required
                                placeholder="Masukkan Username" maxlength="100"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white" />
                            <p id="username-note" class="text-[10px] text-slate-400 mt-1">Masukkan NPM</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Password Akun <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="password" required placeholder="Minimal 6 karakter"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white" />
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
                                NPM <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="mhs-nim" name="npm" maxlength="10" placeholder="2417051049"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="mhs-nama" name="nama_lengkap" maxlength="200"
                                placeholder="M. Rafly Saputra"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Program Studi<span class="text-rose-500">*</span>
                            </label>
                            <select name="id_program_studi"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach ($programStudiList as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }} ({{ $prodi->singkatan }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Dosen Pembimbing Akademik
                            </label>
                            <select name="dosen_pa_nip"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                                <option value="">-- Pilih Dosen PA (Opsional) --</option>
                                @foreach ($dosenList as $dsn)
                                    <option value="{{ $dsn->nip }}">
                                        {{ $dsn->gelar_depan ? $dsn->gelar_depan . ' ' : '' }}{{ $dsn->nama_lengkap }}{{ $dsn->gelar_belakang ? ', ' . $dsn->gelar_belakang : '' }} ({{ $dsn->nip }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Angkatan <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" name="angkatan" min="1990" max="2030" placeholder="2024"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition font-mono" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Jenis Kelamin <span class="text-rose-500">*</span>
                            </label>
                            <select name="jenis_kelamin"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
                                <option value="laki-laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Email Mahasiswa
                            </label>
                            <input type="email" name="email_mhs" maxlength="200" placeholder="966raflisaputra@gmail.com"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                No. Telepon / WhatsApp
                            </label>
                            <input type="tel" name="no_telp_mhs" maxlength="20" placeholder="08542141412"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Status Mahasiswa <span class="text-rose-500">*</span>
                            </label>
                            <select name="status_mhs"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white">
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
                            <input type="text" name="tempat_lahir" placeholder="Kota Kelahiran"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tgl_lahir"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition bg-white" />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Alamat Domisili
                            </label>
                            <textarea name="alamat_mhs" rows="2" placeholder="Sukarame, Bandar Lampung"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition"></textarea>
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
                                NIP <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="dsn-nip" name="nip" maxlength="20" placeholder="198005122005011002"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Nama Lengkap (Tanpa Gelar) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="dsn-nama" name="nama_dosen" maxlength="200"
                                placeholder="Contoh: Hendra Wijaya"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Gelar Depan
                            </label>
                            <input type="text" name="gelar_depan" maxlength="100" placeholder="Prof., Dr."
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Gelar Belakang
                            </label>
                            <input type="text" name="gelar_belakang" maxlength="100" placeholder="S.Kom., M.Kom."
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Email Dosen
                            </label>
                            <input type="email" name="email_dosen" maxlength="200"
                                placeholder="sandiatimbandiwibowo@students.unila.ac.id"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                No. Telepon / WhatsApp
                            </label>
                            <input type="tel" name="no_telp_dosen" maxlength="20" placeholder="087641242142"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition" />
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">
                                Alamat Domisili
                            </label>
                            <textarea name="alamat_dosen" rows="2" placeholder="Alamat domisili saat ini..."
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 transition"></textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModal('modal-tambah-user')"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Simpan Data Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail User -->
    <div id="modal-detail-user"
        class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
        <div
            class="bg-surface rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full max-h-[92vh] overflow-y-auto p-6 space-y-5 relative">
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
                <button type="button" onclick="closeModal('modal-detail-user')"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition cursor-pointer">
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
                        <span id="detail-role"
                            class="font-semibold text-primary px-2 py-0.5 rounded-full bg-primary/10">-</span>
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
                <button type="button" onclick="closeModal('modal-detail-user')"
                    class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition cursor-pointer">
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
            const usnNote = document.getElementById('username-note');

            inputRole.value = role;

            if (role === 'mahasiswa') {
                btnMhs.className = "p-3.5 rounded-2xl border-2 border-primary bg-primary/5 text-primary flex items-center gap-3 transition text-left cursor-pointer";
                btnMhs.querySelector('div').className = "w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm";

                btnDsn.className = "p-3.5 rounded-2xl border-2 border-slate-200 hover:border-slate-300 bg-white text-slate-600 flex items-center gap-3 transition text-left cursor-pointer";
                btnDsn.querySelector('div').className = "w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0";

                formMhs.classList.remove('hidden');
                formDsn.classList.add('hidden');
                usnNote.textContent = 'Masukkan NPM';

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
                usnNote.textContent = 'Masukkan NIP';

                if (mhsNim) mhsNim.required = false;
                if (mhsNama) mhsNama.required = false;
                if (dsnNip) dsnNip.required = true;
                if (dsnNama) dsnNama.required = true;
            }
        }

        document.getElementById('mhs-nim')?.addEventListener('input', function (e) {
            const username = document.getElementById('account-username');
            if (username && (username.dataset.manual !== 'true')) {
                username.value = e.target.value;
            }
        });

        document.getElementById('dsn-nip')?.addEventListener('input', function (e) {
            const username = document.getElementById('account-username');
            if (username && (username.dataset.manual !== 'true')) {
                username.value = e.target.value;
            }
        });

        document.getElementById('account-username')?.addEventListener('input', function () {
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

        function confirmDeleteUser(nama, nomor, deleteUrl) {
            if (confirm(`Apakah Anda yakin ingin menghapus data pengguna:\n\nNama: ${nama}\nIdentitas: ${nomor}?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                const form = document.getElementById('delete-user-form');
                if (form && deleteUrl) {
                    form.action = deleteUrl;
                    form.submit();
                }
            }
        }

        function applyTableFilters() {
            const roleVal = document.getElementById('filter-user-role')?.value.toLowerCase() || '';
            const statusVal = document.getElementById('filter-user-status')?.value.toLowerCase() || '';
            const searchVal = document.getElementById('search-user-input')?.value.toLowerCase() || '';
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const matchRole = !roleVal || text.includes(roleVal);
                const matchStatus = !statusVal || text.includes(statusVal);
                const matchSearch = !searchVal || text.includes(searchVal);

                if (matchRole && matchStatus && matchSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('filter-user-role')?.addEventListener('change', applyTableFilters);
        document.getElementById('filter-user-status')?.addEventListener('change', applyTableFilters);
        document.getElementById('search-user-input')?.addEventListener('input', applyTableFilters);

        window.addEventListener('click', function (e) {
            if (e.target.id === 'modal-tambah-user') closeModal('modal-tambah-user');
            if (e.target.id === 'modal-detail-user') closeModal('modal-detail-user');
        });

        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal('modal-tambah-user');
                closeModal('modal-detail-user');
            }
        });
    </script>

    <form id="delete-user-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection