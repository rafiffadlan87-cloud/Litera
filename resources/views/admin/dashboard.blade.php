<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Admin - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        error: "#ba1a1a",
                        outline: "#737686",
                        primary: "#004ac6",
                        surface: "#f8f9ff",
                        "surface-container": "#e5eeff",
                        "surface-container-highest": "#d3e4fe",
                        "surface-container-high": "#dce9ff",
                        background: "#f8f9ff",
                        "surface-dim": "#cbdbf5",
                        "inverse-on-surface": "#eaf1ff",
                        "on-secondary-container": "#586377",
                        "on-primary-fixed-variant": "#003ea8",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        secondary: "#545f73",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#bcc7de",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#3c475a",
                        "primary-fixed-dim": "#b4c5ff",
                        "tertiary-fixed-dim": "#4edea3",
                        "inverse-primary": "#b4c5ff",
                        "on-surface-variant": "#434655",
                        "surface-variant": "#d3e4fe",
                        "on-secondary-fixed": "#111c2d",
                        "on-secondary": "#ffffff",
                        "surface-bright": "#f8f9ff",
                        "tertiary-container": "#007d55",
                        "on-primary-fixed": "#00174b",
                        "on-background": "#0b1c30",
                        "secondary-fixed": "#d8e3fb",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#bdffdb",
                        "on-error": "#ffffff",
                        "on-surface": "#0b1c30",
                        "on-primary-container": "#eeefff",
                        tertiary: "#006242",
                        "secondary-container": "#d5e0f8",
                        "error-container": "#ffdad6",
                        "surface-tint": "#0053db",
                        "outline-variant": "#c3c6d7",
                        "primary-fixed": "#dbe1ff",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-tertiary-fixed": "#002113",
                        "inverse-surface": "#213145",
                        "tertiary-fixed": "#6ffbbe",
                        "primary-container": "#2563eb"
                    },
                    spacing: {
                        margin: "1rem",
                        gutter: "1rem",
                        "gutter-sm": "0.75rem",
                        "margin-tablet": "1.5rem",
                        "space-xl": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-md": "0.75rem",
                        "space-lg": "1rem",
                        "space-sm": "0.5rem"
                    },
                    fontFamily: {
                        "body-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "body-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "body-lg": ["16px", {
                            lineHeight: "24px",
                            fontWeight: "400"
                        }],
                        "body-md": ["14px", {
                            lineHeight: "20px",
                            fontWeight: "400"
                        }],
                        "headline-sm": ["16px", {
                            lineHeight: "24px",
                            fontWeight: "600"
                        }],
                        "body-sm": ["12px", {
                            lineHeight: "18px",
                            fontWeight: "400"
                        }],
                        "label-lg": ["14px", {
                            lineHeight: "20px",
                            fontWeight: "600"
                        }],
                        "label-md": ["12px", {
                            lineHeight: "16px",
                            fontWeight: "600"
                        }],
                        "headline-lg": ["30px", {
                            lineHeight: "38px",
                            fontWeight: "700"
                        }],
                        "headline-md": ["20px", {
                            lineHeight: "28px",
                            fontWeight: "700"
                        }],
                        "label-sm": ["11px", {
                            lineHeight: "14px",
                            letterSpacing: "0.02em",
                            fontWeight: "700"
                        }]
                    }
                }
            }
        };
    </script>
</head>

