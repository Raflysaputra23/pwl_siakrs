@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-24 h-24 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-3xl font-extrabold shadow-inner shrink-0">
                    RS
                </div>
                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Mahasiswa Aktif
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                            Angkatan 2022
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                            Semester 5 (Ganjil 2026/2027)
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">M. Rafly Saputra</h1>
                    <p class="text-blue-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NIM: 2417051049</span>
                        <span class="opacity-60">·</span>
                        <span>S1 Ilmu Komputer</span>
                        <span class="opacity-60">·</span>
                        <span>Fakultas MIPA</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleEditProfile()" id="btn-edit-toggle" class="inline-flex items-center gap-2 rounded-xl bg-white text-primary hover:bg-blue-50 px-4 py-2.5 text-xs font-bold shadow-sm transition cursor-pointer">
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
                        <p class="text-2xl font-bold text-emerald-600">3.82</p>
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3.5 space-y-1">
                        <p class="text-[11px] font-medium text-slate-500 uppercase">Total SKS Lulus</p>
                        <p class="text-2xl font-bold text-primary">98</p>
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
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-200">
                        SAW
                    </div>
                    <div class="min-w-0 space-y-0.5">
                        <h4 class="text-xs font-bold text-slate-900 truncate">Sandi Atim Wibowo, M.Kom.</h4>
                        <p class="text-[11px] text-slate-500 font-mono">NIP: 198005122005011002</p>
                        <p class="text-[11px] text-slate-500">sandi.atim@unila.ac.id</p>
                    </div>
                </div>

                <a href="mailto:sandi.atim@unila.ac.id" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary hover:bg-primary-hover text-white px-4 py-2 text-xs font-semibold shadow-xs transition">
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
                        <span class="font-semibold text-slate-800">mahasiswa</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500">Status Mahasiswa</span>
                        <span class="font-bold text-emerald-600">aktif</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-500">Status KRS Semester</span>
                        <span class="font-semibold text-emerald-600">Disetujui Dosen PA</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 p-6 sm:p-7 shadow-sm space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <x-lucide-contact class="size-5" />
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Data Induk Mahasiswa</h2>
                        <p class="text-xs text-slate-500">Informasi profil lengkap mahasiswa</span></p>
                    </div>
                </div>
                <span id="badge-edit-mode" class="hidden px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Mode Pengeditan
                </span>
            </div>

            <form onsubmit="event.preventDefault(); saveProfile();" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            NIM (Nomor Induk Mahasiswa)
                        </label>
                        <div class="relative">
                            <x-lucide-id-card class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-nim" value="2417051049" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Username Akun Login
                        </label>
                        <div class="relative">
                            <x-lucide-at-sign class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-username" value="2417051049" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-user class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-nama" value="Rafly Saputra" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Program Studi
                        </label>
                        <div class="relative">
                            <x-lucide-graduation-cap class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-prodi" value="S1 Ilmu Komputer" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tahun Angkatan
                        </label>
                        <div class="relative">
                            <x-lucide-calendar class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-angkatan" value="2022" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jenis Kelamin
                        </label>
                        <div class="relative">
                            <x-lucide-users class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-jk" value="Laki-Laki" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Status Mahasiswa
                        </label>
                        <div class="relative">
                            <x-lucide-badge-check class="size-4 text-emerald-600 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-status" value="Aktif" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-bold text-emerald-600 focus:outline-none cursor-not-allowed capitalize" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Email <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-mail class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="email" id="mhs-email" value="966raflisaputra@gmail.com" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor Telepon / WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-phone class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="tel" id="mhs-telp" value="0812-3456-7890" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 font-mono" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tempat Lahir
                        </label>
                        <div class="relative">
                            <x-lucide-map-pin class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="mhs-tempat-lahir" value="Bandar Lampung" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tanggal Lahir
                        </label>
                        <div class="relative">
                            <x-lucide-calendar-days class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="date" id="mhs-tgl-lahir" value="2004-05-14" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Domisili
                        </label>
                        <div class="relative">
                            <x-lucide-home class="size-4 text-slate-400 absolute left-3.5 top-3" />
                            <textarea id="mhs-alamat" rows="2" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4">Sukarame, Lampung, Bandar Lampung</textarea>
                        </div>
                    </div>
                </div>

                <div id="edit-buttons-bar" class="hidden pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="cancelEditProfile()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
                        <x-lucide-check-circle-2 class="size-4" />
                        Simpan Perubahan
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
        alert('Data profil mahasiswa berhasil diperbarui!');
        toggleEditProfile();
    }
</script>
@endsection