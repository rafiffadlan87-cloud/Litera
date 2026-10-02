<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Riwayat Peminjaman - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary-container": "#2563eb", background: "#f8f9ff",
                        "surface-container-low": "#eff4ff", "on-primary": "#ffffff",
                        "primary-fixed": "#dbe1ff", "inverse-surface": "#213145",
                        "surface-container-lowest": "#ffffff", tertiary: "#006242",
                        "error-container": "#ffdad6", "secondary-fixed": "#d8e3fb",
                        "tertiary-fixed": "#6ffbbe", "on-background": "#0b1c30",
                        "inverse-primary": "#b4c5ff", "secondary-container": "#d5e0f8",
                        "outline-variant": "#c3c6d7", surface: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff", secondary: "#545f73",
                        "surface-container": "#e5eeff", "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655", "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe", "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a", "surface-container-high": "#dce9ff",
                        "on-surface": "#0b1c30", primary: "#004ac6",
                        "on-error-container": "#93000a", outline: "#737686"
                    },
                    spacing: {
                        "margin-tablet": "1.5rem", "space-xs": "0.25rem",
                        "space-xl": "1.5rem", "space-sm": "0.5rem", "space-md": "0.75rem",
                        margin: "1rem", "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Plus Jakarta Sans"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-body-md text-on-surface antialiased">

{{-- SIDEBAR --}}
<aside class="fixed left-0 top-0 h-full w-72 bg-inverse-surface text-inverse-on-surface z-50 flex flex-col justify-between shadow-sm">
    <div class="flex flex-col flex-1 overflow-y-auto">
        <div class="flex items-center gap-space-md px-margin py-space-lg">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[20px]">menu_book</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline-sm text-headline-sm text-on-primary tracking-tight">LITERA</span>
                <span class="font-label-sm text-label-sm text-inverse-primary">Portal Siswa</span>
            </div>
        </div>
        <div class="mx-margin my-space-sm p-space-md rounded-xl bg-on-background/40 flex items-center gap-space-md">
            <div class="w-10 h-10 rounded-full bg-primary flex-shrink-0 flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[20px]">person</span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-lg text-label-lg text-on-primary truncate">{{ Auth::user()->name }}</span>
                <span class="font-body-sm text-body-sm text-secondary-fixed-dim truncate">Siswa</span>
                <span class="font-label-sm text-label-sm text-secondary-fixed truncate">NISN: {{ Auth::user()->borrower->nisn ?? '-' }}</span>
            </div>
        </div>
        <nav class="flex-1 px-margin py-space-md flex flex-col gap-space-xs">
            <a href="{{ route('siswa.dashboard') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Dashboard</a>
            <a href="{{ route('siswa.katalog') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Katalog Buku</a>
            <a href="{{ route('siswa.riwayat') }}" class="px-space-lg py-space-md transition-all block bg-primary-container text-on-primary font-bold rounded-lg shadow-sm">Riwayat Peminjaman</a>
            <a href="{{ route('siswa.booking') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Booking / Reservasi</a>
            <a href="{{ route('siswa.perpanjangan') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Perpanjangan Buku</a>
        </nav>
    </div>
    <div class="p-margin">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-space-lg py-space-md rounded-lg text-error-container hover:bg-error/20 hover:text-on-error transition-all font-label-lg text-label-lg block text-left">Keluar</button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="pl-72 flex flex-col min-h-screen">
    <header class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
        <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
            <span class="text-secondary">Portal Siswa</span>
            <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
            <span class="text-primary font-bold">Riwayat Peminjaman</span>
        </div>
        <div class="flex items-center gap-space-lg">
            <div class="hidden sm:flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
            </div>
        </div>
    </header>

    <main class="relative pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
        <div class="flex flex-col w-full">

            {{-- Alert --}}
            @if (session('success'))
                <div class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Header Card --}}
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm mb-space-lg overflow-hidden">
                <div class="flex items-start justify-between px-space-xl pt-space-xl pb-space-lg">
                    <div class="flex items-start gap-space-md">
                        <div class="w-11 h-11 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-[26px]">manage_history</span>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-space-sm flex-wrap">
                                <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight">Riwayat Peminjaman</h2>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-secondary-fixed text-on-secondary-fixed">
                                    Total {{ $totalCatatan }} Catatan Transaksi
                                </span>
                            </div>
                            <p class="font-body-md text-secondary mt-1">Daftar aktivitas peminjaman, pengembalian, dan status reservasi buku Anda</p>
                        </div>
                    </div>
                </div>

                {{-- Filter Tabs --}}
                <div class="px-space-xl pb-space-sm">
                    <div class="flex items-center gap-space-xs overflow-x-auto pb-1">
                        @php
                            $tabs = [
                                'semua' => ['label' => 'Semua', 'count' => $totalCatatan],
                                'dipinjam' => ['label' => 'Dipinjam', 'count' => $totalPinjam],
                                'dikembalikan' => ['label' => 'Dikembalikan', 'count' => $totalDikembalikan],
                                'waiting' => ['label' => 'Waiting List', 'count' => $totalWaiting],
                            ];
                        @endphp
                        @foreach($tabs as $key => $t)
                            <a href="{{ route('siswa.riwayat', ['tab' => $key, 'search' => $search]) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-label-lg text-label-lg whitespace-nowrap transition-colors
                                      {{ $tab === $key 
                                         ? 'bg-primary-container text-on-primary shadow-sm' 
                                         : 'bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface' }}">
                                <span>{{ $t['label'] }}</span>
                                <span class="px-2 py-0.5 rounded-full text-label-sm font-label-sm
                                             {{ $tab === $key 
                                                ? 'bg-on-primary/20 text-on-primary' 
                                                : 'bg-secondary-container text-on-secondary-container' }}">
                                    {{ $t['count'] }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Search Bar --}}
                <form method="GET" action="{{ route('siswa.riwayat') }}" class="px-space-xl py-space-md bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-space-md">
                    <input type="hidden" name="tab" value="{{ $tab }}">
                    <div class="relative w-full sm:w-80 flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-[18px] text-outline pointer-events-none">search</span>
                        <input name="search" value="{{ $search }}" class="w-full pl-9 pr-4 py-2 bg-surface-container-lowest rounded-lg font-body-sm text-on-surface placeholder:text-outline outline-none focus:ring-2 focus:ring-primary-container shadow-sm" placeholder="Cari judul buku atau penulis..." type="text"/>
                    </div>
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg shadow-sm transition-all">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            {{-- List Items --}}
            <div class="space-y-space-md">
                @php
                    $hasItems = $borrowings->count() > 0 || $queues->count() > 0;
                @endphp

                @if($hasItems)
                    {{-- Borrowings --}}
                    @foreach($borrowings as $b)
                        @php
                            $daysLeft = \Carbon\Carbon::now()->diffInDays($b->due_date, false);
                            $isLate = $b->status === 'terlambat' || ($b->status === 'dipinjam' && $daysLeft < 0);
                            $trxId = 'TRX-' . date('Y') . '-' . str_pad($b->id, 4, '0', STR_PAD_LEFT);
                        @endphp
                        <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row items-start md:items-center justify-between gap-space-lg">
                            <div class="flex items-start gap-space-md min-w-0">
                                <img class="w-16 h-22 sm:w-20 sm:h-28 object-cover rounded-md flex-shrink-0 shadow-sm"
                                     src="{{ $b->book->cover ?? 'https://via.placeholder.com/200x280?text=No+Cover' }}"
                                     alt="{{ $b->book->title }}"/>
                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        @if($b->status === 'dikembalikan')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-tertiary-fixed text-on-tertiary-fixed font-bold">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                Dikembalikan
                                            </span>
                                        @elseif($isLate)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-error-container text-on-error-container">
                                                <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                Terlambat
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-error-container text-on-error-container">
                                                <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                Dipinjam (Aktif)
                                            </span>
                                        @endif

                                        @if($b->status === 'dipinjam' && !$isLate && $daysLeft <= 3 && $daysLeft >= 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-label-sm font-label-sm bg-amber-100 text-amber-900">
                                                <span class="material-symbols-outlined text-[13px]">alarm</span>
                                                Jatuh tempo {{ $daysLeft }} hari lagi
                                            </span>
                                        @endif

                                        @if($b->extensions_count > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-label-sm font-label-sm bg-secondary-fixed text-on-secondary-fixed">
                                                <span class="material-symbols-outlined text-[13px]">published_with_changes</span>
                                                Diperpanjang ({{ $b->extensions_count }}x)
                                            </span>
                                        @endif

                                        <span class="font-label-sm text-label-sm text-secondary font-mono">{{ $trxId }}</span>
                                    </div>

                                    <h3 class="font-headline-sm text-headline-sm text-on-surface truncate">{{ $b->book->title }}</h3>
                                    <p class="font-body-sm text-secondary">{{ $b->book->author }}</p>

                                    <div class="flex items-center gap-space-lg mt-2 text-on-surface-variant font-body-sm">
                                        <div class="flex items-center gap-1">
                                            <span class="text-outline text-label-sm">Tgl Pinjam:</span>
                                            <span class="font-medium text-on-surface">{{ $b->borrow_date->format('d M Y') }}</span>
                                        </div>
                                        @if($b->status === 'dikembalikan')
                                            <div class="flex items-center gap-1">
                                                <span class="text-outline text-label-sm">Dikembalikan:</span>
                                                <span class="font-medium text-on-surface">{{ $b->returned_at->format('d M Y') }}</span>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-1">
                                                <span class="text-outline text-label-sm">Jatuh Tempo:</span>
                                                <span class="font-bold {{ $isLate ? 'text-error' : 'text-on-surface' }}">{{ $b->due_date->format('d M Y') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-space-sm w-full md:w-auto justify-end flex-shrink-0">
                                <a href="{{ route('siswa.detail', $b->book->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">info</span>
                                    Detail
                                </a>
                                @if($b->status === 'dipinjam' && !$isLate && $b->extensions_count < 1)
                                    <form method="POST" action="#">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-md shadow-sm transition-all">
                                            <span class="material-symbols-outlined text-[16px]">update</span>
                                            Perpanjang
                                        </button>
                                    </form>
                                @elseif($b->status === 'dipinjam')
                                    <button disabled class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container-low text-outline cursor-not-allowed font-label-md">
                                        <span class="material-symbols-outlined text-[16px]">lock_clock</span>
                                        Sisa Kuota {{ 1 - $b->extensions_count }}x
                                    </button>
                                @elseif($b->status === 'dikembalikan')
                                    <a href="{{ route('siswa.detail', $b->book->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary-container font-label-md transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">replay</span>
                                        Pinjam Lagi
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Queues (Waiting List) --}}
                    @foreach($queues as $q)
                        @php
                            $posisi = \App\Models\BookQueue::where('book_id', $q->book_id)
                                ->where('created_at', '<=', $q->created_at)
                                ->count();
                            $total = \App\Models\BookQueue::where('book_id', $q->book_id)->count();
                            $wltId = 'WLT-' . date('Y') . '-' . str_pad($q->id, 4, '0', STR_PAD_LEFT);
                        @endphp
                        <div class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row items-start md:items-center justify-between gap-space-lg">
                            <div class="flex items-start gap-space-md min-w-0">
                                <img class="w-16 h-22 sm:w-20 sm:h-28 object-cover rounded-md flex-shrink-0 shadow-sm"
                                     src="{{ $q->book->cover ?? 'https://via.placeholder.com/200x280?text=No+Cover' }}"
                                     alt="{{ $q->book->title }}"/>
                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-amber-100 text-amber-900 font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                            Waiting List
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-label-sm font-label-sm bg-secondary-fixed text-on-secondary-fixed font-semibold">
                                            Antrean #{{ $posisi }} dari {{ $total }}
                                        </span>
                                        <span class="font-label-sm text-label-sm text-secondary font-mono">{{ $wltId }}</span>
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface truncate">{{ $q->book->title }}</h3>
                                    <p class="font-body-sm text-secondary">{{ $q->book->author }}</p>
                                    <div class="flex items-center gap-space-lg mt-2 text-on-surface-variant font-body-sm">
                                        <div class="flex items-center gap-1">
                                            <span class="text-outline text-label-sm">Diajukan:</span>
                                            <span class="font-medium text-on-surface">{{ $q->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-space-sm w-full md:w-auto justify-end flex-shrink-0">
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 rounded-lg text-secondary hover:bg-surface-container font-label-md transition-colors">
                                        Batal Antrean
                                    </button>
                                </form>
                                <a href="{{ route('siswa.detail', $q->book->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary-container font-label-md transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">format_list_numbered</span>
                                    Cek Posisi
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Empty State --}}
                    <div class="bg-surface-container-lowest rounded-xl p-12 shadow-sm text-center">
                        <div class="w-20 h-20 rounded-full bg-surface-container-low flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-[40px] text-outline">history</span>
                        </div>
                        <h3 class="font-headline-md text-on-surface">Belum Ada Riwayat</h3>
                        <p class="font-body-md text-secondary mt-2 max-w-md mx-auto">
                            @if($tab === 'semua')
                                Anda belum memiliki catatan peminjaman, pengembalian, atau antrean buku.
                            @elseif($tab === 'dipinjam')
                                Anda tidak memiliki buku yang sedang dipinjam saat ini.
                            @elseif($tab === 'dikembalikan')
                                Belum ada buku yang pernah Anda kembalikan.
                            @elseif($tab === 'waiting')
                                Anda tidak sedang berada dalam antrean buku apa pun.
                            @endif
                        </p>
                        <a href="{{ route('siswa.katalog') }}" class="inline-flex items-center gap-2 mt-4 px-6 py-2.5 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg shadow-sm transition-all">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            <span>Jelajahi Katalog</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </main>
</div>
</body>
</html>