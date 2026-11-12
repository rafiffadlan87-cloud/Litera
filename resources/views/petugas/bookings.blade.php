@include('petugas.petugas-head', ['title' => 'Pesanan Pengambilan'])

<body class="bg-background font-body-md text-on-surface antialiased">

    {{-- ===== SIDEBAR (inline, tidak butuh partial) ===== --}}
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
                    ['route' => 'petugas.dashboard',   'icon' => 'dashboard',        'label' => 'Dashboard'],
                    ['route' => 'petugas.circulation', 'icon' => 'sync_alt',         'label' => 'Meja Sirkulasi'],
                    ['route' => 'petugas.bookings',    'icon' => 'bookmark_add',     'label' => 'Pesanan Pengambilan'],
                    ['route' => 'petugas.queues',      'icon' => 'hourglass_bottom', 'label' => 'Antrean FIFO'],
                    ['route' => 'petugas.extensions',  'icon' => 'update',           'label' => 'Perpanjangan'],
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

    <div class="lg:pl-72 flex flex-col min-h-screen">

        {{-- ===== HEADER (inline, tidak butuh partial) ===== --}}
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between gap-space-md pr-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md shrink-0">
                <span class="text-secondary hidden sm:inline">Portal Petugas</span>
                <span class="material-symbols-outlined text-[16px] text-outline hidden sm:inline">chevron_right</span>
                <span class="text-primary font-bold">Pesanan Pengambilan</span>
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

        <main class="pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full gap-space-lg">

                @if (session('success'))
                    <div class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span><span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span><span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                            Pesanan Pengambilan
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $bookings->count() }} Pesanan</span>
                        </h2>
                        <p class="font-body-sm text-on-surface-variant mt-1">Verifikasi pengambilan buku oleh anggota di loket — peminjaman otomatis tercatat & stok berkurang</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-md">Anggota</th>
                                    <th class="py-space-md px-space-md">Judul Buku</th>
                                    <th class="py-space-md px-space-md">Tenggat Ambil</th>
                                    <th class="py-space-md px-space-md">Status</th>
                                    <th class="py-space-md px-space-md text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($bookings as $bk)
                                    @php
                                        $st = strtolower($bk->status ?? '');
                                        $inactive = ['diambil', 'selesai', 'dibatalkan', 'kadaluarsa', 'batal', 'expired'];
                                        $isActive = !in_array($st, $inactive);
                                        $badge = in_array($st, ['diambil', 'selesai'])
                                            ? 'bg-tertiary-fixed text-on-tertiary-fixed'
                                            : (in_array($st, $inactive)
                                                ? 'bg-error-container text-on-error-container'
                                                : 'bg-secondary-fixed text-on-secondary-fixed');
                                    @endphp
                                    <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                        <td class="py-space-md px-space-md font-label-md">{{ $bk->user->name ?? '-' }}</td>
                                        <td class="py-space-md px-space-md">{{ $bk->book->title ?? '-' }}</td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                            {{ $bk->pickup_deadline ? \Carbon\Carbon::parse($bk->pickup_deadline)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full {{ $badge }} font-label-sm font-bold">
                                                {{ ucfirst($bk->status ?? '-') }}
                                            </span>
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            @if ($isActive)
                                                <form method="POST" action="{{ route('petugas.bookings.verify', $bk->id) }}"
                                                    onsubmit="return confirm('Verifikasi pengambilan {{ addslashes($bk->book->title ?? '') }} oleh {{ addslashes($bk->user->name ?? '') }}?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-sm font-bold shadow-sm">
                                                        Verifikasi Ambil
                                                    </button>
                                                </form>
                                            @else
                                                <span class="font-label-sm text-outline">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-10 text-center text-secondary font-body-md">Belum ada pesanan pengambilan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>

</html>