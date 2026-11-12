<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $book->title }} - LITERA</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary-fixed-dim": "#b4c5ff",
                        "primary-container": "#2563eb",
                        background: "#f8f9ff",
                        "surface-container-low": "#eff4ff",
                        "on-primary-fixed-variant": "#003ea8",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-secondary-fixed": "#111c2d",
                        "inverse-surface": "#213145",
                        "surface-bright": "#f8f9ff",
                        "surface-container-lowest": "#ffffff",
                        tertiary: "#006242",
                        "error-container": "#ffdad6",
                        "secondary-fixed": "#d8e3fb",
                        "tertiary-fixed": "#6ffbbe",
                        "on-background": "#0b1c30",
                        "on-primary-fixed": "#00174b",
                        "inverse-primary": "#b4c5ff",
                        "secondary-container": "#d5e0f8",
                        "outline-variant": "#c3c6d7",
                        "surface-tint": "#0053db",
                        surface: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        secondary: "#545f73",
                        "on-secondary": "#ffffff",
                        "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655",
                        "on-secondary-fixed-variant": "#3c475a",
                        "surface-dim": "#cbdbf5",
                        "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a",
                        "surface-container-high": "#dce9ff",
                        "on-primary-container": "#eeefff",
                        "on-surface": "#0b1c30",
                        "on-tertiary-fixed": "#002113",
                        primary: "#004ac6",
                        "on-tertiary-container": "#bdffdb",
                        "on-error-container": "#93000a",
                        outline: "#737686",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#586377",
                        "on-error": "#ffffff"
                    },
                    spacing: {
                        "gutter-sm": "0.75rem",
                        "margin-tablet": "1.5rem",
                        gutter: "1rem",
                        "space-xs": "0.25rem",
                        "space-xl": "1.5rem",
                        "space-sm": "0.5rem",
                        "space-md": "0.75rem",
                        margin: "1rem",
                        "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-lg": ["Fraunces", "serif"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "headline-sm": ["Fraunces", "serif"],
                        "label-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Fraunces", "serif"],
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
    @include('partials.siswa-sidebar')

    {{-- MAIN --}}
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
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
            <div class="flex flex-col w-full relative">

                {{-- Alert --}}
                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2 mb-4">
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

                {{-- Tombol Kembali --}}
                <a href="{{ route('siswa.katalog') }}"
                    class="inline-flex items-center gap-1 text-primary font-label-md hover:underline mb-space-md w-fit">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Kembali ke Katalog</span>
                </a>

                {{-- Modal Card (sebagai container utama) --}}
                <div
                    class="relative w-full bg-surface-container-lowest rounded-2xl shadow-2xl overflow-hidden flex flex-col">

                    {{-- Top Modal Header Bar --}}
                    <div
                        class="flex items-center justify-between px-margin-tablet py-space-md bg-surface-container-lowest">
                        <div class="flex items-center gap-space-xs font-label-md text-label-md text-on-surface-variant">
                            <span class="material-symbols-outlined text-[18px] text-primary">local_library</span>
                            <span class="text-on-surface font-semibold">Detail Koleksi Pustaka</span>
                            <span class="text-outline mx-space-xs">•</span>
                            <span
                                class="inline-flex items-center gap-1 text-secondary bg-surface-container-low px-space-sm py-0.5 rounded text-[11px] font-mono tracking-wide">{{ $book->rack ?? 'Belum Dialokasikan' }}</span>
                        </div>
                    </div>

                    {{-- Modal Main Body: 2-Column Split --}}
                    <div class="p-margin-tablet flex flex-col md:flex-row gap-space-xl bg-surface-container-lowest">

                        {{-- Left Column: Visual & Quick Specs --}}
                        <div class="w-full md:w-[310px] flex-shrink-0 flex flex-col gap-space-md">
                            {{-- Book Cover --}}
                            <div
                                class="relative w-full aspect-[3/4.2] rounded-xl overflow-hidden bg-surface-container shadow-[0_12px_28px_-6px_rgba(11,28,48,0.18)] flex items-center justify-center group">
                                <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    src="{{ $book->cover && str_starts_with($book->cover, 'http') ? $book->cover : ($book->cover ? asset('storage/' . $book->cover) : 'https://via.placeholder.com/300x420?text=No+Cover') }}"
                                    alt="{{ $book->title }}" />
                                <div
                                    class="absolute inset-y-0 left-0 w-3.5 bg-gradient-to-r from-black/25 via-black/5 to-transparent pointer-events-none">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-white/20 pointer-events-none">
                                </div>
                            </div>

                            {{-- Social Rating Badge --}}
                            <div
                                class="flex items-center justify-between px-space-md py-space-sm bg-surface-container-low rounded-xl">
                                <div class="flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-amber-500 text-[20px]"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span
                                        class="font-headline-sm text-headline-sm text-on-surface">{{ number_format($book->rating, 1) }}</span>
                                    <span class="font-body-sm text-body-sm text-secondary">({{ $book->rating_count }}
                                        ulasan)</span>
                                </div>
                                @if ($book->rating_count > 100)
                                    <span
                                        class="font-label-sm text-label-sm text-primary bg-primary-fixed/50 px-space-sm py-0.5 rounded-full">Koleksi
                                        Terlaris</span>
                                @endif
                            </div>

                            {{-- Physical Location --}}
                            <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-space-xs">
                                <div
                                    class="flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[16px]">pin_drop</span>
                                    <span>Lokasi Rak Fisik</span>
                                </div>
                                <p class="font-headline-sm text-headline-sm text-on-surface leading-snug">Gedung
                                    Perpustakaan Pusat</p>
                                <p class="font-body-sm text-body-sm text-secondary leading-tight">
                                    Lantai 2, <strong class="text-on-surface">{{ $book->rack ?? '-' }}</strong>
                                    <span
                                        class="text-on-surface-variant font-medium">({{ $book->category->name ?? '-' }})</span>
                                </p>
                            </div>

                            {{-- Available Formats --}}
                            <div class="flex flex-col gap-space-xs">
                                <span class="font-label-sm text-label-sm text-secondary">Format Koleksi:</span>
                                <div class="flex flex-wrap gap-space-xs">
                                    <div
                                        class="flex items-center gap-1.5 px-space-sm py-1 bg-surface-container rounded-lg font-label-md text-label-md text-on-surface">
                                        <span
                                            class="material-symbols-outlined text-primary text-[16px]">menu_book</span>
                                        <span>Buku Fisik ({{ $book->stock }} Eksemplar)</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-1.5 px-space-sm py-1 bg-surface-container rounded-lg font-label-md text-label-md text-on-surface opacity-50">
                                        <span class="material-symbols-outlined text-tertiary text-[16px]">devices</span>
                                        <span>E-Book (Segera)</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Kuota Siswa Info --}}
                            <div
                                class="text-center font-label-sm text-label-sm text-secondary p-space-sm bg-surface-container-low rounded-lg">
                                Kuota peminjaman kamu: <strong class="text-primary">{{ $quotaAktif }}/5</strong>
                                buku
                            </div>

                            {{-- Favorite Button (dummy visual only) --}}
                            <button
                                class="w-full py-space-sm px-space-md rounded-xl bg-surface-container-low hover:bg-surface-container text-on-surface font-label-lg text-label-lg flex items-center justify-center gap-space-sm transition-colors"
                                id="favorite-toggle-btn">
                                <span class="material-symbols-outlined text-[20px] text-secondary"
                                    id="favorite-icon">favorite_border</span>
                                <span id="favorite-text">Tambah ke Favorit</span>
                            </button>
                        </div>

                        {{-- Right Column: Metadata, Synopsis & Actions --}}
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                {{-- Status & Category --}}
                                <div class="flex items-center justify-between flex-wrap gap-space-sm mb-space-sm">
                                    <span
                                        class="px-space-md py-1 bg-primary-fixed text-on-primary-fixed font-label-sm text-label-sm rounded-full tracking-wide">
                                        {{ $book->category->name ?? 'Tanpa Kategori' }}
                                    </span>

                                    @if ($book->stock > 0)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-space-md py-1 bg-[#ECFDF5] text-[#059669] font-label-sm text-label-sm rounded-full font-bold">
                                            <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                                            Tersedia ({{ $book->stock }} Eksemplar)
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-space-md py-1 bg-error-container text-error font-label-sm text-label-sm rounded-full font-bold">
                                            <span class="w-2 h-2 rounded-full bg-error"></span>
                                            Stok Habis
                                        </span>
                                    @endif
                                </div>

                                {{-- Title & Author --}}
                                <h1
                                    class="font-headline-lg text-headline-lg text-on-surface leading-tight tracking-tight mb-space-xs">
                                    {{ $book->title }}
                                </h1>
                                <p class="font-body-lg text-body-lg text-secondary font-normal mb-space-sm">
                                    oleh <strong class="text-primary">{{ $book->author }}</strong>
                                </p>

                                {{-- Metadata Grid --}}
                                <div
                                    class="grid grid-cols-2 sm:grid-cols-3 gap-space-sm p-space-md bg-surface-container-low rounded-xl mb-space-lg">
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">Penerbit</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface truncate">{{ $book->publisher ?? '-' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">Tahun Terbit</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface">{{ $book->year ?? '-' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">ISBN</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-mono">{{ $book->isbn ?? '-' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">Kategori</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface">{{ $book->category->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">Lokasi Rak</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface">{{ $book->rack ?? '-' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-sm text-label-sm text-secondary">Stok Tersedia</span>
                                        <span
                                            class="font-label-md text-label-md text-tertiary font-bold">{{ $book->stock }}
                                            Eksemplar</span>
                                    </div>
                                </div>

                                {{-- Synopsis --}}
                                <div class="flex flex-col gap-space-xs mb-space-lg">
                                    <span class="font-headline-sm text-headline-sm text-on-surface">Sinopsis
                                        Buku</span>
                                    <p
                                        class="font-body-md text-body-md text-on-surface-variant leading-relaxed text-justify">
                                        {{ $book->description ?? 'Belum ada deskripsi untuk buku ini. Silakan hubungi petugas perpustakaan untuk informasi lebih lanjut.' }}
                                    </p>
                                </div>

                                {{-- Loan Policy --}}
                                <div
                                    class="p-space-md rounded-xl bg-primary-fixed/40 flex items-center gap-space-md mb-space-lg">
                                    <div
                                        class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-[18px]">info</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span
                                            class="font-label-md text-label-md text-on-primary-fixed font-bold leading-snug">Kebijakan
                                            Masa Peminjaman Siswa</span>
                                        <span class="font-body-sm text-body-sm text-on-surface-variant leading-tight">
                                            Batas peminjaman standar 7 hari. Bebas denda jika diperpanjang sebelum jatuh
                                            tempo (maksimal 1x perpanjangan). Kuota 5 buku aktif per siswa.
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-space-sm pt-space-xs">
                                <div class="flex flex-col sm:flex-row items-center gap-space-md">

                                    @if ($isBorrowed)
                                        <button disabled
                                            class="w-full py-space-md px-space-lg rounded-xl bg-surface-container-high text-on-surface-variant font-label-lg text-label-lg shadow-sm cursor-not-allowed flex items-center justify-center gap-space-sm">
                                            <span class="material-symbols-outlined text-[20px]">menu_book</span>
                                            <span>Sedang Anda Pinjam</span>
                                        </button>
                                        <a href="{{ route('siswa.riwayat', ['tab' => 'dipinjam']) }}"
                                            class="w-full py-space-md px-space-lg rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg shadow-md transition-all flex items-center justify-center gap-space-sm active:scale-95">
                                            <span class="material-symbols-outlined text-[20px]">history</span>
                                            <span>Lihat di Riwayat</span>
                                        </a>
                                    @elseif($book->stock > 0)
                                        {{-- Stok tersedia: hanya bisa pinjam langsung, booking DITOLAK --}}
                                        <form method="POST" action="{{ route('siswa.pinjam', $book->id) }}"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full py-space-md px-space-lg rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-space-sm active:scale-95">
                                                <span
                                                    class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                                                <span>Pinjam Sekarang</span>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Stok HABIS: booking prioritas + waiting list --}}
                                        <form method="POST" action="{{ route('siswa.booking.store', $book->id) }}"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full py-space-md px-space-lg rounded-xl bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-space-sm active:scale-95">
                                                <span
                                                    class="material-symbols-outlined text-[20px]">event_upcoming</span>
                                                <span>Booking / Reservasi</span>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('siswa.antre', $book->id) }}"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full py-space-md px-space-lg rounded-xl bg-surface-container-lowest text-primary-container font-label-lg text-label-lg shadow-sm hover:bg-surface-container-low transition-all flex items-center justify-center gap-space-sm active:scale-95">
                                                <span class="material-symbols-outlined text-[20px]">group_add</span>
                                                <span>Masuk Waiting List</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <script>
                                // Toggle Favorite (visual only, belum disimpan ke DB)
                                const favBtn = document.getElementById('favorite-toggle-btn');
                                const favIcon = document.getElementById('favorite-icon');
                                const favText = document.getElementById('favorite-text');
                                let isFav = false;

                                if (favBtn) {
                                    favBtn.addEventListener('click', function() {
                                        isFav = !isFav;
                                        if (isFav) {
                                            favIcon.textContent = 'favorite';
                                            favIcon.classList.remove('text-secondary');
                                            favIcon.classList.add('text-error');
                                            favText.textContent = 'Tersimpan di Favorit';
                                        } else {
                                            favIcon.textContent = 'favorite_border';
                                            favIcon.classList.remove('text-error');
                                            favIcon.classList.add('text-secondary');
                                            favText.textContent = 'Tambah ke Favorit';
                                        }
                                    });
                                }
                            </script>

</body>

</html>
