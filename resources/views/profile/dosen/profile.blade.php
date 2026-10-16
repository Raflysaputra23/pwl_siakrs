@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-emerald-600 via-teal-600 to-primary p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-24 h-24 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-3xl font-extrabold shadow-inner shrink-0">
                    HW
                </div>
                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            Dosen Tetap & Pembimbing Akademik
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-emerald-100">
                            Fakultas Ilmu Komputer
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Dr. Ir. Hendra Wijaya, M.T.</h1>
                    <p class="text-emerald-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NIP: 198005122005011002</span>
                        <span class="opacity-60">·</span>
                        <span>hendra.wijaya@univ.ac.id</span>
                        <span class="opacity-60">·</span>
                        <span>0812-3456-7890</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleEditProfile()" id="btn-edit-toggle" class="inline-flex items-center gap-2 rounded-xl bg-white text-emerald-800 hover:bg-emerald-50 px-4 py-2.5 text-xs font-bold shadow-sm transition cursor-pointer">
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
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-award class="size-4 text-emerald-600" />
                        Beban Kinerja Dosen
                    </h3>
                    <span class="text-[10px] text-slate-400 font-mono">BKD Aktif</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3.5 space-y-1">
                        <p class="text-[11px] font-medium text-slate-500 uppercase">Kelas Diampu</p>
                        <p class="text-2xl font-bold text-slate-900">4</p>
                        <p class="text-[10px] text-emerald-600 font-medium">12 SKS Mengajar</p>
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-3.5 space-y-1">
                        <p class="text-[11px] font-medium text-slate-500 uppercase">Bimbingan (PA)</p>
                        <p class="text-2xl font-bold text-emerald-600">32</p>
                        <p class="text-[10px] text-slate-400">Mahasiswa</p>
                    </div>
                </div>

                <div class="p-3 rounded-2xl bg-amber-50/70 border border-amber-200 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-amber-900 flex items-center gap-1.5">
                            <x-lucide-clipboard-check class="size-3.5 text-amber-700" />
                            Verifikasi KRS
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-200 text-amber-900">
                            4 Menunggu
                        </span>
                    </div>
                    <p class="text-[11px] text-amber-800 leading-relaxed">
                        Terdapat 4 pengajuan KRS mahasiswa bimbingan yang belum disetujui.
                    </p>
                </div>
            </div>

            <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-book-open class="size-4 text-emerald-600" />
                    Kelas Diampu (Semester Aktif)
                </h3>
                <div class="space-y-2 text-xs">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-0.5">
                        <p class="font-bold text-slate-900">Rekayasa Perangkat Lunak (IF-A)</p>
                        <p class="text-[11px] text-slate-500">Senin, 13:00 - 15:30 · Gedung D304</p>
                        <span class="inline-block text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Dosen Koordinator</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-0.5">
                        <p class="font-bold text-slate-900">Arsitektur Perangkat Lunak (IF-B)</p>
                        <p class="text-[11px] text-slate-500">Rabu, 08:00 - 10:30 · Lab RPL</p>
                        <span class="inline-block text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">Dosen Koordinator</span>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-lock class="size-4 text-emerald-600" />
                    Keamanan Akun
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Kelola kata sandi akun dosen Anda secara berkala untuk menjaga otentikasi approval KRS mahasiswa.
                </p>
                <button type="button" onclick="alert('Form ganti password akun dosen dapat dibuka di sini.')" class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2 text-xs font-semibold shadow-xs transition cursor-pointer">
                    <x-lucide-key-round class="size-3.5" />
                    Ganti Kata Sandi Akun
                </button>
            </div>
        </div>

        <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 p-6 sm:p-7 shadow-sm space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-200">
                        <x-lucide-contact class="size-5" />
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Data Induk Dosen</h2>
                        <p class="text-xs text-slate-500">Informasi profil lengkap dosen</span></p>
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
                            NIP (Nomor Induk Pegawai)
                        </label>
                        <div class="relative">
                            <x-lucide-id-card class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="dsn-nip" value="198005122005011002" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Username Akun Login
                        </label>
                        <div class="relative">
                            <x-lucide-at-sign class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="dsn-username" value="198005122005011002" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap (Tanpa Gelar) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-user class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="dsn-nama" value="Hendra Wijaya" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Gelar Depan
                        </label>
                        <div class="relative">
                            <x-lucide-award class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="dsn-gelar-depan" value="Dr. Ir." readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Gelar Belakang
                        </label>
                        <div class="relative">
                            <x-lucide-award class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="dsn-gelar-belakang" value="M.T." readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Email Resmi <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-mail class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="email" id="dsn-email" value="hendra.wijaya@univ.ac.id" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor Telepon / WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <x-lucide-phone class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="tel" id="dsn-telp" value="0812-3456-7890" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4 font-mono" />
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Domisili Tinggal
                        </label>
                        <div class="relative">
                            <x-lucide-home class="size-4 text-slate-400 absolute left-3.5 top-3" />
                            <textarea id="dsn-alamat" rows="2" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 transition focus:outline-primary/10 focus:border-primary outline-transparent focus:outline-4">Jl. Prof. Dr. Sumantri Brojonegoro No. 1, Gedong Meneng, Rajabasa, Bandar Lampung</textarea>
                        </div>
                    </div>
                </div>

                <div id="edit-buttons-bar" class="hidden pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="cancelEditProfile()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-sm transition flex items-center gap-2 cursor-pointer">
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
    const editableFields = ['dsn-nama', 'dsn-gelar-depan', 'dsn-gelar-belakang', 'dsn-email', 'dsn-telp', 'dsn-alamat'];
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
            document.getElementById('dsn-nama').focus();
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
        alert('Data profil dosen berhasil diperbarui!');
        toggleEditProfile();
    }
</script>
@endsection