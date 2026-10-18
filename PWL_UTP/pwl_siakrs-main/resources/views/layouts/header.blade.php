<header class="bg-surface border-b border-slate-200 h-18 max-h-18 flex items-center gap-3 px-4">
    <a href="" class="flex flex-col gap-2 text-black items-center justify-center h-10 w-10 rounded-xl bg-background border border-slate-300">
        <x-lucide-menu class="size-5"/>
    </a>
    <div class="flex-1 flex items-center justify-end gap-3">
        <button class="flex flex-col gap-2 text-black cursor-pointer items-center justify-center h-10 w-10 rounded-xl bg-background border border-slate-300">
            <x-lucide-bell class="size-5"/>
        </button>
        <a href="{{ route('profile') }}" class="flex items-center gap-3.5 rounded-2xl px-3.5 py-2 group transition-all hover:bg-primary/10 border border-transparent hover:border-primary/30">
            <div class="text-end">
                <h4 class="text-sm font-semibold group-hover:text-primary transition-all truncate">Rafly</h4>
                <p class="capitalize text-slate-600 text-xs">Mahasiswa</p>
            </div>
            <img src="" alt="image" class="w-10 h-10 rounded-full border border-slate-300 object-cover">
        </a>
    </div>
</header>