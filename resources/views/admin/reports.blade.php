<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Laporan - LITERA Admin</title>
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

    @include('partials.admin-sidebar')

    <div class="lg:pl-72 min-h-screen flex flex-col bg-background">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet print:hidden">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Panel Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Laporan</span>
            </div>
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary-container text-on-primary font-label-md font-bold shadow-sm hover:bg-primary transition-all">
                <span class="material-symbols-outlined text-[18px]">print</span>
                Cetak Laporan
            </button>
        </header>

        <main class="w-full pt-16 bg-background flex-1 p-space-xl">
            <div class="flex flex-col w-full gap-space-xl">

                {{-- Kop Laporan (muncul saat dicetak) --}}
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md">
                    <div class="flex flex-col gap-space-xs">
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Laporan Operasional
                            Perpustakaan</h1>
                        <p class="font-body-md text-on-surface-variant">
                            Periode cetak: {{ now()->locale('id')->isoFormat('dddd, D MMMM Y HH:mm') }} WIB — dibuat
                            otomatis oleh sistem LITERA.
                        </p>
                    </div>
                </div>

                {{-- 6 Kartu Statistik --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-space-md">
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Judul Buku</span>
                        <span
                            class="font-headline-md text-headline-md text-on-surface font-bold">{{ $stats['total_judul'] }}</span>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Eksemplar Tersedia</span>
                        <span
                            class="font-headline-md text-headline-md text-on-surface font-bold">{{ $stats['total_eksemplar'] }}</span>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Anggota Siswa</span>
                        <span
                            class="font-headline-md text-headline-md text-on-surface font-bold">{{ $stats['total_anggota'] }}</span>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Total Transaksi</span>
                        <span
                            class="font-headline-md text-headline-md text-on-surface font-bold">{{ $stats['total_transaksi'] }}</span>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Sedang Dipinjam</span>
                        <span
                            class="font-headline-md text-headline-md text-primary font-bold">{{ $stats['peminjaman_aktif'] }}</span>
                    </div>
                    <div class="p-space-md rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-1">
                        <span class="font-label-sm text-on-surface-variant">Total Denda</span>
                        <span class="font-headline-md text-headline-md text-error font-bold">Rp
                            {{ number_format($stats['total_denda'], 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Grafik 6 Bulan --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg">
                    <div class="flex items-center justify-between mb-space-lg">
                        <h2 class="font-headline-sm text-on-surface font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">monitoring</span>
                            Peminjaman 6 Bulan Terakhir
                        </h2>
                        <span class="font-label-sm text-outline">Maks {{ $max }} transaksi/bulan</span>
                    </div>
                    <div class="flex items-end justify-between gap-space-md h-44">
                        @foreach ($monthly as $key => $m)
                            <div class="flex-1 flex flex-col items-center justify-end gap-space-sm h-full">
                                <span class="font-label-md text-on-surface font-bold">{{ $m['count'] }}</span>
                                <div class="w-full rounded-t-lg bg-primary-container/80 hover:bg-primary-container transition-all"
                                    style="height: {{ max(4, round(($m['count'] / $max) * 100)) }}%;"></div>
                                <span class="font-label-sm text-outline uppercase">{{ $m['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Top Buku & Top Anggota --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-md">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                        <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-500 text-[20px]">trophy</span>
                            <h2 class="font-headline-sm text-on-surface font-semibold">Buku Terpopuler</h2>
                        </div>
                        <table class="w-full text-left">
                            <tbody class="font-body-md text-on-surface">
                                @forelse($topBooks as $i => $t)
                                    <tr class="border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg w-10 text-center font-label-md text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="py-space-md px-space-lg font-label-md truncate max-w-[240px]">
                                            {{ $t->book->title }}</td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">{{ $t->total }}x
                                                dipinjam</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-secondary" colspan="3">Belum ada data
                                            peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                        <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                            <span class="material-symbols-outlined text-tertiary text-[20px]">star</span>
                            <h2 class="font-headline-sm text-on-surface font-semibold">Anggota Teraktif</h2>
                        </div>
                        <table class="w-full text-left">
                            <tbody class="font-body-md text-on-surface">
                                @forelse($topMembers as $i => $t)
                                    <tr class="border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg w-10 text-center font-label-md text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col">
                                                <span class="font-label-md">{{ $t->borrower->name }}</span>
                                                <span class="font-body-sm text-outline">{{ $t->borrower->nisn }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold">{{ $t->total }}x
                                                pinjam</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-8 text-center text-secondary" colspan="3">Belum ada data
                                            peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Transaksi Terbaru --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">receipt_long</span>
                        <h2 class="font-headline-sm text-on-surface font-semibold">Transaksi Terbaru</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">PEMINJAM</th>
                                    <th class="py-space-md px-space-lg">TGL PINJAM</th>
                                    <th class="py-space-md px-space-lg">JATUH TEMPO</th>
                                    <th class="py-space-md px-space-lg">STATUS</th>
                                    <th class="py-space-md px-space-lg">DENDA</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @foreach ($recent as $r)
                                    <tr class="border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg font-label-md truncate max-w-[220px]">
                                            {{ $r->book->title }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">{{ $r->borrower->name }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $r->borrow_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $r->due_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg">
                                            @if ($r->status === 'dipinjam')
                                                <span
                                                    class="px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">Dipinjam</span>
                                            @elseif($r->status === 'terlambat')
                                                <span
                                                    class="px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold">Terlambat</span>
                                            @else
                                                <span
                                                    class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td
                                            class="py-space-md px-space-lg font-label-md {{ $r->fine > 0 ? 'text-error font-bold' : 'text-outline' }}">
                                            {{ $r->fine > 0 ? 'Rp ' . number_format($r->fine, 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
