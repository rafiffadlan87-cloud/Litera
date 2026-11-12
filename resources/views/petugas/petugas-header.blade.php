<header
    class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between gap-space-md pr-margin-tablet">
    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md shrink-0">
        <span class="text-secondary hidden sm:inline">Portal Petugas</span>
        <span class="material-symbols-outlined text-[16px] text-outline hidden sm:inline">chevron_right</span>
        <span class="text-primary font-bold">{{ $page ?? 'Dashboard' }}</span>
    </div>
    <div class="flex items-center gap-space-md shrink-0">
        <div class="hidden lg:flex items-center gap-space-xs text-on-surface-variant font-label-md">
            <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
            <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
        <div class="flex items-center gap-space-sm">
            <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">badge</span>
            </div>
            <div class="hidden md:flex flex-col">
                <span class="font-label-md text-on-surface leading-tight">{{ Auth::user()->name }}</span>
                <span class="font-label-sm text-outline">Petugas</span>
            </div>
        </div>
    </div>
</header>