<body
    class="bg-surface font-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed">

    @php
        // Hitung semua statistik sekali di atas (biar efisien)
        $totalBuku = \App\Models\Book::count();
        $totalStok = \App\Models\Book::sum('stock');
        $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
        $totalPetugas = \App\Models\User::where('role', 'petugas')->count();

        $peminjamanHariIni = \App\Models\Borrowing::whereDate('borrow_date', today())->count();
        $peminjamanAktif = \App\Models\Borrowing::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $peminjamanSelesai = \App\Models\Borrowing::where('status', 'dikembalikan')
            ->whereDate('returned_at', today())
            ->count();

        $totalBooking = \App\Models\BookQueue::count();

        // Ambil 5 peminjaman terbaru
        $recentBorrowings = \App\Models\Borrowing::with(['borrower', 'book.category'])
            ->latest('borrow_date')
            ->take(5)
            ->get();

        // Ambil 5 peminjaman hari ini untuk tab "Semua"
        $peminjamanHariIniAll = \App\Models\Borrowing::whereDate('borrow_date', today())->count();
        $jatuhTempoDekat = \App\Models\Borrowing::whereIn('status', ['dipinjam', 'terlambat'])
            ->whereBetween('due_date', [today(), today()->addDays(3)])
            ->count();

        $todayStr = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y');
        $userName = Auth::user()->name;
        $firstName = explode(' ', $userName)[0];
    @endphp

    {{-- SIDEBAR --}}
        

    {{-- MAIN CONTENT --}}
    <div class="pl-72">
        {{-- HEADER --}}
        <header
            class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-space-lg">
            <div class="flex items-center gap-space-lg">
                <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[20px]">menu_book</span>
                </div>
                <nav
                    class="hidden lg:flex items-center gap-space-sm font-label-md text-label-md text-on-surface-variant">
                    <span class="text-secondary">Portal Admin</span>
                    <span class="material-symbols-outlined text-outline text-[16px]">chevron_right</span>
                    <span class="text-on-surface font-semibold">Dashboard</span>
                </nav>
            </div>

            <div class="flex items-center gap-space-lg">
                <div class="relative hidden md:flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-outline text-[18px]">search</span>
                    <input
                        class="w-64 md:w-80 h-10 pl-9 pr-4 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary-container transition-all"
                        placeholder="Cari judul buku, anggota, transaksi..." type="text" />
                </div>
                <div
                    class="hidden md:flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm px-space-md py-space-xs rounded-xl bg-surface-container-low">
                    <span class="material-symbols-outlined text-[16px] text-secondary">calendar_today</span>
                    <span>{{ $todayStr }}</span>
                </div>
                <div class="relative flex items-center">
                    <button
                        class="w-10 h-10 rounded-xl bg-surface-container-low flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors"
                        type="button">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                    </button>
                    <span
                        class="absolute top-1.5 right-1.5 w-2.5 h-2.5 rounded-full bg-error ring-2 ring-surface-container-lowest"></span>
                </div>
                <div class="flex items-center gap-space-sm pl-space-sm">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                    </div>
                    <div class="hidden sm:flex flex-col text-left">
                        <span class="font-label-sm text-label-sm text-on-surface">{{ $firstName }}</span>
                        <span class="font-body-sm text-[10px] leading-3 text-secondary">Admin</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- MAIN --}}
        <main class="relative pt-16 bg-surface min-h-screen px-space-lg py-space-lg">
            <div class="flex flex-col w-full gap-space-xl">

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="p-4 rounded-xl bg-tertiary-fixed/30 text-tertiary flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Header Section --}}
                <section
                    class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-lg bg-surface-container-lowest p-space-xl rounded-xl shadow-sm">
                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-sm flex-wrap">
                            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                                Selamat Datang Kembali, {{ $firstName }} 👋
                            </h1>
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-surface-container text-primary font-label-sm text-label-sm">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                Sistem Online
                            </span>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">
                            Berikut ringkasan operasional dan sirkulasi pustaka hari ini,
                            <span class="font-semibold text-on-surface">{{ $todayStr }}</span>.
                        </p>
                    </div>

                    <div class="flex items-center gap-space-md shrink-0 flex-wrap">
                        <button
                            class="inline-flex items-center gap-space-sm h-11 px-4 rounded-xl bg-surface-container-lowest text-primary font-label-lg text-label-lg shadow-sm hover:bg-surface-container-low transition-all active:scale-[0.98]"
                            type="button">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            <span>+ Tambah Buku Baru</span>
                        </button>
                        <button
                            class="inline-flex items-center gap-space-sm h-11 px-5 rounded-xl bg-primary-container text-on-primary font-label-lg text-label-lg shadow-md hover:bg-primary transition-all active:scale-[0.98]"
                            type="button">
                            <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                            <span>+ Entri Peminjaman Cepat</span>
                        </button>
                    </div>
                </section>

                {{-- 4 Metrik Statistik Utama (DINAMIS) --}}
                <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-lg">
                    {{-- Card 1: Total Buku --}}
                    <div
                        class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-start justify-between gap-space-md">
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-secondary tracking-wide">Total Koleksi
                                    Buku</span>
                                <h2 class="font-headline-lg text-headline-lg text-on-surface mt-1 tracking-tight">
                                    {{ number_format($totalBuku) }} <span
                                        class="font-body-md text-body-md text-secondary">Judul</span>
                                </h2>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center text-primary shrink-0 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[26px]">library_books</span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-tertiary font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-[16px]">inventory_2</span>
                                <span>{{ number_format($totalStok) }} eksemplar</span>
                            </div>
                            <span class="font-body-sm text-body-sm text-outline-variant">Stok fisik total</span>
                        </div>
                    </div>

                    {{-- Card 2: Total Anggota --}}
                    <div
                        class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-start justify-between gap-space-md">
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-secondary tracking-wide">Total Anggota
                                    Aktif</span>
                                <h2 class="font-headline-lg text-headline-lg text-on-surface mt-1 tracking-tight">
                                    {{ number_format($totalSiswa + $totalPetugas) }} <span
                                        class="font-body-md text-body-md text-secondary">Orang</span>
                                </h2>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-secondary-container flex items-center justify-center text-on-secondary-fixed-variant shrink-0 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[26px]">badge</span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-tertiary font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-[16px]">verified</span>
                                <span>{{ $totalSiswa }} siswa terdaftar</span>
                            </div>
                            <span class="font-body-sm text-body-sm text-outline-variant">+{{ $totalPetugas }}
                                petugas</span>
                        </div>
                    </div>

                    {{-- Card 3: Peminjaman Hari Ini --}}
                    <div
                        class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-start justify-between gap-space-md">
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-secondary tracking-wide">Peminjaman Hari
                                    Ini</span>
                                <h2 class="font-headline-lg text-headline-lg text-on-surface mt-1 tracking-tight">
                                    {{ $peminjamanHariIni }} <span
                                        class="font-body-md text-body-md text-secondary">Transaksi</span>
                                </h2>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-error-container/40 flex items-center justify-center text-primary-container shrink-0 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[26px]">calendar_clock</span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm flex items-center justify-between">
                            <span class="font-label-sm text-label-sm text-on-surface-variant">{{ $peminjamanSelesai }}
                                dikembalikan</span>
                            <span class="font-label-sm text-label-sm text-primary font-bold">{{ $peminjamanAktif }}
                                aktif</span>
                        </div>
                    </div>

                    {{-- Card 4: Booking & Waiting List --}}
                    <div
                        class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-start justify-between gap-space-md">
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-secondary tracking-wide">Booking &
                                    Waiting
                                    List</span>
                                <h2 class="font-headline-lg text-headline-lg text-on-surface mt-1 tracking-tight">
                                    {{ $totalBooking }} <span
                                        class="font-body-md text-body-md text-secondary">Reservasi</span>
                                </h2>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-surface-container-highest flex items-center justify-center text-primary shrink-0 group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-[26px]">hourglass_top</span>
                            </div>
                        </div>
                        <div class="mt-space-md pt-space-sm flex items-center justify-between">
                            <span class="font-label-sm text-label-sm text-tertiary">Menunggu giliran</span>
                            <span class="font-label-sm text-label-sm text-secondary">Dalam antrean</span>
                        </div>
                    </div>
                </section>

                {{-- Dual Main Panels --}}
                <section class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
                    {{-- Panel Kiri: Peminjaman Terbaru --}}
                    <div
                        class="lg:col-span-8 flex flex-col bg-surface-container-lowest rounded-xl shadow-sm p-space-lg md:p-space-xl">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md pb-space-lg">
                            <div>
                                <div class="flex items-center gap-space-sm">
                                    <h2 class="font-headline-md text-headline-md text-on-surface">Peminjaman Terbaru
                                    </h2>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-surface-container-low text-secondary font-label-sm text-label-sm">5
                                        Transaksi Terakhir</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-secondary mt-0.5">Daftar sirkulasi peminjaman
                                    buku terakhir</p>
                            </div>
                            <a class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:text-primary-container font-semibold group self-start sm:self-auto"
                                href="#">
                                <span>Lihat Semua</span>
                                <span
                                    class="material-symbols-outlined text-[18px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                            </a>
                        </div>

                        {{-- Quick Filter Tabs (visual saja) --}}
                        <div
                            class="flex items-center gap-space-xs mb-space-lg bg-surface-container-low p-1 rounded-xl self-start">
                            <button
                                class="tab-btn active px-3.5 py-1.5 rounded-lg bg-surface-container-lowest text-primary font-label-sm text-label-sm font-semibold shadow-sm transition-all"
                                data-filter="all" type="button">
                                Semua ({{ $peminjamanHariIniAll }})
                            </button>
                            <button
                                class="tab-btn px-3.5 py-1.5 rounded-lg text-secondary hover:text-on-surface font-label-sm text-label-sm transition-all"
                                data-filter="active" type="button">
                                Aktif ({{ $peminjamanAktif }})
                            </button>
                            <button
                                class="tab-btn px-3.5 py-1.5 rounded-lg text-secondary hover:text-on-surface font-label-sm text-label-sm transition-all"
                                data-filter="due" type="button">
                                Tempo Dekat ({{ $jatuhTempoDekat }})
                            </button>
                        </div>

                        {{-- Table Section --}}
                        <div class="overflow-x-auto -mx-space-lg md:-mx-space-xl px-space-lg md:px-space-xl">
                            <table class="w-full text-left border-collapse min-w-[720px]">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low/60 text-secondary font-label-sm text-label-sm uppercase tracking-wider">
                                        <th class="py-3 px-4 rounded-l-lg">Anggota</th>
                                        <th class="py-3 px-4">Judul Buku & Kategori</th>
                                        <th class="py-3 px-4">Tgl Pinjam</th>
                                        <th class="py-3 px-4">Jatuh Tempo</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4 text-right rounded-r-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container-low font-body-sm text-body-sm">
                                    @forelse($recentBorrowings as $b)
                                        @php
                                            $initials = collect(explode(' ', $b->borrower->name ?? 'Tamu'))
                                                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                                ->take(2)
                                                ->join('');
                                            $daysLeft = \Carbon\Carbon::now()->diffInDays($b->due_date, false);
                                            $isLate =
                                                $b->status === 'terlambat' ||
                                                ($b->status === 'dipinjam' && $daysLeft < 0);
                                            $isDueToday = $b->due_date->isToday();
                                        @endphp
                                        <tr
                                            class="hover:bg-surface-container-low/40 transition-colors {{ $isDueToday ? 'bg-secondary-fixed/20' : '' }}">
                                            <td class="py-3.5 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold font-label-md text-label-md shrink-0">
                                                        {{ $initials }}
                                                    </div>
                                                    <div>
                                                        <p class="font-label-md text-label-md text-on-surface">
                                                            {{ $b->borrower->name ?? 'Tamu' }}</p>
                                                        <p class="font-body-sm text-body-sm text-outline-variant">NISN:
                                                            {{ $b->borrower->nisn ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4">
                                                <div class="flex flex-col max-w-[220px]">
                                                    <span
                                                        class="font-label-md text-label-md text-on-surface truncate">{{ $b->book->title }}</span>
                                                    <span
                                                        class="font-body-sm text-body-sm text-secondary">{{ $b->book->category->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 text-on-surface-variant font-medium">
                                                {{ $b->borrow_date->format('d M Y') }}</td>
                                            <td
                                                class="py-3.5 px-4 {{ $isLate ? 'text-error font-semibold' : 'text-on-surface-variant font-medium' }}">
                                                {{ $b->due_date->format('d M Y') }}
                                                @if ($isDueToday)
                                                    <span
                                                        class="text-[10px] uppercase font-bold tracking-tight bg-error-container text-on-error-container px-1 rounded ml-1">(Hari
                                                        Ini)</span>
                                                @endif
                                            </td>
                                            <td class="py-3.5 px-4">
                                                @if ($b->status === 'dikembalikan')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-tertiary-fixed/30 text-tertiary font-label-sm text-label-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                                                        Dikembalikan
                                                    </span>
                                                @elseif($isDueToday)
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                                        Tempo Hari Ini
                                                    </span>
                                                @elseif($isLate)
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                        Terlambat
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-error-container/60 text-on-error-container font-label-sm text-label-sm">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                        Dipinjam
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-3.5 px-4 text-right">
                                                <div class="inline-flex items-center gap-1.5">
                                                    <button
                                                        class="px-2.5 py-1 rounded-lg bg-surface-container-low text-secondary hover:text-on-surface font-label-sm text-label-sm transition-colors"
                                                        type="button">
                                                        Detail
                                                    </button>
                                                    @if ($b->status !== 'dikembalikan')
                                                        <button
                                                            class="px-2.5 py-1 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-sm text-label-sm transition-colors shadow-sm"
                                                            type="button">
                                                            Kembalikan
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-12 text-center">
                                                <span
                                                    class="material-symbols-outlined text-[48px] text-outline block mb-2">inbox</span>
                                                <p class="font-body-md text-secondary">Belum ada transaksi peminjaman.
                                                </p>
                                                <p class="font-body-sm text-outline-variant mt-1">Data akan muncul
                                                    setelah
                                                    siswa meminjam buku.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Footer Info --}}
                        <div
                            class="mt-space-lg pt-space-md flex flex-col sm:flex-row sm:items-center justify-between gap-space-md text-secondary font-body-sm text-body-sm">
                            <div class="flex items-center gap-space-md">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-error"></span> Total Aktif: <strong
                                        class="text-on-surface">{{ $peminjamanAktif }} Buku</strong>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-tertiary"></span> Dikembalikan Hari Ini:
                                    <strong class="text-on-surface">{{ $peminjamanSelesai }} Buku</strong>
                                </span>
                            </div>
                            <span class="text-outline-variant font-label-sm text-label-sm">Data real-time dari
                                database</span>
                        </div>
                    </div>

                    {{-- Panel Kanan: Aktivitas Terbaru --}}
                    <div
                        class="lg:col-span-4 flex flex-col bg-surface-container-lowest rounded-xl shadow-sm p-space-lg md:p-space-xl">
                        <div class="flex items-start justify-between gap-space-md pb-space-lg">
                            <div>
                                <div class="flex items-center gap-space-xs">
                                    <h2 class="font-headline-md text-headline-md text-on-surface">Aktivitas Terbaru
                                    </h2>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-tertiary-fixed/30 text-tertiary font-label-sm text-label-sm font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-ping"></span>
                                        Live Update
                                    </span>
                                </div>
                                <p class="font-body-sm text-body-sm text-secondary mt-0.5">Log kegiatan sirkulasi</p>
                            </div>
                            <button
                                class="w-8 h-8 rounded-lg bg-surface-container-low flex items-center justify-center text-secondary hover:text-primary transition-colors"
                                title="Muat Ulang" type="button">
                                <span class="material-symbols-outlined text-[18px]">refresh</span>
                            </button>
                        </div>

                        <div
                            class="relative flex flex-col flex-1 pl-6 space-y-6 before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-surface-container">
                            @forelse($recentBorrowings as $b)
                                @php
                                    $activityType = $b->status === 'dikembalikan' ? 'returned' : 'borrowed';
                                    $dotColor = $activityType === 'returned' ? 'bg-tertiary' : 'bg-primary-container';
                                @endphp
                                <div class="relative group">
                                    <div
                                        class="absolute -left-[29px] top-0.5 w-6 h-6 rounded-full bg-surface-container-lowest flex items-center justify-center shadow-sm">
                                        <span
                                            class="w-3 h-3 rounded-full {{ $dotColor }} ring-2 ring-surface-container-lowest"></span>
                                    </div>
                                    <div class="flex flex-col gap-0.5">
                                        <div class="flex items-center justify-between gap-2">
                                            <span class="font-label-md text-label-md text-on-surface">
                                                {{ $activityType === 'returned' ? 'Buku Dikembalikan' : 'Peminjaman Buku' }}
                                            </span>
                                            <span class="font-body-sm text-[11px] text-outline-variant shrink-0">
                                                {{ $b->borrow_date->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                                            <strong
                                                class="text-on-surface font-semibold">{{ $b->borrower->name ?? 'Tamu' }}</strong>
                                            @if ($activityType === 'returned')
                                                mengembalikan <span
                                                    class="italic text-on-surface">'{{ Str::limit($b->book->title, 30) }}'</span>.
                                            @else
                                                meminjam <span
                                                    class="italic text-primary">'{{ Str::limit($b->book->title, 30) }}'</span>.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <span
                                        class="material-symbols-outlined text-[40px] text-outline block mb-2">history</span>
                                    <p class="font-body-sm text-secondary">Belum ada aktivitas tercatat.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-space-lg pt-space-md border-t-0 flex items-center justify-center">
                            <a class="w-full text-center py-2.5 rounded-xl bg-surface-container-low text-primary font-label-md text-label-md font-semibold hover:bg-surface-container transition-colors flex items-center justify-center gap-1.5"
                                href="#">
                                <span>Lihat Semua Log Sirkulasi</span>
                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm',
                        'font-semibold');
                    b.classList.add('text-secondary');
                });
                btn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm',
                    'font-semibold');
                btn.classList.remove('text-secondary');
            });
        });
    </script>
</body>

</html>
