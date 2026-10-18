@extends('layouts.app')

@section('content')
<div>
    <div class="flex items-center gap-4 mb-8">
        <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center">
            <x-lucide-users class="size-5" />
        </div>
        <div>
            <h1 class="text-2xl font-bold">Kelola User</h1>
            <p class="text-xs text-slate-600">Kelola data pengguna seperti mahasiswa, dan dosen.</p>
        </div>
    </div>
    <div class="flex items-center flex-wrap gap-5 mb-5">
        <div class="flex-1 flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500">Total Pengguna</h2>
                <p class="text-xl font-bold">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow bg-primary/10 text-primary flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>
        <div class="flex-1 flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500">Total Mahasiswa</h2>
                <p class="text-xl font-bold">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow bg-danger/10 text-danger flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>
        <div class="flex-1 flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500">Total Dosen</h2>
                <p class="text-xl font-bold">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow bg-orange-500/10 text-orange-500 flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>
        <div class="flex-1 flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <h2 class="text-xs text-slate-500">Total Admin</h2>
                <p class="text-xl font-bold">8</p>
            </div>
            <div class="w-11 h-11 rounded-xl shadow bg-green-500/10 text-green-500 flex items-center justify-center">
                <x-lucide-users class="size-5" />
            </div>
        </div>
    </div>
    <div class="rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 bg-surface flex items-center gap-4">
            <div class="max-w-100 min-w-32 w-96 text-slate-400 relative">
                <input type="text" name="search-user" placeholder="Cari NIP, NIM, Nama Lengkap..." class="px-3 py-2 ps-10 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full" />
                <x-lucide-search class="size-4 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" />
            </div>
            <select name="filter-role" class="px-3 py-2 max-w-40 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 w-full">
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="admin">Admin</option>
            </select>
            <button class="flex items-center ml-auto justify-center text-white gap-2 rounded-2xl bg-primary px-3.5 py-2">
                <x-lucide-user-plus class="size-4" />
                <span class="text-sm">Tambah</span>
            </button>
        </div>
        <div class="overflow-auto">
            <table class="w-full border-collapse">
                <thead class="">
                    <tr class="">
                        <th class="text-sm p-6 text-slate-800 uppercase font-semibold text-start w-62">PENGGUNA</th>
                        <th class="text-sm p-6 text-slate-800 uppercase font-semibold text-start w-62">NIP / NIM / USERNAME</th>
                        <th class="text-sm p-6 text-slate-800 uppercase font-semibold text-start">PROGRAM STUDI</th>
                        <th class="text-sm p-6 text-slate-800 uppercase font-semibold text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3 items-center gap-4 flex">
                                <img src="" alt="image" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
                                <div>
                                    <h4 class="text-sm truncate font-semibold">M. Rafly Saputra</h4>
                                    <p class="text-xs text-slate-500">966raflisaputra@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3">
                                <p class="bg-background border border-slate-200 text-xs px-2.5 py-1 rounded-2xl inline-block">2417051049</p>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <p class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">Ilmu Komputer</p>
                        </td>
                        <td class="bg-surface">
                            <div class="flex items-center justify-center gap-2">
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-500">
                                    <x-lucide-edit class="size-4" />
                                </a>
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger">
                                    <x-lucide-trash class="size-4" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3 items-center gap-4 flex">
                                <img src="" alt="image" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
                                <div>
                                    <h4 class="text-sm truncate font-semibold">M. Rafly Saputra</h4>
                                    <p class="text-xs text-slate-500">966raflisaputra@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3">
                                <p class="bg-background border border-slate-200 text-xs px-2.5 py-1 rounded-2xl inline-block">2417051049</p>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <p class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">Ilmu Komputer</p>
                        </td>
                        <td class="bg-surface">
                            <div class="flex items-center justify-center gap-2">
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-500">
                                    <x-lucide-edit class="size-4" />
                                </a>
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger">
                                    <x-lucide-trash class="size-4" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3 items-center gap-4 flex">
                                <img src="" alt="image" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
                                <div>
                                    <h4 class="text-sm truncate font-semibold">M. Rafly Saputra</h4>
                                    <p class="text-xs text-slate-500">966raflisaputra@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3">
                                <p class="bg-background border border-slate-200 text-xs px-2.5 py-1 rounded-2xl inline-block">2417051049</p>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <p class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">Ilmu Komputer</p>
                        </td>
                        <td class="bg-surface">
                            <div class="flex items-center justify-center gap-2">
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-500">
                                    <x-lucide-edit class="size-4" />
                                </a>
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger">
                                    <x-lucide-trash class="size-4" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3 items-center gap-4 flex">
                                <img src="" alt="image" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
                                <div>
                                    <h4 class="text-sm truncate font-semibold">M. Rafly Saputra</h4>
                                    <p class="text-xs text-slate-500">966raflisaputra@gmail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <div class="text-sm py-4 px-3">
                                <p class="bg-background border border-slate-200 text-xs px-2.5 py-1 rounded-2xl inline-block">2417051049</p>
                            </div>
                        </td>
                        <td class="bg-surface">
                            <p class="bg-primary/10 border border-primary/30 text-primary text-xs font-semibold px-2.5 py-1 rounded-2xl inline-block">Ilmu Komputer</p>
                        </td>
                        <td class="bg-surface">
                            <div class="flex items-center justify-center gap-2">
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-500">
                                    <x-lucide-edit class="size-4" />
                                </a>
                                <a class="w-8 h-8 flex items-center justify-center rounded-xl bg-danger/10 border border-danger/30 text-danger">
                                    <x-lucide-trash class="size-4" />
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection