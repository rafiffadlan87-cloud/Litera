<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Siswa - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-fixed-dim": "#b4c5ff", "primary-container": "#2563eb", background: "#f8f9ff",
                        "surface-container-low": "#eff4ff", "on-primary-fixed-variant": "#003ea8",
                        "on-tertiary-fixed-variant": "#005236", "on-primary": "#ffffff", "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3", "on-secondary-fixed": "#111c2d", "inverse-surface": "#213145",
                        "surface-bright": "#f8f9ff", "surface-container-lowest": "#ffffff", tertiary: "#006242",
                        "error-container": "#ffdad6", "secondary-fixed": "#d8e3fb", "tertiary-fixed": "#6ffbbe",
                        "on-background": "#0b1c30", "on-primary-fixed": "#00174b", "inverse-primary": "#b4c5ff",
                        "secondary-container": "#d5e0f8", "outline-variant": "#c3c6d7", "surface-tint": "#0053db",
                        surface: "#f8f9ff", "inverse-on-surface": "#eaf1ff", secondary: "#545f73",
                        "on-secondary": "#ffffff", "surface-container": "#e5eeff", "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655", "on-secondary-fixed-variant": "#3c475a", "surface-dim": "#cbdbf5",
                        "tertiary-container": "#007d55", "surface-variant": "#d3e4fe", "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a", "surface-container-high": "#dce9ff", "on-primary-container": "#eeefff",
                        "on-surface": "#0b1c30", "on-tertiary-fixed": "#002113", primary: "#004ac6",
                        "on-tertiary-container": "#bdffdb", "on-error-container": "#93000a", outline: "#737686",
                        "on-tertiary": "#ffffff", "on-secondary-container": "#586377", "on-error": "#ffffff"
                    },
                    borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
                    spacing: {
                        "gutter-sm": "0.75rem", "margin-tablet": "1.5rem", gutter: "1rem", "space-xs": "0.25rem",
                        "space-xl": "1.5rem", "space-sm": "0.5rem", "space-md": "0.75rem", margin: "1rem", "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"], "headline-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"], "label-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"], "body-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "headline-lg": ["30px", { lineHeight: "38px", fontWeight: "700" }],
                        "label-sm": ["11px", { lineHeight: "14px", letterSpacing: "0.02em", fontWeight: "700" }],
                        "label-md": ["12px", { lineHeight: "16px", fontWeight: "600" }],
                        "headline-sm": ["16px", { lineHeight: "24px", fontWeight: "600" }],
                        "label-lg": ["14px", { lineHeight: "20px", fontWeight: "600" }],
                        "headline-md": ["20px", { lineHeight: "28px", fontWeight: "700" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "body-sm": ["12px", { lineHeight: "18px", fontWeight: "400" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-body-md text-on-surface antialiased">

{{-- SIDEBAR --}}
<aside class="fixed left-0 top-0 h-full w-72 bg-inverse-surface text-inverse-on-surface z-50 flex flex-col justify-between shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
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

        {{-- Profile Card --}}
        <div class="mx-margin my-space-sm p-space-md rounded-xl bg-on-background/40 flex items-center gap-space-md">
            <div class="w-10 h-10 rounded-full bg-primary flex-shrink-0 flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[20px]">person</span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-label-lg text-label-lg text-on-primary truncate">{{ Auth::user()->name }}</span>
                <span class="font-body-sm text-body-sm text-secondary-fixed-dim truncate">Siswa - {{ Auth::user()->borrower->kelas ?? 'Belum diisi' }}</span>
                <span class="font-label-sm text-label-sm text-secondary-fixed truncate">NISN: {{ Auth::user()->borrower->nisn ?? '-' }}</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-margin py-space-md flex flex-col gap-space-xs">
            <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-space-md px-space-lg py-space-md transition-all bg-primary-container text-on-primary-container font-bold rounded-lg shadow-sm">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('siswa.katalog') }}" class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg">
                <span class="material-symbols-outlined text-[20px]">menu_book</span>
                <span>Katalog Buku</span>
            </a>
            <a href="{{ route('siswa.riwayat') }}" class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg">
                <span class="material-symbols-outlined text-[20px]">history</span>
                <span>Riwayat Peminjaman</span>
            </a>
            <a href="{{ route('siswa.booking') }}" class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg">
                <span class="material-symbols-outlined text-[20px]">bookmark_added</span>
                <span>Booking / Reservasi</span>
            </a>
            <a href="{{ route('siswa.perpanjangan') }}" class="flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg">
                <span class="material-symbols-outlined text-[20px]">update</span>
                <span>Perpanjangan Buku</span>
            </a>
        </nav>
    </div>

    {{-- Logout --}}
    <div class="p-margin">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-space-md px-space-lg py-space-md rounded-lg text-error-container hover:bg-error/20 hover:text-on-error transition-all font-label-lg text-label-lg">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<div class="pl-72 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <header class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-margin-tablet">
        <div class="flex items-center gap-space-md">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">menu_book</span>
            </div>
            <span class="font-headline-sm text-headline-sm text-on-surface">LITERA</span>
        </div>
        <div class="flex items-center gap-space-lg">
            <div class="hidden sm:flex items-center gap-space-xs text-on-surface-variant font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
            <button class="w-9 h-9 rounded-full bg-surface-container-low flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors relative">
                <span class="material-symbols-outlined text-[20px]">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-error"></span>
            </button>
            <div class="flex items-center gap-space-sm pl-space-sm">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
                <div class="hidden lg:flex flex-col text-left">
                    <span class="font-label-md text-label-md text-on-surface leading-tight">{{ Auth::user()->name }}</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Siswa</span>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="relative pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
        <div class="flex flex-col w-full gap-space-xl">

            {{-- Alert sukses --}}
            @if (session('success'))
                <div class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- 1. Header Sapaan --}}
            <div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-xl shadow-sm">
                <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-gradient-to-br from-primary-container/10 via-surface-container/20 to-transparent blur-2xl pointer-events-none"></div>
                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
                    <div class="flex flex-col gap-space-xs max-w-2xl">
                        <span class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                            Halo, {{ explode(' ', Auth::user()->name)[0] }} 👋
                        </span>
                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                            Selamat datang kembali di LITERA. Cek status peminjaman buku dan temukan referensi belajar terbaru hari ini.
                        </p>
                    </div>
                    <div class="flex flex-col gap-space-xs bg-surface-container-low px-space-lg py-space-md rounded-xl">
                        <div class="flex items-center gap-space-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                            <span class="font-label-md text-label-md font-semibold text-on-surface">
                                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-space-sm">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm">
                                <span class="h-1.5 w-1.5 rounded-full bg-tertiary"></span>
                                Anggota Aktif
                            </span>
                            <span class="text-outline-variant font-label-sm">•</span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Kuota: <strong class="text-primary font-bold">0/5</strong> Buku</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Akses Cepat --}}
            <div class="flex flex-col gap-space-sm">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Akses Cepat</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
                    <a href="{{ route('siswa.katalog') }}" class="group relative flex items-center justify-between p-space-lg rounded-xl bg-primary-container text-on-primary shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden active:scale-[0.99]">
                        <div class="absolute right-0 top-0 translate-x-4 -translate-y-4 opacity-15 transition-transform group-hover:scale-110">
                            <span class="material-symbols-outlined text-[80px]">search</span>
                        </div>
                        <div class="flex items-center gap-space-md z-10">
                            <div class="w-11 h-11 rounded-lg bg-surface-container-lowest/20 backdrop-blur-md flex items-center justify-center text-on-primary">
                                <span class="material-symbols-outlined text-[24px]">search</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline-sm text-headline-sm text-on-primary">Cari Buku</span>
                                <span class="font-body-sm text-body-sm text-on-primary-container/80">Jelajahi katalog</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-primary z-10 transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>

                    <a href="{{ route('siswa.booking') }}" class="group flex items-center justify-between p-space-lg rounded-xl bg-surface-container-lowest text-on-surface shadow-sm hover:shadow-md hover:bg-surface-container-low transition-all duration-200 active:scale-[0.99]">
                        <div class="flex items-center gap-space-md">
                            <div class="w-11 h-11 rounded-lg bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[24px]">bookmark_add</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline-sm text-headline-sm text-on-surface">Booking Buku</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Reservasi koleksi</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline transition-transform group-hover:translate-x-1 group-hover:text-primary">arrow_forward</span>
                    </a>

                    <a href="{{ route('siswa.riwayat') }}" class="group flex items-center justify-between p-space-lg rounded-xl bg-surface-container-lowest text-on-surface shadow-sm hover:shadow-md hover:bg-surface-container-low transition-all duration-200 active:scale-[0.99]">
                        <div class="flex items-center gap-space-md">
                            <div class="w-11 h-11 rounded-lg bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                                <span class="material-symbols-outlined text-[24px]">history</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-headline-sm text-headline-sm text-on-surface">Riwayat</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Arsip peminjaman</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-outline transition-transform group-hover:translate-x-1 group-hover:text-primary">arrow_forward</span>
                    </a>
                </div>
            </div>

            {{-- 3. Kartu Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md">
                <div class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col gap-space-xs">
                            <span class="font-label-md text-label-md text-on-surface-variant">Buku Dipinjam</span>
                            <span class="font-headline-lg text-headline-lg font-bold text-on-surface">0</span>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-error-container/60 flex items-center justify-center text-error">
                            <span class="material-symbols-outlined text-[22px]">auto_stories</span>
                        </div>
                    </div>
                    <div class="mt-space-md flex items-center justify-between pt-space-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm">Dipinjam</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Batas maks. 5 buku</span>
                    </div>
                </div>

                <div class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col gap-space-xs">
                            <span class="font-label-md text-label-md text-on-surface-variant">Booking</span>
                            <span class="font-headline-lg text-headline-lg font-bold text-on-surface">0</span>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[22px]">bookmark_check</span>
                        </div>
                    </div>
                    <div class="mt-space-md flex items-center justify-between pt-space-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm">Tersedia</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Siap diambil</span>
                    </div>
                </div>

                <div class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col gap-space-xs">
                            <span class="font-label-md text-label-md text-on-surface-variant">Waiting List</span>
                            <span class="font-headline-lg text-headline-lg font-bold text-on-surface">0</span>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined text-[22px]">hourglass_top</span>
                        </div>
                    </div>
                    <div class="mt-space-md flex items-center justify-between pt-space-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-sm text-label-sm">Antrean</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Estimasi 2-4 hari</span>
                    </div>
                </div>

                <div class="flex flex-col justify-between p-space-lg rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col gap-space-xs">
                            <span class="font-label-md text-label-md text-on-surface-variant">Mendekati Tempo</span>
                            <span class="font-headline-lg text-headline-lg font-bold text-error">0</span>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-error-container flex items-center justify-center text-error">
                            <span class="material-symbols-outlined text-[22px]">event_upcoming</span>
                        </div>
                    </div>
                    <div class="mt-space-md flex items-center justify-between pt-space-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-bold">Peringatan</span>
                        <span class="font-body-sm text-body-sm text-error font-medium truncate">Tidak ada</span>
                    </div>
                </div>
            </div>

            {{-- 4. Area 2 Kolom --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">

                {{-- Kolom Kiri: Buku Dipinjam --}}
                <section class="lg:col-span-8 flex flex-col gap-space-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-primary text-[22px]">local_library</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface">Buku yang Sedang Dipinjam</h2>
                        </div>
                        <a href="{{ route('siswa.riwayat') }}" class="font-label-md text-label-md text-primary hover:text-on-primary-fixed-variant transition-colors flex items-center gap-1 font-semibold">
                            <span>Lihat Semua</span>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>

                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center mb-3">
                            <span class="material-symbols-outlined text-[32px] text-outline">auto_stories</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1">Belum ada buku dipinjam</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm mb-4">
                            Kamu belum meminjam buku apa pun. Yuk jelajahi katalog dan temukan buku favoritmu!
                        </p>
                        <a href="{{ route('siswa.katalog') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            <span>Jelajahi Katalog</span>
                        </a>
                    </div>
                </section>

                {{-- Kolom Kanan: Notifikasi --}}
                <aside class="lg:col-span-4 flex flex-col gap-space-md">
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-space-xs">
                                <span class="material-symbols-outlined text-primary text-[20px]">notifications_active</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Notifikasi</h3>
                                <span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm font-bold">0 Baru</span>
                            </div>
                        </div>

                        <div class="p-space-md rounded-xl bg-surface-container-lowest flex flex-col items-center py-6 text-center">
                            <span class="material-symbols-outlined text-[40px] text-outline mb-2">notifications_none</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Belum ada notifikasi baru</p>
                        </div>

                        <div class="p-space-md rounded-xl bg-surface-container-high/60 flex items-center gap-space-md">
                            <span class="material-symbols-outlined text-primary text-[24px]">support_agent</span>
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md font-semibold text-on-surface">Butuh bantuan?</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Hubungi petugas perpustakaan</span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
</div>

</body>
</html>