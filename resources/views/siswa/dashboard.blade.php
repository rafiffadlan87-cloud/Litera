<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Siswa - LITERA</title>
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
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3",
                        "inverse-surface": "#213145",
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
                        surface: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        secondary: "#545f73",
                        "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655",
                        "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a",
                        "surface-container-high": "#dce9ff",
                        "on-surface": "#0b1c30",
                        primary: "#004ac6",
                        "on-error-container": "#93000a",
                        outline: "#737686"
                    },
                    spacing: {
                        "margin-tablet": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-xl": "1.5rem",
                        "space-sm": "0.5rem",
                        "space-md": "0.75rem",
                        margin: "1rem",
                        "space-lg": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
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

    {{-- SIDEBAR SERAGAM (ikon + aktif otomatis) --}}
    @include('partials.siswa-sidebar')

    {{-- MAIN --}}
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Portal Siswa</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Dashboard</span>
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

                {{-- Kartu Sapaan --}}
                <div
                    class="bg-primary-container rounded-2xl p-space-xl text-on-primary mb-space-lg flex flex-col md:flex-row md:items-center justify-between gap-space-md shadow-sm">
                    <div class="flex flex-col gap-space-xs">
                        <span class="font-label-sm text-on-primary/80 uppercase tracking-wider">Portal Siswa — Smart
                            Library</span>
                        <h1 class="font-headline-lg text-headline-lg leading-tight">Halo, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="font-body-md text-on-primary/80 max-w-xl">
                            Kuota peminjamanmu saat ini: <strong class="text-on-primary">{{ $dipinjam }} dari 5
                                buku aktif</strong>.
                            Yuk jelajahi koleksi terbaru perpustakaan kita!
                        </p>
                    </div>
                    <a href="{{ route('siswa.katalog') }}"
                        class="inline-flex items-center justify-center gap-space-sm px-5 py-3 bg-surface-container-lowest text-primary rounded-xl font-label-lg font-bold shadow-sm hover:brightness-95 active:scale-95 transition-all w-fit">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                        <span>Jelajahi Katalog</span>
                    </a>
                </div>

                {{-- 4 Kartu Statistik Dinamis --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md mb-space-lg">
                    <div
                        class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Buku Dipinjam</span>
                            <div
                                class="w-10 h-10 rounded-lg bg-error-container/40 flex items-center justify-center text-error">
                                <span class="material-symbols-outlined text-[22px]">menu_book</span>
                            </div>
                        </div>
                        <span class="font-headline-lg text-headline-lg text-on-surface mt-2">{{ $dipinjam }}</span>
                        <div class="flex items-center justify-between mt-3">
                            <span
                                class="px-2.5 py-1 rounded-full bg-error-container/60 text-error font-label-sm">Dipinjam</span>
                            <span class="font-body-sm text-outline">{{ $dipinjam }} dari maks. 5 buku</span>
                        </div>
                    </div>

                    <div
                        class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Booking</span>
                            <div
                                class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">bookmark</span>
                            </div>
                        </div>
                        <span class="font-headline-lg text-headline-lg text-on-surface mt-2">{{ $booking }}</span>
                        <div class="flex items-center justify-between mt-3">
                            <span
                                class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm">Tersedia</span>
                            <span class="font-body-sm text-outline">Siap diambil</span>
                        </div>
                    </div>

                    <div
                        class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Waiting List</span>
                            <div
                                class="w-10 h-10 rounded-lg bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                                <span class="material-symbols-outlined text-[22px]">hourglass_top</span>
                            </div>
                        </div>
                        <span class="font-headline-lg text-headline-lg text-on-surface mt-2">{{ $waitingList }}</span>
                        <div class="flex items-center justify-between mt-3">
                            <span
                                class="px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm">Antrean</span>
                            <span class="font-body-sm text-outline">Estimasi 2–4 hari</span>
                        </div>
                    </div>

                    <div
                        class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Mendekati Tempo</span>
                            <div
                                class="w-10 h-10 rounded-lg bg-error-container/40 flex items-center justify-center text-error">
                                <span class="material-symbols-outlined text-[22px]">event_busy</span>
                            </div>
                        </div>
                        <span class="font-headline-lg text-headline-lg text-error mt-2">{{ $mendekatiTempo }}</span>
                        <div class="flex items-center justify-between mt-3">
                            <span
                                class="px-2.5 py-1 rounded-full bg-error-container/60 text-error font-label-sm">Peringatan</span>
                            <span
                                class="font-body-sm {{ $mendekatiTempo > 0 ? 'text-error font-bold' : 'text-outline' }}">
                                {{ $mendekatiTempo > 0 ? 'Segera kembalikan!' : 'Tidak ada' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Konten 2 Kolom --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">

                    {{-- Kiri: Buku Sedang Dipinjam --}}
                    <section class="lg:col-span-2 flex flex-col gap-space-md">
                        <div class="flex items-center justify-between">
                            <h2 class="font-headline-md text-headline-md text-on-surface">Buku yang Sedang Dipinjam
                            </h2>
                            <a href="{{ route('siswa.riwayat') }}"
                                class="text-primary font-label-md hover:underline">Lihat Semua</a>
                        </div>

                        @forelse($activeBorrowings as $b)
                            @php
                                $daysLeft = \Carbon\Carbon::now()->diffInDays($b->due_date, false);
                            @endphp
                            <div
                                class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-md">
                                <div class="flex items-center gap-space-md min-w-0">
                                    <img class="w-12 h-16 object-cover rounded-md shadow-sm"
                                        src="{{ $b->book->cover && str_starts_with($b->book->cover, 'http') ? $b->book->cover : ($b->book->cover ? asset('storage/' . $b->book->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                        alt="{{ $b->book->title }}" />
                                    <div class="flex flex-col gap-0.5 min-w-0">
                                        <h3 class="font-headline-sm text-on-surface truncate">{{ $b->book->title }}
                                        </h3>
                                        <p class="font-body-sm text-secondary">{{ $b->book->author }}</p>
                                        <p class="font-label-sm text-outline">
                                            Pinjam: {{ $b->borrow_date->format('d M Y') }} • Tempo: <strong
                                                class="text-on-surface">{{ $b->due_date->format('d M Y') }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-space-sm w-full sm:w-auto justify-end">
                                    @if ($daysLeft < 0)
                                        <span
                                            class="px-3 py-1 rounded-full bg-error-container text-error font-label-sm font-bold">Terlambat
                                            {{ abs($daysLeft) }} hari</span>
                                    @elseif($daysLeft <= 3)
                                        <span
                                            class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 font-label-sm font-bold">Sisa
                                            {{ $daysLeft }} hari</span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold">Sisa
                                            {{ $daysLeft }} hari</span>
                                    @endif
                                    <a href="{{ route('siswa.detail', $b->book->id) }}"
                                        class="px-3 py-1.5 rounded-lg bg-surface-container-low text-primary font-label-md hover:bg-surface-container">Detail</a>
                                </div>
                            </div>
                        @empty
                            <div class="bg-surface-container-lowest rounded-xl p-10 shadow-sm text-center">
                                <div
                                    class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center mx-auto mb-3">
                                    <span class="material-symbols-outlined text-[32px] text-outline">menu_book</span>
                                </div>
                                <h3 class="font-headline-sm text-on-surface">Belum Ada Buku Dipinjam</h3>
                                <p class="font-body-sm text-secondary mt-1">Mulai jelajahi katalog dan pinjam buku
                                    pertamamu!</p>
                                <a href="{{ route('siswa.katalog') }}"
                                    class="inline-flex items-center gap-1.5 mt-4 px-4 py-2 bg-primary-container text-on-primary rounded-lg font-label-md shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">search</span>
                                    <span>Cari Buku</span>
                                </a>
                            </div>
                        @endforelse
                    </section>

                    {{-- Kanan: Rekomendasi + Kebijakan --}}
                    <aside class="flex flex-col gap-space-md">
                        <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm">
                            <h3 class="font-headline-sm text-on-surface mb-space-md flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">auto_stories</span>
                                <span>Rekomendasi Untukmu</span>
                            </h3>
                            <div class="flex flex-col gap-space-md">
                                @foreach ($recommendedBooks as $rb)
                                    <a href="{{ route('siswa.detail', $rb->id) }}"
                                        class="flex items-center gap-space-md group">
                                        <img class="w-10 h-14 object-cover rounded-md shadow-sm"
                                            src="{{ $rb->cover && str_starts_with($rb->cover, 'http') ? $rb->cover : ($rb->cover ? asset('storage/' . $rb->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                            alt="{{ $rb->title }}" />
                                        <div class="flex flex-col min-w-0">
                                            <span
                                                class="font-label-md text-on-surface truncate group-hover:text-primary">{{ $rb->title }}</span>
                                            <span class="font-label-sm text-outline flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[13px] text-amber-500"
                                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                                {{ number_format($rb->rating, 1) }} • {{ $rb->category->name ?? '-' }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-space-md rounded-xl bg-primary-fixed/40 flex items-start gap-space-md">
                            <div
                                class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[18px]">info</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="font-label-md text-on-primary-fixed font-bold">Kebijakan Peminjaman</span>
                                <span class="font-body-sm text-on-surface-variant leading-relaxed">
                                    Durasi pinjam 7 hari • Perpanjangan maksimal 1x • Denda otomatis berlaku untuk
                                    keterlambatan • Kuota 5 buku aktif.
                                </span>
                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
