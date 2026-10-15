<nav class="hidden lg:flex flex-col bg-surface border border-slate-200 space-y-3">
    <div class="flex items-center gap-3 border-b border-slate-200 h-24 max-h-24 px-4">
        <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center">
            <x-lucide-graduation-cap class="size-5" />
        </div>
        <div>
            <h1 class="text-lg font-bold">SISTEM <span class="text-primary">KRS</span></h1>
            <p class="text-xs text-slate-600">Sistem Akademik KRS</p>
        </div>
    </div>
    <div class="h-full py-3 px-4 space-y-4">
        <div class="bg-primary/10 rounded-2xl p-3 border border-primary/30 relative">
            <h4 class="text-primary text-xs mb-2 uppercase font-semibold">Semester Aktif</h4>
            <p class="text-black font-semibold text-xs">Ganjil 2026/2027</p>
            <p class="text-slate-600 text-xs">Semester aktif saat ini</p>
            <div class="absolute right-3 top-3 animate-pulse bg-primary w-2 h-2 rounded-full"></div>
        </div>
        <div class="space-y-2 overflow-y-auto">
            <h2 class="font-semibold text-xs text-slate-600">MENU UTAMA</h2>
            <a href="{{ route('dashboard') }}" class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-slate-600 {{ request()->is('dashboard') || request()->is('/') ? 'bg-primary text-white' : '' }}">
                <x-lucide-layout-grid-circles class="size-5" />
                <p class="flex-1 {{ request()->is('dashboard') || request()->is('/') ? 'font-semibold' : 'font-regular' }}">
                    Dashboard
                </p>
                @if (request()->is('dashboard') || request()->is('/'))
                    <x-lucide-arrow-right class="size-5" />
                @endif
            </a>
            <a href="{{ route('kelola.user') }}" class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-slate-600 {{ request()->is('kelola/user') ? 'bg-primary text-white' : '' }}">
                <x-lucide-users class="size-5" />
                <p class="flex-1 {{ request()->is('kelola/user') ? 'font-semibold' : 'font-regular' }}">
                    Kelola User
                </p>
                @if (request()->is('kelola/user'))
                    <x-lucide-arrow-right class="size-5" />
                @endif
            </a>
            <a href="{{ route('kelola.matakuliah') }}" class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-slate-600 {{ request()->is('kelola/matakuliah') ? 'bg-primary text-white' : '' }}">
                <x-lucide-library-big class="size-5" />
                <p class="flex-1 {{ request()->is('kelola.matakuliah') ? 'font-semibold' : 'font-regular' }}">
                    Kelola Matakuliah
                </p>
                @if (request()->is('profile'))
                    <x-lucide-arrow-right class="size-5" />
                @endif
            </a>
        </div>
    </div>
    <div class="flex justify-center mt-auto border-t border-slate-200 py-3 px-4">
         <a href="{{ route('logout') }}" class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-danger bg-danger/15 border border-danger/30">
            <x-lucide-log-out class="size-5" />
            <p class="flex-1 font-semibold">
                Logout
            </p>
        </a>
    </div>
</nav>
