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
                <span>Profile gagal disimpan, Silahkan cek kembali isian form anda</span>
            </div>
        @endif
        
        <div
            class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                    <div
                        class="w-24 h-24 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-3xl font-extrabold shadow-inner shrink-0">
                        {{ strtoupper(substr($mahasiswa->nama_lengkap ?? ($user->username ?? 'M'), 0, 2)) }}
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Mahasiswa {{ ucfirst($mahasiswa->status ?? 'Aktif') }}
                            </span>
                            <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                                Angkatan {{ $mahasiswa->angkatan ?? '-' }}
                            </span>
                            <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                                Semester {{ $dataMahasiswa->semester ?? 1 }}
                                ({{ $tahunAktif ? $tahunAktif->tahun . ' ' . ucfirst($tahunAktif->semester) : 'Aktif' }})
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            {{ $mahasiswa->nama_lengkap ?? $user->username }}
                        </h1>
                        <p class="text-blue-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                            <span>NPM: {{ $mahasiswa->nim ?? '-' }}</span>
                            <span class="opacity-60">·</span>
                            <span>{{ $mahasiswa->programStudi->nama_prodi ?? 'Program Studi' }}</span>
                            <span class="opacity-60">·</span>
                            <span>{{ $mahasiswa->programStudi->fakultas->nama_fakultas ?? 'Fakultas' }}</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleEditProfile()" id="btn-edit-toggle"
                        class="inline-flex items-center gap-2 rounded-xl bg-white text-primary hover:bg-blue-50 px-4 py-2.5 text-xs font-bold shadow-sm transition cursor-pointer">
                        <x-lucide-pencil class="size-4" />
                        <span>Edit Profil</span>
                    </button>
                </div>
            </div>
            <div class="absolute -right-16 -top-16 w-60 h-60 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="space-y-6">
                <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-4">
                    <div class="flex items-center justify-start">
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <x-lucide-award class="size-4 text-primary" />
                            Ringkasan Akademik
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3.5 space-y-1">
                            <p class="text-[11px] font-medium text-slate-500 uppercase">IPK Kumulatif</p>
                            <p class="text-2xl font-bold text-emerald-600">
                                {{ number_format((float) ($dataMahasiswa->ipk ?? 0), 2) }}
                            </p>
                        </div>

                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3.5 space-y-1">
                            <p class="text-[11px] font-medium text-slate-500 uppercase">Total SKS Lulus</p>
                            <p class="text-2xl font-bold text-primary">{{ $dataMahasiswa->total_sks ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-4">
                    <div class="flex items-center justify-start">
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <x-lucide-user-check class="size-4 text-primary" />
                            Dosen Pembimbing (PA)
                        </h3>
                    </div>

                    <div class="flex items-start gap-3.5 p-3 rounded-2xl bg-slate-50 border border-slate-100">
                        <div
                            class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-200">
                            {{ strtoupper(substr($mahasiswa->dosenPa ? $mahasiswa->dosenPa->nama_lengkap : 'PA', 0, 2)) }}
                        </div>
                        <div class="min-w-0 space-y-0.5">
                            <h4 class="text-xs font-bold text-slate-900 truncate">
                                {{ $mahasiswa->dosenPa ? $mahasiswa->dosenPa->nama : 'Belum Ditentukan' }}
                            </h4>
                            <p class="text-[11px] text-slate-500 font-mono">NIP:
                                {{ $mahasiswa->dosenPa ? $mahasiswa->dosenPa->nip : '-' }}
                            </p>
                            <p class="text-[11px] text-slate-500 truncate">
                                {{ $mahasiswa->dosenPa ? $mahasiswa->dosenPa->email : '-' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ $mahasiswa->dosenPa && $mahasiswa->dosenPa->email ? 'mailto:' . $mahasiswa->dosenPa->email : '#' }}"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary hover:bg-primary-hover text-white px-4 py-2 text-xs font-semibold shadow-xs transition">
                        <x-lucide-mail class="size-3.5" />
                        Hubungi Pembimbing Akademik
                    </a>
                </div>

                <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-3">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-shield-check class="size-4 text-emerald-600" />
                        Status Akun Pengguna
                    </h3>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-500">Role Sistem</span>
                            <span class="font-semibold text-slate-800">{{ $user->role ?? 'mahasiswa' }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-500">Status Mahasiswa</span>
                            <span class="font-bold text-emerald-600 capitalize">{{ $mahasiswa->status ?? 'Aktif' }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-slate-500">Status KRS Semester</span>
                            <span
                                class="font-semibold text-emerald-600 capitalize">{{ $statusKrs ?? 'Belum Diajukan' }}</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-3">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-lock class="size-4 text-primary" />
                        Keamanan Akun
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Perbarui kata sandi akun portal akademik Anda secara berkala untuk menjaga keamanan data
                        perkuliahan.
                    </p>
                    <button type="button" onclick="openPasswordModal()"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2 text-xs font-semibold shadow-xs transition cursor-pointer">
                        <x-lucide-key-round class="size-3.5" />
                        Ganti Kata Sandi Akun
                    </button>
                </div>
            </div>

            <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 p-6 sm:p-7 shadow-sm space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <x-lucide-contact class="size-5" />
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Data Induk Mahasiswa</h2>
                            <p class="text-xs text-slate-500">Informasi profil lengkap mahasiswa</span></p>
                        </div>
                    </div>
                    <span id="badge-edit-mode"
                        class="hidden px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        Mode Pengeditan
                    </span>
                </div>

                <form onsubmit="event.preventDefault(); saveProfile();" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                NPM
                            </label>
                            <div class="relative">
                                <x-lucide-id-card
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-nim" value="{{ $mahasiswa->nim ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Username Akun Login
                            </label>
                            <div class="relative">
                                <x-lucide-at-sign
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-username" value="{{ $user->username ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <x-lucide-user class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-nama" value="{{ $mahasiswa->nama_lengkap ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Program Studi
                            </label>
                            <div class="relative">
                                <x-lucide-graduation-cap
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-prodi" value="{{ $mahasiswa->programStudi->nama_prodi ?? '-' }}"
                                    readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none cursor-not-allowed" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Tahun Angkatan
                            </label>
                            <div class="relative">
                                <x-lucide-calendar
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-angkatan" value="{{ $mahasiswa->angkatan ?? '-' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <x-lucide-users class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-jk" value="{{ $mahasiswa->jenis_kelamin ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Status Mahasiswa
                            </label>
                            <div class="relative">
                                <x-lucide-badge-check
                                    class="size-4 text-emerald-600 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-status" value="{{ ucfirst($mahasiswa->status ?? 'Aktif') }}"
                                    readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-bold text-emerald-600 focus:outline-none cursor-not-allowed capitalize" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <x-lucide-mail class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="email" id="mhs-email" value="{{ $mahasiswa->email ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nomor Telepon / WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <x-lucide-phone class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="tel" id="mhs-telp" value="{{ $mahasiswa->no_telp ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 font-mono" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Tempat Lahir
                            </label>
                            <div class="relative">
                                <x-lucide-map-pin
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="text" id="mhs-tempat-lahir" value="{{ $mahasiswa->tempat_lahir ?? '' }}"
                                    readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Tanggal Lahir
                            </label>
                            <div class="relative">
                                <x-lucide-calendar-days
                                    class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                                <input type="date" id="mhs-tgl-lahir" value="{{ $mahasiswa->tgl_lahir ?? '' }}" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Alamat Domisili
                            </label>
                            <div class="relative">
                                <x-lucide-home class="size-4 text-slate-400 absolute left-3.5 top-3" />
                                <textarea id="mhs-alamat" rows="2" readonly
                                    class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4">{{ $mahasiswa->alamat ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div id="edit-buttons-bar"
                        class="hidden pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="cancelEditProfile()"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                            <x-lucide-check-circle-2 class="size-4" />
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Ganti Password --}}
        <div id="modal-password"
            class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-200 hidden">
            <div
                class="bg-white rounded-3xl border border-slate-200 shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <x-lucide-key-round class="size-5" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Ganti Kata Sandi</h3>
                            <p class="text-xs text-slate-500">Perbarui kata sandi akun mahasiswa Anda</p>
                        </div>
                    </div>
                    <button type="button" onclick="closePasswordModal()"
                        class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center transition cursor-pointer">
                        <x-lucide-x class="size-4" />
                    </button>
                </div>

                <form id="form-change-password" onsubmit="event.preventDefault(); submitChangePassword();"
                    class="p-6 space-y-4">
                    <div id="password-alert" class="hidden p-3 rounded-xl text-xs font-medium"></div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Kata Sandi Saat Ini <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-lock class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="password" id="current_password" required placeholder="Masukkan kata sandi lama"
                                class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Kata Sandi Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-key class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="password" id="new_password" required placeholder="Minimal 6 karakter"
                                class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Konfirmasi Kata Sandi Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-check-check
                                class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="password" id="confirm_password" required placeholder="Ulangi kata sandi baru"
                                class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="closePasswordModal()"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" id="btn-submit-password"
                            class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                            <x-lucide-check class="size-4" />
                            <span>Simpan Kata Sandi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let isEditing = false;
        const editableFields = ['mhs-nama', 'mhs-email', 'mhs-telp', 'mhs-jk', 'mhs-tempat-lahir', 'mhs-tgl-lahir', 'mhs-alamat'];
        const originalValues = {};

        function toggleEditProfile() {
            isEditing = !isEditing;
            const btnToggle = document.getElementById('btn-edit-toggle');
            const badgeEdit = document.getElementById('badge-edit-mode');
            const buttonsBar = document.getElementById('edit-buttons-bar');

            editableFields.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (isEditing) {
                        originalValues[id] = el.value;
                        el.readOnly = false;
                        el.classList.remove('bg-slate-50');
                        el.classList.add('bg-white');
                    } else {
                        el.readOnly = true;
                        el.classList.remove('bg-white');
                        el.classList.add('bg-slate-50');
                    }
                }
            });

            if (isEditing) {
                btnToggle.classList.add('hidden');
                badgeEdit.classList.remove('hidden');
                buttonsBar.classList.remove('hidden');
                document.getElementById('mhs-nama').focus();
            } else {
                btnToggle.classList.remove('hidden');
                badgeEdit.classList.add('hidden');
                buttonsBar.classList.add('hidden');
            }
        }

        function cancelEditProfile() {
            editableFields.forEach(id => {
                const el = document.getElementById(id);
                if (el && originalValues[id] !== undefined) {
                    el.value = originalValues[id];
                }
            });
            toggleEditProfile();
        }

        function saveProfile() {
            const payload = {
                nama_lengkap: document.getElementById('mhs-nama')?.value,
                email: document.getElementById('mhs-email')?.value,
                no_telp: document.getElementById('mhs-telp')?.value,
                jenis_kelamin: document.getElementById('mhs-jk')?.value?.toLowerCase(),
                tempat_lahir: document.getElementById('mhs-tempat-lahir')?.value,
                tgl_lahir: document.getElementById('mhs-tgl-lahir')?.value,
                alamat: document.getElementById('mhs-alamat')?.value,
            };

            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message || 'Data profil mahasiswa berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal memperbarui profil mahasiswa');
                    }
                })
                .catch(err => {
                    alert('Terjadi kesalahan saat menyimpan profil mahasiswa');
                });
        }

        function openPasswordModal() {
            const modal = document.getElementById('modal-password');
            const alertBox = document.getElementById('password-alert');
            if (alertBox) alertBox.classList.add('hidden');
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('confirm_password').value = '';
            if (modal) modal.classList.remove('hidden');
        }

        function closePasswordModal() {
            const modal = document.getElementById('modal-password');
            if (modal) modal.classList.add('hidden');
        }

        function submitChangePassword() {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const btnSubmit = document.getElementById('btn-submit-password');

            if (!currentPassword) {
                showPasswordAlert('Kata sandi saat ini wajib diisi', 'error');
                return;
            }

            if (newPassword.length < 6) {
                showPasswordAlert('Kata sandi baru minimal 6 karakter', 'error');
                return;
            }

            if (newPassword !== confirmPassword) {
                showPasswordAlert('Konfirmasi kata sandi baru tidak cocok', 'error');
                return;
            }

            btnSubmit.disabled = true;
            const originalText = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<span>Menyimpan...</span>';

            fetch('{{ route("profile.update-password") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    current_password: currentPassword,
                    new_password: newPassword,
                    confirm_password: confirmPassword
                })
            })
                .then(res => res.json())
                .then(data => {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = originalText;
                    if (data.success) {
                        showPasswordAlert(data.message, 'success');
                        setTimeout(() => {
                            closePasswordModal();
                        }, 1300);
                    } else {
                        showPasswordAlert(data.message || 'Gagal mengubah kata sandi', 'error');
                    }
                })
                .catch(err => {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = originalText;
                    showPasswordAlert('Terjadi kesalahan koneksi atau server', 'error');
                });
        }

        function showPasswordAlert(message, type) {
            const alertBox = document.getElementById('password-alert');
            if (!alertBox) return;
            alertBox.className = 'p-3 rounded-xl text-xs font-medium';
            if (type === 'success') {
                alertBox.classList.add('bg-emerald-50', 'text-emerald-700', 'border', 'border-emerald-200');
            } else {
                alertBox.classList.add('bg-rose-50', 'text-rose-700', 'border', 'border-rose-200');
            }
            alertBox.textContent = message;
            alertBox.classList.remove('hidden');
        }
    </script>
@endsection