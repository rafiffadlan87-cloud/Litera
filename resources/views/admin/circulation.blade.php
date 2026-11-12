<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Meja Sirkulasi - LITERA Admin</title>
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
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Panel Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Meja Sirkulasi</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary text-[18px]">shield_person</span>
            </div>
        </header>

        <main class="w-full pt-16 bg-background flex-1 p-space-xl">
            <div class="flex flex-col w-full gap-space-xl">

                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 rounded-xl bg-error-container text-on-error-container flex items-center gap-2">
                        <span class="material-symbols-outlined">error</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Judul --}}
                <div class="flex flex-col gap-space-xs">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Meja Sirkulasi</h1>
                    <p class="font-body-md text-on-surface-variant max-w-3xl">
                        Proses pengembalian buku, pantau keterlambatan, dan rekap denda otomatis (Rp
                        {{ number_format($finePerDay, 0, ',', '.') }}/hari).
                    </p>
                </div>

                {{-- 4 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Sedang Dipinjam</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">auto_stories</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">{{ $stats['aktif'] }}
                            <span class="font-headline-sm font-normal text-outline">Transaksi</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Terlambat</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-error-container/40 flex items-center justify-center text-error">
                                <span class="material-symbols-outlined text-[22px]">alarm</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-error font-bold">{{ $stats['terlambat'] }}
                            <span class="font-headline-sm font-normal text-outline">Transaksi</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Kembali Hari Ini</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-tertiary-container/15 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined text-[22px]">assignment_return</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['kembali_hari_ini'] }} <span
                                class="font-headline-sm font-normal text-outline">Buku</span></div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Total Denda</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-secondary-container flex items-center justify-center text-primary-container">
                                <span class="material-symbols-outlined text-[22px]">payments</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">Rp
                            {{ number_format($stats['total_denda'], 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Tabel Peminjaman Aktif --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]">swap_horiz</span>
                        <h2 class="font-headline-sm text-on-surface font-semibold">Peminjaman Berjalan</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg w-16 text-center">NO</th>
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">PEMINJAM</th>
                                    <th class="py-space-md px-space-lg">TGL PINJAM</th>
                                    <th class="py-space-md px-space-lg">JATUH TEMPO</th>
                                    <th class="py-space-md px-space-lg">EST. DENDA</th>
                                    <th class="py-space-md px-space-lg text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($actives as $i => $b)
                                    @php
                                        $lateDays = max(0, (int) $b->due_date->diffInDays(today(), false));
                                        $daysLeft = (int) today()->diffInDays($b->due_date, false);
                                        $estFine = $lateDays * $finePerDay;
                                    @endphp
                                    <tr
                                        class="hover:bg-surface-container-low/40 transition-colors border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg text-center font-label-md text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex items-center gap-space-md">
                                                <img class="w-9 h-12 object-cover rounded-md shadow-sm shrink-0"
                                                    src="{{ $b->book->cover && str_starts_with($b->book->cover, 'http') ? $b->book->cover : ($b->book->cover ? asset('storage/' . $b->book->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                                    alt="{{ $b->book->title }}" />
                                                <span
                                                    class="font-headline-sm text-on-surface font-semibold truncate max-w-[220px]">{{ $b->book->title }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-md text-on-surface">{{ $b->borrower->name }}</span>
                                                <span class="font-body-sm text-outline">{{ $b->borrower->nisn }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $b->borrow_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col gap-1">
                                                <span class="text-body-sm">{{ $b->due_date->format('d M Y') }}</span>
                                                @if ($b->status === 'terlambat')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-error-container text-error font-label-sm font-bold w-fit">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span>
                                                        Terlambat {{ $lateDays }} hari
                                                    </span>
                                                @elseif($daysLeft <= 3)
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-100 text-amber-900 font-label-sm font-bold w-fit">Sisa
                                                        {{ $daysLeft }} hari</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold w-fit">Sisa
                                                        {{ $daysLeft }} hari</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td
                                            class="py-space-md px-space-lg font-label-md {{ $estFine > 0 ? 'text-error font-bold' : 'text-outline' }}">
                                            Rp {{ number_format($estFine, 0, ',', '.') }}
                                        </td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <form method="POST"
                                                action="{{ route('admin.circulation.return', $b->id) }}"
                                                onsubmit="return confirm('Proses pengembalian {{ $b->book->title }} dari {{ $b->borrower->name }}?{{ $estFine > 0 ? ' Denda: Rp ' . number_format($estFine, 0, ',', '.') : '' }}');">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-tertiary-container hover:brightness-110 text-on-tertiary font-label-md font-bold shadow-sm transition-all">
                                                    <span
                                                        class="material-symbols-outlined text-[16px]">assignment_return</span>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-space-lg py-12 text-center">
                                            <span
                                                class="material-symbols-outlined text-[40px] text-outline">verified</span>
                                            <p class="font-body-md text-secondary mt-2">Tidak ada peminjaman berjalan.
                                                Semua buku sudah kembali!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Riwayat Pengembalian --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary text-[20px]">history</span>
                        <h2 class="font-headline-sm text-on-surface font-semibold">Riwayat Pengembalian Terakhir</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg w-16 text-center">NO</th>
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">PEMINJAM</th>
                                    <th class="py-space-md px-space-lg">TGL KEMBALI</th>
                                    <th class="py-space-md px-space-lg">DENDA</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($returned as $i => $r)
                                    <tr class="border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg text-center font-label-md text-outline">
                                            {{ $i + 1 }}</td>
                                        <td class="py-space-md px-space-lg font-label-md">{{ $r->book->title }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">{{ $r->borrower->name }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $r->returned_at?->format('d M Y') ?? '-' }}</td>
                                        <td
                                            class="py-space-md px-space-lg font-label-md {{ $r->fine > 0 ? 'text-error font-bold' : 'text-tertiary' }}">
                                            {{ $r->fine > 0 ? 'Rp ' . number_format($r->fine, 0, ',', '.') : 'Tepat waktu' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-space-lg py-10 text-center text-secondary font-body-md">Belum ada
                                            pengembalian tercatat.</td>
                                    </tr>
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
