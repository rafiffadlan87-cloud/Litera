<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Meja Sirkulasi - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
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
                <span class="text-primary font-bold">Meja Sirkulasi</span>
            </div>
            <div class="flex items-center gap-space-sm">
                <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">badge</span>
                </div>
                <div class="hidden md:flex flex-col">
                    <span class="font-label-md text-on-surface leading-tight">{{ Auth::user()->name }}</span>
                    <span class="font-label-sm text-outline">Petugas</span>
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

                {{-- Peminjaman Aktif --}}
                <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                            Peminjaman Aktif
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $loans->count() }} Buku</span>
                        </h2>
                        <p class="font-body-sm text-on-surface-variant mt-1">Proses pengembalian langsung dari meja loket</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-md">Anggota</th>
                                    <th class="py-space-md px-space-md">Judul Buku</th>
                                    <th class="py-space-md px-space-md">Tgl Pinjam</th>
                                    <th class="py-space-md px-space-md">Jatuh Tempo</th>
                                    <th class="py-space-md px-space-md">Status</th>
                                    <th class="py-space-md px-space-md text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($loans as $b)
                                    <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                        <td class="py-space-md px-space-md">
                                            <div class="flex flex-col min-w-0">
                                                <span class="font-label-md text-on-surface">{{ $b->borrower->name ?? '-' }}</span>
                                                <span class="font-body-sm text-outline">NISN: {{ $b->borrower->nisn ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-md">
                                            <span class="font-label-md text-on-surface">{{ $b->book->title ?? '-' }}</span>
                                        </td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">{{ $b->borrow_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap {{ $b->status === 'terlambat' ? 'text-error font-bold' : '' }}">{{ $b->due_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-md">
                                            @if ($b->status === 'terlambat')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold"><span class="w-1.5 h-1.5 rounded-full bg-error"></span> Terlambat</span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Dipinjam</span>
                                            @endif
                                        </td>
                                        <td class="py-space-md px-space-md text-right">
                                            <form method="POST" action="{{ route('petugas.circulation.return', $b->id) }}"
                                                onsubmit="return confirm('Proses pengembalian {{ addslashes($b->book->title ?? '') }} dari {{ addslashes($b->borrower->name ?? '') }}?');">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-sm font-bold shadow-sm">Kembalikan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="py-10 text-center text-secondary font-body-md">Tidak ada peminjaman aktif.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pesanan Pengambilan --}}
                <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                            Pesanan Pengambilan
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $bookings->count() }} Pesanan</span>
                        </h2>
                        <p class="font-body-sm text-on-surface-variant mt-1">Booking anggota yang diambil di loket</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-md">Anggota</th>
                                    <th class="py-space-md px-space-md">Judul Buku</th>
                                    <th class="py-space-md px-space-md">Tenggat Ambil</th>
                                    <th class="py-space-md px-space-md">Status</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($bookings as $bk)
                                    <tr class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                        <td class="py-space-md px-space-md font-label-md">{{ $bk->user->name ?? '-' }}</td>
                                        <td class="py-space-md px-space-md">{{ $bk->book->title ?? '-' }}</td>
                                        <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">{{ $bk->pickup_deadline ? \Carbon\Carbon::parse($bk->pickup_deadline)->format('d M Y') : '-' }}</td>
                                        <td class="py-space-md px-space-md">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm font-bold">
                                                {{ ucfirst($bk->status ?? '-') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-10 text-center text-secondary font-body-md">Belum ada pesanan.</td></tr>
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