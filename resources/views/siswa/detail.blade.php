<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $book->title }} - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary-fixed-dim": "#b4c5ff", "primary-container": "#2563eb", background: "#f8f9ff",
                        "surface-container-low": "#eff4ff", "on-primary": "#ffffff", "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3", "inverse-surface": "#213145", "surface-bright": "#f8f9ff",
                        "surface-container-lowest": "#ffffff", tertiary: "#006242", "error-container": "#ffdad6",
                        "secondary-fixed": "#d8e3fb", "tertiary-fixed": "#6ffbbe", "on-background": "#0b1c30",
                        "on-primary-fixed": "#00174b", "inverse-primary": "#b4c5ff", "secondary-container": "#d5e0f8",
                        "outline-variant": "#c3c6d7", surface: "#f8f9ff", "inverse-on-surface": "#eaf1ff",
                        secondary: "#545f73", "on-secondary": "#ffffff", "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#bcc7de", "on-surface-variant": "#434655", "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe", "surface-container-highest": "#d3e4fe", error: "#ba1a1a",
                        "surface-container-high": "#dce9ff", "on-primary-container": "#eeefff", "on-surface": "#0b1c30",
                        primary: "#004ac6", "on-error-container": "#93000a", outline: "#737686", "on-error": "#ffffff"
                    },
                    spacing: {
                        "gutter-sm": "0.75rem", "margin-tablet": "1.5rem", gutter: "1rem", "space-xs": "0.25rem",
                        "space-xl": "1.5rem", "space-sm": "0.5rem", "space-md": "0.75rem", margin: "1rem", "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"], "headline-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"], "label-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"], "body-lg": ["Plus Jakarta Sans"], "body-sm": ["Plus Jakarta Sans"]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background font-body-md text-on-surface antialiased">

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
            </div>
        </div>
        <nav class="flex-1 px-margin py-space-md flex flex-col gap-space-xs">
            <a href="{{ route('siswa.dashboard') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Dashboard</a>
            <a href="{{ route('siswa.katalog') }}" class="px-space-lg py-space-md transition-all block bg-primary-container text-on-primary font-bold rounded-lg shadow-sm">Katalog Buku</a>
            <a href="{{ route('siswa.riwayat') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Riwayat Peminjaman</a>
            <a href="{{ route('siswa.booking') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Booking / Reservasi</a>
            <a href="{{ route('siswa.perpanjangan') }}" class="px-space-lg py-space-md rounded-lg text-secondary-fixed-dim hover:bg-on-background/30 hover:text-on-primary transition-all font-label-lg text-label-lg block">Perpanjangan Buku</a>
        </nav>
    </div>
    <div class="p-margin">
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" class="w-full px-space-lg py-space-md rounded-lg text-error-container hover:bg-error/20 hover:text-on-error transition-all font-label-lg text-label-lg block text-left">Keluar</button>
        </form>
    </div>
</aside>

