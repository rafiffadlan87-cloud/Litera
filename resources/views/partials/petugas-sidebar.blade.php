{{-- Sidebar Portal Petugas --}}
<button onclick="document.getElementById('petugasSidebar').classList.toggle('-translate-x-full');document.getElementById('petugasOverlay').classList.toggle('hidden')"
    class="lg:hidden fixed top-3 left-3 z-[60] w-10 h-10 rounded-xl bg-inverse-surface text-white flex items-center justify-center shadow-lg">
    <span class="material-symbols-outlined">menu</span>
</button>
<div id="petugasOverlay" onclick="document.getElementById('petugasSidebar').classList.add('-translate-x-full');this.classList.add('hidden')"
    class="lg:hidden fixed inset-0 bg-inverse-surface/60 backdrop-blur-sm z-40 hidden"></div>

<aside id="petugasSidebar"
    class="fixed inset-y-0 left-0 w-72 bg-inverse-surface text-inverse-on-surface flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="p-6 border-b border-white/10">
        <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-on-primary text-[24px]">badge</span>
            </div>
            <div>
                <h1 class="font-headline-sm font-bold text-white leading-tight">LITERA</h1>
                <p class="font-label-sm text-inverse-on-surface/60 uppercase tracking-wider">Portal Petugas</p>
            </div>
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <div class="mb-3 px-2 font-label-sm text-inverse-on-surface/40 uppercase tracking-wider">Layanan Loket</div>

        @php
            $menu = [
                ['route' => 'petugas.dashboard',   'icon' => 'dashboard',       'label' => 'Dashboard'],
                ['route' => 'petugas.circulation', 'icon' => 'sync_alt',        'label' => 'Meja Sirkulasi'],
                ['route' => 'petugas.bookings',    'icon' => 'bookmark_add',    'label' => 'Pesanan Pengambilan'],
                ['route' => 'petugas.queues',      'icon' => 'hourglass_bottom','label' => 'Antrean FIFO'],
                ['route' => 'petugas.extensions',  'icon' => 'update',          'label' => 'Perpanjangan'],
            ];
        @endphp

        @foreach ($menu as $m)
            <a href="{{ route($m['route']) }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-label-lg transition-colors
                {{ request()->routeIs($m['route']) ? 'bg-primary-container text-on-primary font-bold shadow-md' : 'text-inverse-on-surface/70 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined text-[20px]">{{ $m['icon'] }}</span>
                <span>{{ $m['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-white/10 bg-black/20">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold font-label-md shrink-0">
                {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-label-md text-white truncate">{{ Auth::user()->name }}</p>
                <p class="font-label-sm text-inverse-on-surface/50 truncate">Petugas</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar" class="text-inverse-on-surface/50 hover:text-error transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>