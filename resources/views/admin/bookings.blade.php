<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Booking - LITERA Admin</title>
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
                <span class="text-primary font-bold">Kelola Booking</span>
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
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Kelola Booking</h1>
                    <p class="font-body-md text-on-surface-variant max-w-3xl">
                        Pantau reservasi buku stok habis dari seluruh siswa dan proses penyerahan buku saat stok
                        tersedia kembali.
                    </p>
                </div>

                {{-- 4 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Booking Aktif</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">bookmark</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">{{ $stats['aktif'] }}
                            <span class="font-headline-sm font-normal text-outline">Reservasi</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Siap Diserahkan</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-tertiary-container/15 flex items-center justify-center text-tertiary">
                                <span class="material-symbols-outlined text-[22px]">check_circle</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-tertiary font-bold">{{ $stats['siap'] }}
                            <span class="font-headline-sm font-normal text-outline">Reservasi</span>
                        </div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Menunggu Stok</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-secondary-container flex items-center justify-center text-primary-container">
                                <span class="material-symbols-outlined text-[22px]">hourglass_top</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['menunggu'] }} <span
                                class="font-headline-sm font-normal text-outline">Reservasi</span></div>
                    </div>
                    <div class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col gap-space-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-label-md text-on-surface-variant font-semibold">Sudah Diproses</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-[22px]">assignment_turned_in</span>
                            </div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['diproses'] }} <span
                                class="font-headline-sm font-normal text-outline">Reservasi</span></div>
                    </div>
                </div>

                {{-- Tabel Booking --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg">KODE</th>
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">SISWA</th>
                                    <th class="py-space-md px-space-lg">DIBOOKING</th>
                                    <th class="py-space-md px-space-lg">BATAS AMBIL</th>
                                    <th class="py-space-md px-space-lg">STATUS</th>
                                    <th class="py-space-md px-space-lg text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($bookings as $b)
                                    @php
                                        $siap = $b->book->stock > 0;
                                        $sisaHari = (int) today()->diffInDays($b->pickup_deadline, false);
                                    @endphp
                                    <tr
                                        class="hover:bg-surface-container-low/40 transition-colors border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg font-mono text-body-sm text-secondary">
                                            {{ $b->code }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex items-center gap-space-md">
                                                <img class="w-9 h-12 object-cover rounded-md shadow-sm shrink-0"
                                                    src="{{ $b->book->cover && str_starts_with($b->book->cover, 'http') ? $b->book->cover : ($b->book->cover ? asset('storage/' . $b->book->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                                    alt="{{ $b->book->title }}" />
                                                <div class="flex flex-col min-w-0">
                                                    <span
                                                        class="font-headline-sm text-on-surface font-semibold truncate max-w-[200px]">{{ $b->book->title }}</span>
                                                    <span class="font-body-sm text-outline">Stok sekarang:
                                                        {{ $b->book->stock }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col">
                                                <span class="font-label-md text-on-surface">{{ $b->user->name }}</span>
                                                <span class="font-body-sm text-outline">{{ $b->user->email }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $b->created_at->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col gap-1">
                                                <span
                                                    class="text-body-sm">{{ $b->pickup_deadline->format('d M Y') }}</span>
                                                @if ($b->status === 'aktif')
                                                    <span
                                                        class="font-label-sm {{ $sisaHari <= 3 ? 'text-error font-bold' : 'text-outline' }}">Sisa
                                                        {{ $sisaHari }} hari</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg">
                                            @if ($b->status === 'aktif' && $siap)
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-tertiary-container/15 text-tertiary font-label-sm font-bold">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span>
                                                    Siap Diserahkan
                                                </span>
                                            @elseif($b->status === 'aktif')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-amber-100 text-amber-900 font-label-sm font-bold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> Menunggu
                                                    Stok
                                                </span>
                                            @elseif($b->status === 'diambil')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">
                                                    <span
                                                        class="material-symbols-outlined text-[13px]">check_circle</span>
                                                    Sudah Diserahkan
                                                </span>
                                            @elseif($b->status === 'kadaluarsa')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold">
                                                    <span class="material-symbols-outlined text-[13px]">schedule</span>
                                                    Kadaluarsa
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-space-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm font-bold">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-space-md px-space-lg text-right">
                                            @if ($b->status === 'aktif')
                                                <div class="flex items-center justify-end gap-space-xs">
                                                    <form method="POST"
                                                        action="{{ route('admin.bookings.batal', $b->id) }}"
                                                        onsubmit="return confirm('Batalkan booking {{ $b->code }} atas nama {{ $b->user->name }}?');">
                                                        @csrf
                                                        <button type="submit"
                                                            class="w-8 h-8 rounded-lg text-outline hover:text-error hover:bg-error-container/40 flex items-center justify-center transition-colors"
                                                            title="Batalkan">
                                                            <span
                                                                class="material-symbols-outlined text-[18px]">close</span>
                                                        </button>
                                                    </form>
                                                    @if ($siap)
                                                        <form method="POST"
                                                            action="{{ route('admin.bookings.proses', $b->id) }}"
                                                            onsubmit="return confirm('Serahkan {{ $b->book->title }} ke {{ $b->user->name }}? Booking berubah jadi peminjaman aktif.');">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-tertiary-container hover:brightness-110 text-on-tertiary font-label-md font-bold shadow-sm transition-all">
                                                                <span
                                                                    class="material-symbols-outlined text-[16px]">handshake</span>
                                                                Proses Serah
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button disabled
                                                            class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-surface-container-low text-outline cursor-not-allowed font-label-md">
                                                            <span
                                                                class="material-symbols-outlined text-[16px]">hourglass_top</span>
                                                            Menunggu Stok
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="font-body-sm text-outline">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-space-lg py-12 text-center">
                                            <span
                                                class="material-symbols-outlined text-[40px] text-outline">bookmark</span>
                                            <p class="font-body-md text-secondary mt-2">Belum ada booking dari siswa.
                                            </p>
                                        </td>
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
