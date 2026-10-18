<header class="bg-surface border-b border-slate-200 h-18 max-h-18 flex items-center gap-3 px-4">
    <button type="button" 
            id="sidebar-toggle-btn" 
            onclick="window.openAppSidebar && window.openAppSidebar()" 
            aria-label="Buka Menu Navigasi" 
            class="flex items-center justify-center h-10 w-10 rounded-xl bg-background border border-slate-300 text-slate-800 hover:bg-slate-100 hover:text-primary transition cursor-pointer lg:hidden">
        <x-lucide-menu class="size-5 pointer-events-none"/>
    </button>
    <div class="flex-1 flex items-center justify-end gap-3">
        <a href="{{ route('profile') }}" class="flex items-center gap-3.5 rounded-2xl px-3.5 py-2 group transition-all hover:bg-primary/10 border border-transparent hover:border-primary/30">
            <div class="text-end">
                <h4 class="text-sm font-semibold group-hover:text-primary transition-all truncate">{{ Auth::user()->role === 'mahasiswa' ? Auth::user()->mahasiswa->nama_lengkap : Auth::user()->dosen->nama_lengkap ?? Auth::user()->username}}</h4>
                <p class="capitalize text-slate-600 text-xs">{{ Auth::user()->role }}</p>
            </div>
            <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama_lengkap) . '&background=random' }}" alt="poto profile" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
        </a>
    </div>
</header>