<div class="pl-72 flex flex-col min-h-screen">
    <header class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
        <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
            <a href="{{ route('siswa.katalog') }}" class="text-secondary hover:text-primary">Katalog</a>
            <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
            <span class="text-primary font-bold truncate max-w-xs">{{ $book->title }}</span>
        </div>
        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
        </div>
    </header>

    <main class="relative pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
        <div class="flex flex-col w-full">
            <a href="{{ route('siswa.katalog') }}" class="inline-flex items-center gap-1 text-primary font-label-md hover:underline mb-space-md w-fit">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Katalog</span>
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl">
                {{-- Kolom Kiri: Cover --}}
                <div class="lg:col-span-4">
                    <div class="sticky top-20 bg-surface-container-lowest rounded-xl shadow-sm p-space-lg">
                        <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container shadow-inner mb-space-md">
                            <img class="w-full h-full object-cover" src="{{ $book->cover ?? 'https://via.placeholder.com/300x400?text=No+Cover' }}" alt="{{ $book->title }}"/>
                        </div>

                        {{-- Status Stok --}}
                        <div class="mb-space-md">
                            @if($book->stock > 0)
                                <div class="p-3 rounded-lg bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    <div>
                                        <div class="font-label-md font-bold">Tersedia ({{ $book->stock }} Eksemplar)</div>
                                        <div class="font-body-sm">Siap dipinjam di {{ $book->rack ?? 'Meja Sirkulasi' }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="p-3 rounded-lg bg-secondary-fixed text-on-secondary-fixed-variant flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                                    <div>
                                        <div class="font-label-md font-bold">Stok Habis</div>
                                        <div class="font-body-sm">Masuk ke waiting list</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col gap-space-sm">
                            @if($isBorrowed)
                                <button disabled class="w-full py-3 px-4 bg-surface-container-high text-on-surface-variant rounded-lg font-label-lg font-bold flex items-center justify-center gap-2 cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[20px]">menu_book</span>
                                    <span>Sedang Anda Pinjam</span>
                                </button>
                            @elseif($book->stock > 0)
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="w-full py-3 px-4 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg font-bold flex items-center justify-center gap-2 shadow-sm active:scale-95 transition-all">
                                        <span class="material-symbols-outlined text-[20px]">bookmark_add</span>
                                        <span>Pinjam Buku Sekarang</span>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="w-full py-3 px-4 bg-secondary-container hover:bg-secondary-fixed text-on-secondary-fixed rounded-lg font-label-lg font-bold flex items-center justify-center gap-2 active:scale-95 transition-all">
                                        <span class="material-symbols-outlined text-[20px]">group_add</span>
                                        <span>Masuk Antrean</span>
                                    </button>
                                </form>
                            @endif

                            <button class="w-full py-3 px-4 bg-surface-container-low hover:bg-surface-container text-on-surface-variant rounded-lg font-label-md flex items-center justify-center gap-2 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">favorite</span>
                                <span>Simpan ke Favorit</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Info --}}
                <div class="lg:col-span-8 flex flex-col gap-space-md">
                    <div class="bg-surface-container-lowest rounded-xl p-space-xl shadow-sm">
                        <div class="flex items-center gap-space-sm mb-space-md">
                            <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary font-label-sm font-bold">
                                {{ $book->category->name ?? 'Tanpa Kategori' }}
                            </span>
                            <span class="flex items-center gap-1 text-amber-500 font-label-md">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-bold">{{ number_format($book->rating, 1) }}</span>
                                <span class="text-secondary">({{ $book->rating_count }} ulasan)</span>
                            </span>
                        </div>

                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-space-xs">{{ $book->title }}</h1>
                        <p class="font-body-lg text-secondary mb-space-md">oleh <strong class="text-on-surface">{{ $book->author }}</strong></p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-space-md mb-space-lg">
                            <div class="p-3 rounded-lg bg-surface-container-low">
                                <div class="font-label-sm text-secondary uppercase tracking-wider">Tahun</div>
                                <div class="font-headline-sm text-on-surface font-bold">{{ $book->year ?? '-' }}</div>
                            </div>
                            <div class="p-3 rounded-lg bg-surface-container-low">
                                <div class="font-label-sm text-secondary uppercase tracking-wider">ISBN</div>
                                <div class="font-headline-sm text-on-surface font-bold">{{ $book->isbn ?? '-' }}</div>
                            </div>
                            <div class="p-3 rounded-lg bg-surface-container-low">
                                <div class="font-label-sm text-secondary uppercase tracking-wider">Penerbit</div>
                                <div class="font-headline-sm text-on-surface font-bold truncate">{{ $book->publisher ?? '-' }}</div>
                            </div>
                            <div class="p-3 rounded-lg bg-surface-container-low">
                                <div class="font-label-sm text-secondary uppercase tracking-wider">Lokasi Rak</div>
                                <div class="font-headline-sm text-on-surface font-bold">{{ $book->rack ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="border-t border-outline-variant pt-space-lg">
                            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-space-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">description</span>
                                <span>Deskripsi Buku</span>
                            </h3>
                            <p class="font-body-md text-on-surface-variant leading-relaxed whitespace-pre-line">
                                {{ $book->description ?? 'Belum ada deskripsi untuk buku ini. Silakan hubungi petugas perpustakaan untuk informasi lebih lanjut.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>