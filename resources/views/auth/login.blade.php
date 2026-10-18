@extends('layouts.app')

@section('content')
<div class="relative w-full h-full min-h-dvh flex items-center justify-center bg-slate-50 p-4 sm:p-6 overflow-y-auto">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-secondary/15 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md bg-white border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/50 p-6 sm:p-8">
        <div class="flex items-center gap-3.5 mb-6">
            <div class="size-12 rounded-2xl bg-primary flex items-center justify-center text-white shadow-md shadow-primary/25 shrink-0">
                <x-lucide-graduation-cap class="size-6" />
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">
                    SIA<span class="text-primary">KRS</span>
                </h2>
                <p class="text-xs text-slate-500 font-medium">Portal Akademik Terpadu</p>
            </div>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang</h1>
            <p class="text-sm text-slate-500 mt-1">
                Silakan masuk menggunakan akun <span class="font-medium text-slate-700">NPM / NIP / Username</span> Anda.
            </p>
        </div>

        @if (session('error'))
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-3.5 text-xs text-red-700">
                <x-lucide-alert-circle class="size-4 shrink-0 text-red-600 mt-0.5" />
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.authenticate') }}" class="space-y-4">
            @csrf

            <div>
                <label for="username" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    NPM / NIP / Username
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <x-lucide-user class="size-4" />
                    </div>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan NPM, NIP, atau Username"
                        class="w-full rounded-xl border {{ $errors->has('username') ? 'border-red-300' : 'border-slate-200' }} focus:border-{{ $errors->has('username') ? 'red-500' : 'primary' }} focus:ring-{{ $errors->has('username') ? 'red-500' : 'primary' }}/10 bg-white pl-10 pr-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 transition-all"
                    >
                </div>
                @error('username')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <x-lucide-lock class="size-4" />
                    </div>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan kata sandi"
                        class="w-full rounded-xl border {{ $errors->has('password') ? 'border-red-300' : 'border-slate-200' }} focus:border-{{ $errors->has('password') ? 'red-500' : 'primary' }} focus:ring-{{ $errors->has('password') ? 'red-500' : 'primary' }}/10 bg-white pl-10 pr-10 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 transition-all"
                    >
                    <button
                        id="btnPassword"
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer"
                        title="Tampilkan / Sembunyikan Sandi"
                    >
                        <x-lucide-eye id="eyeIcon" class="size-4" />
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="size-4 rounded border-slate-300 text-primary focus:ring-primary/20 cursor-pointer"
                    >
                    <span class="text-xs text-slate-600">Ingat sesi saya</span>
                </label>
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary hover:bg-primary-hover active:scale-[0.99] px-4 py-3 text-sm font-semibold text-white shadow-md shadow-primary/20 focus:outline-none focus:ring-4 focus:ring-primary/20 transition-all cursor-pointer"
                >
                    <x-lucide-log-in class="size-4" />
                    <span>Masuk ke Sistem</span>
                </button>
            </div>
        </form>

        <div class="mt-8 pt-4 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-400">
                &copy; {{ date('Y') }} SIAKRS &bull; Portal Akademik Terpadu
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordBtn = document.getElementById('btnPassword');
        if (passwordInput.type === 'password') {
            passwordBtn.innerHTML = `<x-lucide-eye-off class="size-4" />`;
            passwordInput.type = 'text';
        } else {
            passwordBtn.innerHTML = `<x-lucide-eye class="size-4" />`;
            passwordInput.type = 'password';
        }
    }
</script>
@endsection