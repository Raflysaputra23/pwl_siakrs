@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-24 h-24 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-3xl font-extrabold shadow-inner shrink-0">
                    {{ strtoupper(substr($user->username ?? 'AD', 0, 2)) }}
                </div>
                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Administrator Sistem
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                            Biro Administrasi Akademik (BAAK)
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Administrator SIAKRS</h1>
                    <p class="text-blue-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>Username: {{ $user->username ?? 'admin' }}</span>
                        <span class="opacity-60">·</span>
                        <span>admin@univ.ac.id</span>
                        <span class="opacity-60">·</span>
                        <span>Hak Akses Penuh (Super Admin)</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute -right-16 -top-16 w-60 h-60 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="space-y-6">
            <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-shield-check class="size-4 text-primary" />
                        Otoritas & Hak Akses
                    </h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Aktif
                    </span>
                </div>

                <div class="space-y-2.5 text-xs text-slate-600">
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <x-lucide-check-circle-2 class="size-4 text-emerald-600 shrink-0" />
                        <span>Kelola Pengguna (Dosen & Mahasiswa)</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <x-lucide-check-circle-2 class="size-4 text-emerald-600 shrink-0" />
                        <span>Kelola Mata Kuliah & Pembukaan Kelas</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <x-lucide-check-circle-2 class="size-4 text-emerald-600 shrink-0" />
                        <span>Kelola Periode & Status Tahun Akademik</span>
                    </div>
                    <div class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <x-lucide-check-circle-2 class="size-4 text-emerald-600 shrink-0" />
                        <span>Monitoring Transaksi KRS Mahasiswa</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 p-6 sm:p-7 shadow-sm space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <x-lucide-user-cog class="size-5" />
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Informasi Akun Administrator</h2>
                        <p class="text-xs text-slate-500">Detail identitas dan kredensial pengelola sistem</p>
                    </div>
                </div>
                <span id="badge-edit-mode" class="hidden px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    Mode Pengeditan
                </span>
            </div>

            <form class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Username Sistem
                        </label>
                        <div class="relative">
                            <x-lucide-at-sign class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" id="admin-username" value="{{ $user->username ?? 'admin' }}" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-mono text-slate-700 focus:outline-none cursor-not-allowed" />
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">Username akun default administrator tidak dapat diubah</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Peran Pengguna (Role)
                        </label>
                        <div class="relative">
                            <x-lucide-shield class="size-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
                            <input type="text" value="Super Administrator" readonly class="w-full px-3.5 py-2.5 ps-10 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-primary focus:outline-none cursor-not-allowed" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection