<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Perpanjangan - LITERA Admin</title>
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
                <span class="text-primary font-bold">Perpanjangan</span>
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

                <div class="flex flex-col gap-space-xs">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Persetujuan
                        Perpanjangan</h1>
                    <p class="font-body-md text-on-surface-variant">Setujui atau tolak pengajuan perpanjangan masa
                        pinjam dari siswa.</p>
                </div>

                {{-- Antrean Pengajuan --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[20px]">pending_actions</span>
                            <h2 class="font-headline-sm text-on-surface font-semibold">Menunggu Persetujuan</h2>
                        </div>
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-label-sm font-bold">{{ $pendings->count() }}
                            pengajuan</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">PEMINJAM</th>
                                    <th class="py-space-md px-space-lg">DIAJUKAN</th>
                                    <th class="py-space-md px-space-lg">JATUH TEMPO SAAT INI</th>
                                    <th class="py-space-md px-space-lg">TAMBAHAN</th>
                                    <th class="py-space-md px-space-lg text-right">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($pendings as $e)
                                    <tr
                                        class="hover:bg-surface-container-low/40 transition-colors border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg font-label-md">
                                            {{ $e->borrowing->book->title }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <div class="flex flex-col">
                                                <span class="font-label-md">{{ $e->borrowing->borrower->name }}</span>
                                                <span
                                                    class="font-body-sm text-outline">{{ $e->borrowing->borrower->nisn }}</span>
                                            </div>
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $e->created_at->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $e->borrowing->due_date->format('d M Y') }}</td>
                                        <td class="py-space-md px-space-lg">
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">+{{ $e->additional_days }}
                                                hari</span>
                                        </td>
                                        <td class="py-space-md px-space-lg text-right">
                                            <div class="flex items-center justify-end gap-space-xs">
                                                <form method="POST"
                                                    action="{{ route('admin.extensions.reject', $e->id) }}"
                                                    onsubmit="return confirm('Tolak pengajuan perpanjangan ini?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-2 rounded-lg bg-surface-container-low hover:bg-error-container/50 text-error font-label-md font-bold transition-colors">Tolak</button>
                                                </form>
                                                <form method="POST"
                                                    action="{{ route('admin.extensions.approve', $e->id) }}"
                                                    onsubmit="return confirm('Setujui perpanjangan +{{ $e->additional_days }} hari?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-tertiary-container hover:brightness-110 text-on-tertiary font-label-md font-bold shadow-sm transition-all">
                                                        <span
                                                            class="material-symbols-outlined text-[16px]">check_circle</span>
                                                        Setujui
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-space-lg py-10 text-center text-secondary font-body-md">Tidak ada
                                            pengajuan menunggu. 🎉</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Riwayat Keputusan --}}
                <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                    <div class="px-space-lg py-space-md bg-surface-container-low/70 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary text-[20px]">history</span>
                        <h2 class="font-headline-sm text-on-surface font-semibold">Riwayat Keputusan Terakhir</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-on-surface-variant font-label-sm uppercase">
                                    <th class="py-space-md px-space-lg">BUKU</th>
                                    <th class="py-space-md px-space-lg">PEMINJAM</th>
                                    <th class="py-space-md px-space-lg">KEPUTUSAN</th>
                                    <th class="py-space-md px-space-lg">OLEH</th>
                                    <th class="py-space-md px-space-lg">TANGGAL</th>
                                </tr>
                            </thead>
                            <tbody class="font-body-md text-on-surface">
                                @forelse($decided as $e)
                                    <tr class="border-t border-outline-variant/30">
                                        <td class="py-space-md px-space-lg font-label-md">
                                            {{ $e->borrowing->book->title }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $e->borrowing->borrower->name }}</td>
                                        <td class="py-space-md px-space-lg">
                                            @if ($e->status === 'disetujui')
                                                <span
                                                    class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold">Disetujui
                                                    (+{{ $e->additional_days }} hari)
                                                </span>
                                            @else
                                                <span
                                                    class="px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $e->approver->name ?? 'Sistem' }}</td>
                                        <td class="py-space-md px-space-lg text-body-sm">
                                            {{ $e->updated_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-space-lg py-10 text-center text-secondary font-body-md">Belum ada
                                            keputusan tercatat.</td>
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
