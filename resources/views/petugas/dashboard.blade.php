<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Petugas - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
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

    @include('partials.petugas-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between gap-space-md pr-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md shrink-0">
                <span class="text-secondary hidden sm:inline">Portal Petugas</span>
                <span class="material-symbols-outlined text-[16px] text-outline hidden sm:inline">chevron_right</span>
                <span class="text-primary font-bold">Dashboard</span>
            </div>
            <div class="flex items-center gap-space-md shrink-0">
                <div class="hidden lg:flex items-center gap-space-xs text-on-surface-variant font-label-md">
                    <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
                    <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <a href="{{ route('petugas.circulation') }}"
                    class="relative w-10 h-10 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors"
                    title="Peminjaman terlambat">
                    <span class="material-symbols-outlined text-[22px]">notifications</span>
                    @if ($stats['terlambat'] > 0)
                        <span
                            class="absolute top-1.5 right-1.5 w-2.5 h-2.5 rounded-full bg-error ring-2 ring-surface-container-lowest"></span>
                    @endif
                </a>
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

                {{-- Hero --}}
                <div
                    class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-xl flex flex-col lg:flex-row lg:items-center justify-between gap-space-lg">
                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-md flex-wrap">
                            <h1 class="font-headline-lg text-headline-lg text-on-surface">Selamat Bertugas,
                                {{ Auth::user()->name }} 👋</h1>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span> Loket Buka
                            </span>
                        </div>
                        <p class="font-body-md text-on-surface-variant">
                            Ringkasan layanan sirkulasi hari ini,
                            <strong class="text-on-surface">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>.
                        </p>
                    </div>
                    <div class="flex items-center gap-space-md flex-wrap shrink-0">
                        <a href="{{ route('petugas.circulation') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary-container text-on-primary font-label-lg font-bold shadow-md hover:bg-primary transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[20px]">sync_alt</span>
                            <span>Buka Meja Sirkulasi</span>
                        </a>
                    </div>
                </div>

                {{-- 4 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Peminjaman Aktif</span>
                            <div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">menu_book</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['aktif'] }} <span class="font-headline-sm font-normal text-outline">Buku</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="inline-flex items-center gap-1 text-tertiary"><span
                                    class="material-symbols-outlined text-[15px]">event_note</span>
                                {{ $stats['pinjam_hari_ini'] }} pinjam hari ini</span>
                            <span class="text-outline">Belum kembali</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Jatuh Tempo & Terlambat</span>
                            <div class="w-10 h-10 rounded-xl bg-error-container/50 flex items-center justify-center text-error">
                                <span class="material-symbols-outlined text-[22px]">schedule</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['tempo_dekat'] }} <span class="font-headline-sm font-normal text-outline">Buku</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="inline-flex items-center gap-1 text-error font-bold"><span
                                    class="material-symbols-outlined text-[15px]">warning</span>
                                {{ $stats['terlambat'] }} terlambat</span>
                            <span class="text-outline">≤ 3 hari ke depan</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Pesanan Pengambilan</span>
                            <div class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                                <span class="material-symbols-outlined text-[22px]">bookmark_add</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['pesanan'] }} <span class="font-headline-sm font-normal text-outline">Pesanan</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="inline-flex items-center gap-1 text-tertiary"><span
                                    class="material-symbols-outlined text-[15px]">today</span>
                                {{ $stats['pesanan_hari_ini'] }} dibuat hari ini</span>
                            <span class="text-outline">Ambil di loket</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Antrean Waiting List</span>
                            <div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">hourglass_bottom</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['antrean'] }} <span class="font-headline-sm font-normal text-outline">Antrean</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="text-tertiary font-bold">FIFO otomatis</span>
                            <span class="text-on-surface-variant">Menunggu stok kembali</span>
                        </div>
                    </div>
                </div>

                {{-- Konten 2 kolom --}}
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-space-md">
                    {{-- Peminjaman Terbaru --}}
                    <div class="xl:col-span-2 bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center justify-between flex-wrap gap-space-sm">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                                    Peminjaman Terbaru
                                    <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $semuaCount }} Transaksi</span>
                                </h2>
                                <p class="font-body-sm text-on-surface-variant mt-1">Sirkulasi terakhir yang perlu dipantau loket</p>
                            </div>
                            <a href="{{ route('petugas.circulation') }}"
                                class="inline-flex items-center gap-1 text-primary font-label-md hover:underline">
                                Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>

                        {{-- Tab filter --}}
                        <div class="flex items-center gap-space-xs">
                            @foreach (['semua' => "Semua ({$semuaCount})", 'aktif' => "Aktif ({$aktifCount})", 'tempo' => "Tempo Dekat ({$tempoCount})"] as $key => $label)
                                <a href="{{ route('petugas.dashboard', ['tab' => $key]) }}"
                                    class="px-4 py-2 rounded-lg font-label-md whitespace-nowrap transition-colors
                                      {{ $tab === $key ? 'bg-primary-fixed text-primary font-bold ring-1 ring-primary-container' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                        <th class="py-space-md px-space-md">Anggota</th>
                                        <th class="py-space-md px-space-md">Judul Buku & Kategori</th>
                                        <th class="py-space-md px-space-md">Tgl Pinjam</th>
                                        <th class="py-space-md px-space-md">Jatuh Tempo</th>
                                        <th class="py-space-md px-space-md">Status</th>
                                        <th class="py-space-md px-space-md text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body-md text-on-surface">
                                    @forelse($recent as $b)
                                        @php $initials = collect(explode(' ', $b->borrower->name ?? 'A'))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join(''); @endphp
                                        <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                            <td class="py-space-md px-space-md">
                                                <div class="flex items-center gap-space-md">
                                                    <div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold font-label-md shrink-0">
                                                        {{ $initials }}</div>
                                                    <div class="flex flex-col min-w-0">
                                                        <span class="font-label-md text-on-surface truncate">{{ $b->borrower->name ?? '-' }}</span>
                                                        <span class="font-body-sm text-outline">NISN: {{ $b->borrower->nisn ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-space-md px-space-md">
                                                <div class="flex flex-col min-w-0">
                                                    <span class="font-label-md text-on-surface truncate max-w-[220px]">{{ $b->book->title ?? '-' }}</span>
                                                    <span class="font-body-sm text-outline">{{ $b->book->category->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                                {{ $b->borrow_date->format('d M Y') }}</td>
                                            <td class="py-space-md px-space-md text-body-sm whitespace-nowrap {{ $b->status === 'terlambat' ? 'text-error font-bold' : '' }}">
                                                {{ $b->due_date->format('d M Y') }}</td>
                                            <td class="py-space-md px-space-md">
                                                @if ($b->status === 'dikembalikan')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold"><span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Dikembalikan</span>
                                                @elseif($b->status === 'terlambat')
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold"><span class="w-1.5 h-1.5 rounded-full bg-error"></span> Terlambat</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Dipinjam</span>
                                                @endif
                                            </td>
                                            <td class="py-space-md px-space-md text-right">
                                                @if ($b->status !== 'dikembalikan')
                                                    <form method="POST" action="{{ route('petugas.circulation.return', $b->id) }}"
                                                        onsubmit="return confirm('Proses pengembalian {{ addslashes($b->book->title ?? '') }} dari {{ addslashes($b->borrower->name ?? '') }}?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-sm font-bold shadow-sm">Kembalikan</button>
                                                    </form>
                                                @else
                                                    <span class="font-label-sm text-outline">Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-10 text-center text-secondary font-body-md">Tidak ada transaksi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="flex items-center justify-between font-label-sm text-on-surface-variant pt-space-sm border-t border-outline-variant/30">
                            <span class="flex items-center gap-space-md flex-wrap">
                                <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-error"></span> Total Aktif: <strong class="text-on-surface">{{ $stats['aktif'] }} Buku</strong></span>
                                <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-tertiary"></span> Kembali Hari Ini: <strong class="text-on-surface">{{ $stats['kembali_hari_ini'] }} Buku</strong></span>
                            </span>
                            <span class="text-outline">Data real-time dari database</span>
                        </div>
                    </div>

                    {{-- Aktivitas Terbaru --}}
                    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface">Aktivitas Terbaru</h2>
                                <p class="font-body-sm text-on-surface-variant mt-1">Log kegiatan sirkulasi</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span> Live
                            </span>
                        </div>
                        <div class="flex flex-col gap-space-lg relative before:absolute before:left-[5px] before:top-2 before:bottom-2 before:w-px before:bg-outline-variant/40">
                            @forelse($activities as $a)
                                <div class="flex items-start gap-space-md relative">
                                    <span class="w-2.5 h-2.5 rounded-full mt-1.5 shrink-0 {{ $a['type'] === 'return' ? 'bg-tertiary' : 'bg-primary' }}"></span>
                                    <div class="flex flex-col min-w-0 flex-1">
                                        <span class="font-label-md text-on-surface">{{ $a['type'] === 'return' ? 'Buku Dikembalikan' : 'Peminjaman Buku' }}</span>
                                        <span class="font-body-sm text-on-surface-variant truncate">
                                            <strong class="text-on-surface">{{ $a['who'] }}</strong>
                                            {{ $a['type'] === 'return' ? 'mengembalikan' : 'meminjam' }}
                                            <em class="text-primary">"{{ $a['book'] }}"</em>
                                        </span>
                                    </div>
                                    <span class="font-label-sm text-outline whitespace-nowrap">{{ $a['when']->diffForHumans() }}</span>
                                </div>
                            @empty
                                <p class="font-body-sm text-secondary">Belum ada aktivitas.</p>
                            @endforelse
                        </div>
                        <a href="{{ route('petugas.circulation') }}"
                            class="mt-auto inline-flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-primary-fixed/50 text-primary font-label-md font-bold hover:bg-primary-fixed transition-colors">
                            Lihat Semua Log Sirkulasi <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>