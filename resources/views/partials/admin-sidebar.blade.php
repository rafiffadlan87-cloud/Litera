<aside
    class="fixed left-0 top-0 h-full w-72 bg-inverse-surface text-inverse-on-surface z-50 flex flex-col justify-between shadow-sm">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <div class="flex items-center gap-space-md px-margin py-space-lg">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-on-primary text-[20px]">menu_book</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline-sm text-headline-sm text-on-primary tracking-tight">LITERA</span>
                <span class="font-label-sm text-label-sm text-inverse-primary">Portal Admin</span>
            </div>
        </div>
        <div class="mx-margin my-space-sm p-space-md rounded-xl bg-on-background/40 flex items-center gap-space-md">
            <div class="w-10 h-10 rounded-full bg-primary flex-shrink-0 flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[20px]">shield_person</span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-lg text-label-lg text-on-primary truncate">{{ Auth::user()->name }}</span>
                <span class="font-body-sm text-body-sm text-secondary-fixed-dim truncate">Administrator</span>
            </div>
        </div>
        <nav class="flex-1 px-margin py-space-md flex flex-col gap-space-xs">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-container text-on-primary font-bold shadow-sm' : 'text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary' }}">
                <span class="material-symbols-outlined text-[20px]">space_dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.books.index') }}"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg {{ request()->routeIs('admin.books.*') ? 'bg-primary-container text-on-primary font-bold shadow-sm' : 'text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary' }}">
                <span class="material-symbols-outlined text-[20px]">menu_book</span>
                <span>Kelola Buku</span>
            </a>
            <a href="{{ route('admin.categories') }}"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg {{ request()->routeIs('admin.categories*') ? 'bg-primary-container text-on-primary font-bold shadow-sm' : 'text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary' }}">
                <span class="material-symbols-outlined text-[20px]">sell</span>
                <span>Kelola Kategori</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">group</span>
                <span>Kelola Anggota</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">badge</span>
                <span>Kelola Petugas</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">swap_horiz</span>
                <span>Peminjaman</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">update</span>
                <span>Perpanjangan</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                <span>Laporan</span>
            </a>
            <a href="#"
                class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg transition-all font-label-lg text-label-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                <span>Pengaturan</span>
            </a>
        </nav>
    </div>
    <div class="p-margin">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-error-container hover:bg-error/20 hover:text-on-error transition-all font-label-lg text-label-lg text-left">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
