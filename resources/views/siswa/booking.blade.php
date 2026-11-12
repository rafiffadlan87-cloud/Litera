<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Booking / Reservasi - LITERA</title>
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

    @include('partials.siswa-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between pr-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Portal Siswa</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Booking / Reservasi</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
            </div>
        </header>

        <main class="relative pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full">

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

                {{-- Judul --}}
                <div class="flex items-center justify-between mb-space-md">
                    <div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface">Booking / Reservasi</h1>
                        <p class="font-body-md text-secondary mt-1">Reservasi khusus buku yang stoknya habis — kamu
                            diprioritaskan saat buku tersedia kembali.</p>
                    </div>
                    <span class="px-3 py-1.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-md">
                        {{ $bookings->where('status', 'aktif')->count() }} Booking Aktif
                    </span>
                </div>

                {{-- Cara kerja --}}
                <div class="p-space-md rounded-xl bg-primary-fixed/40 flex items-start gap-space-md mb-space-lg">
                    <div
                        class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                    </div>
                    <p class="font-body-sm text-on-surface-variant leading-relaxed">
                        <strong class="text-on-primary-fixed">Alur booking:</strong> klik "Booking / Reservasi" di
                        halaman detail buku stok habis → kamu diprioritaskan selama 14 hari → saat stok tersedia, klik
                        "Ambil Sekarang" untuk mengubahnya jadi peminjaman aktif, atau "Batalkan" kalau berubah pikiran.
                    </p>
                </div>

                {{-- Daftar Booking --}}
                @forelse($bookings as $b)
                    <div
                        class="p-space-lg bg-surface-container-lowest rounded-xl shadow-sm mb-space-md flex flex-col md:flex-row items-start md:items-center justify-between gap-space-lg">
                        <div class="flex items-start gap-space-md min-w-0">
                            <img class="w-16 h-24 object-cover rounded-md flex-shrink-0 shadow-sm"
                                src="{{ $b->book->cover && str_starts_with($b->book->cover, 'http') ? $b->book->cover : ($b->book->cover ? asset('storage/' . $b->book->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                alt="{{ $b->book->title }}" />
                            <div class="flex flex-col min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    @if ($b->status === 'aktif')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-amber-100 text-amber-900 font-bold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                            Menunggu Buku Tersedia
                                        </span>
                                    @elseif($b->status === 'diambil')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-tertiary-fixed text-on-tertiary-fixed font-bold">
                                            <span class="material-symbols-outlined text-[13px]">check_circle</span>
                                            Sudah Diambil
                                        </span>
                                    @elseif($b->status === 'kadaluarsa')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-error-container text-on-error-container font-bold">
                                            <span class="material-symbols-outlined text-[13px]">schedule</span>
                                            Kadaluarsa
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-surface-container text-outline font-bold">
                                            Dibatalkan
                                        </span>
                                    @endif
                                    <span
                                        class="font-label-sm text-label-sm text-secondary font-mono">{{ $b->code }}</span>
                                </div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface truncate">
                                    {{ $b->book->title }}</h3>
                                <p class="font-body-sm text-secondary">{{ $b->book->author }}</p>
                                <div
                                    class="flex items-center gap-space-lg mt-2 text-on-surface-variant font-body-sm flex-wrap">
                                    <span class="flex items-center gap-1">
                                        <span class="text-outline text-label-sm">Dibooking:</span>
                                        <span
                                            class="font-medium text-on-surface">{{ $b->created_at->format('d M Y') }}</span>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="text-outline text-label-sm">Berlaku sampai:</span>
                                        <span
                                            class="font-bold {{ $b->status === 'aktif' ? 'text-tertiary' : 'text-on-surface' }}">{{ $b->pickup_deadline->format('d M Y') }}</span>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span
                                            class="material-symbols-outlined text-[15px] text-outline">inventory_2</span>
                                        <span>Stok saat ini: {{ $b->book->stock }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if ($b->status === 'aktif')
                            <div class="flex items-center gap-space-sm w-full md:w-auto justify-end flex-shrink-0">
                                <form method="POST" action="{{ route('siswa.booking.batal', $b->id) }}"
                                    onsubmit="return confirm('Batalkan booking {{ $b->code }}?');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 rounded-lg text-error hover:bg-error-container/40 font-label-md transition-colors">
                                        Batalkan
                                    </button>
                                </form>
                                @if ($b->book->stock > 0)
                                    <form method="POST" action="{{ route('siswa.booking.ambil', $b->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-md shadow-sm transition-all">
                                            <span
                                                class="material-symbols-outlined text-[16px]">confirmation_number</span>
                                            Ambil Sekarang
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-container-low text-outline cursor-not-allowed font-label-md">
                                        <span class="material-symbols-outlined text-[16px]">hourglass_top</span>
                                        Menunggu Buku Kembali
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-surface-container-lowest rounded-xl p-12 shadow-sm text-center">
                        <div
                            class="w-20 h-20 rounded-full bg-surface-container-low flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-[40px] text-outline">bookmark</span>
                        </div>
                        <h3 class="font-headline-md text-on-surface">Belum Ada Booking</h3>
                        <p class="font-body-md text-secondary mt-2 max-w-md mx-auto">
                            Reservasi buku favorit yang stoknya habis lewat tombol "Booking / Reservasi" di halaman
                            detail buku.
                        </p>
                        <a href="{{ route('siswa.katalog') }}"
                            class="inline-flex items-center gap-2 mt-4 px-6 py-2.5 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg shadow-sm transition-all">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            <span>Jelajahi Katalog</span>
                        </a>
                    </div>
                @endforelse

            </div>
        </main>
    </div>
</body>

</html>
