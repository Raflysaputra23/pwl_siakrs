<div id="sidebar-backdrop" 
     onclick="window.closeAppSidebar && window.closeAppSidebar()"
     class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden"
     aria-hidden="true">
</div>

<nav id="app-sidebar" 
     class="fixed inset-y-0 left-0 z-50 w-72 sm:w-80 bg-surface border-r border-slate-200 flex flex-col justify-between -translate-x-full lg:translate-x-0 lg:static lg:w-full lg:z-auto transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none h-dvh overflow-hidden">
    
    <div class="flex items-center justify-between border-b border-slate-200 h-24 max-h-24 px-4 shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center">
                <x-lucide-graduation-cap class="size-5" />
            </div>
            <div>
                <h1 class="text-lg font-bold">SISTEM <span class="text-primary">KRS</span></h1>
                <p class="text-xs text-slate-600">Sistem Akademik KRS</p>
            </div>
        </div>
        <button type="button" 
                id="sidebar-close-btn" 
                onclick="window.closeAppSidebar && window.closeAppSidebar()"
                class="lg:hidden p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition cursor-pointer"
                aria-label="Tutup Sidebar">
            <x-lucide-x class="size-5 pointer-events-none" />
        </button>
    </div>

    <div class="flex-1 py-3 px-4 space-y-4 overflow-y-auto">
        @if($tahun_ajaran)
            <div class="bg-primary/10 rounded-2xl p-3 border border-primary/30 relative">
                <h4 class="text-primary text-xs mb-2 uppercase font-semibold">Semester Aktif</h4>
                <p class="text-black font-semibold text-xs uppercase">{{ $tahun_ajaran->semester . ' ' . $tahun_ajaran->tahun }}</p>
                <p class="text-slate-600 text-xs">Semester aktif saat ini</p>
                <div class="absolute right-3 top-3 animate-pulse bg-primary w-2 h-2 rounded-full"></div>
            </div>
        @else
            <div class="bg-danger/10 rounded-2xl p-3 border border-danger/30 relative">
                <h4 class="text-danger text-xs mb-2 uppercase font-semibold">Informasi</h4>
                <p class="text-black font-semibold text-xs">Tidak ada semester aktif</p>
                <p class="text-slate-600 text-xs">Silahkan hubungi admin untuk mengaktifkan semester</p>
            </div>
        @endif
        <div class="space-y-2">
            <h2 class="font-semibold text-xs text-slate-600">MENU UTAMA</h2>
            @foreach ($menus as $menu)
                @if (in_array(Auth::user()->role, $menu['roles']))
                    <a href="{{ $menu['url'] }}"
                        class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-slate-600 {{ $menu['is_active'] ? 'bg-primary text-white' : 'hover:bg-slate-100 transition' }}">
                        @svg('lucide-' . $menu['icon'], 'size-5')
                        <p class="flex-1 {{ $menu['is_active'] ? 'font-semibold' : 'font-regular' }}">
                            {{ $menu['title'] }}
                        </p>
                        @if ($menu['is_active'])
                            <x-lucide-arrow-right class="size-5" />
                        @endif
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <div class="flex justify-center mt-auto border-t border-slate-200 py-3 px-4 shrink-0">
        <form action="{{ route('auth.logout') }}" method="post" class="w-full">
            @csrf

            <button type="submit"
                class="w-full px-3 py-2.5 flex items-center rounded-2xl gap-3 text-danger bg-danger/15 border border-danger/30 cursor-pointer hover:bg-danger/25 transition">
                <x-lucide-log-out class="size-5" />
                Logout
            </button>
        </form>
    </div>
</nav>

<script>
    window.openAppSidebar = function () {
        const sidebar = document.getElementById('app-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        if (!sidebar || !backdrop) return;

        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        sidebar.style.transform = 'translateX(0)';

        backdrop.classList.remove('opacity-0', 'pointer-events-none');
        backdrop.classList.add('opacity-100', 'pointer-events-auto');
        backdrop.style.opacity = '1';
        backdrop.style.pointerEvents = 'auto';
    };

    window.closeAppSidebar = function () {
        const sidebar = document.getElementById('app-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        if (!sidebar || !backdrop) return;

        if (window.innerWidth < 1024) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            sidebar.style.transform = 'translateX(-100%)';
        } else {
            sidebar.style.transform = '';
        }

        backdrop.classList.remove('opacity-100', 'pointer-events-auto');
        backdrop.classList.add('opacity-0', 'pointer-events-none');
        backdrop.style.opacity = '0';
        backdrop.style.pointerEvents = 'none';
    };

    document.addEventListener('click', function (e) {
        if (e.target.closest('#sidebar-toggle-btn')) {
            e.preventDefault();
            window.openAppSidebar();
        } else if (e.target.closest('#sidebar-close-btn')) {
            e.preventDefault();
            window.closeAppSidebar();
        } else if (e.target && e.target.id === 'sidebar-backdrop') {
            window.closeAppSidebar();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            window.closeAppSidebar();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar) sidebar.style.transform = '';
            if (backdrop) {
                backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
                backdrop.style.opacity = '0';
                backdrop.style.pointerEvents = 'none';
            }
        }
    });
</script>