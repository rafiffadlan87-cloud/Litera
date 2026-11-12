<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Admin - LITERA</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
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

    @include('partials.admin-sidebar')

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between gap-space-md pr-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md shrink-0">
                <span class="text-secondary hidden sm:inline">Portal Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline hidden sm:inline">chevron_right</span>
                <span class="text-primary font-bold">Dashboard</span>
            </div>
            <form method="GET" action="{{ route('admin.dashboard') }}"
                class="relative flex-1 max-w-md hidden md:flex items-center">
                <input type="hidden" name="tab" value="{{ $tab }}" />
                <span
                    class="material-symbols-outlined absolute left-3 text-[18px] text-outline pointer-events-none">search</span>
                <input name="q" value="{{ $q }}" placeholder="Cari judul buku, anggota, transaksi..."
                    class="w-full h-10 pl-10 pr-4 bg-surface-container-low rounded-xl text-on-surface font-body-sm outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container shadow-sm" />
            </form>
            <div class="flex items-center gap-space-md shrink-0">
                <div class="hidden lg:flex items-center gap-space-xs text-on-surface-variant font-label-md">
                    <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
                    <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <a href="{{ route('admin.circulation') }}"
                    class="relative w-10 h-10 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors"
                    title="Peminjaman terlambat">
                    <span class="material-symbols-outlined text-[22px]">notifications</span>
                    @if ($stats['terlambat'] > 0)
                        <span
                            class="absolute top-1.5 right-1.5 w-2.5 h-2.5 rounded-full bg-error ring-2 ring-surface-container-lowest flex items-center justify-center text-[8px] text-white font-bold">{{ $stats['terlambat'] }}</span>
                    @endif
                </a>
                <div class="flex items-center gap-space-sm">
                    <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">shield_person</span>
                    </div>
                    <div class="hidden md:flex flex-col">
                        <span class="font-label-md text-on-surface leading-tight">{{ Auth::user()->name }}</span>
                        <span class="font-label-sm text-outline">Admin</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="pt-16 w-full flex-1 px-margin-tablet py-space-xl bg-background">
            <div class="flex flex-col w-full gap-space-lg">

                @if (session('success'))
                    <div
                        class="p-4 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center gap-2">
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
                            <h1 class="font-headline-lg text-headline-lg text-on-surface">Selamat Datang Kembali,
                                {{ Auth::user()->name }} 👋</h1>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span> Sistem Online
                            </span>
                        </div>
                        <p class="font-body-md text-on-surface-variant">
                            Berikut ringkasan operasional dan sirkulasi pustaka hari ini,
                            <strong
                                class="text-on-surface">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</strong>.
                        </p>
                    </div>
                    <div class="flex items-center gap-space-md flex-wrap shrink-0">
                        <a href="{{ route('admin.books.index', ['add' => 1]) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-surface-container-lowest border border-outline-variant text-primary-container font-label-lg font-bold hover:bg-surface-container-low transition-all">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            <span>+ Tambah Buku Baru</span>
                        </a>
                        <button onclick="document.getElementById('quickModal').classList.remove('hidden')"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary-container text-on-primary font-label-lg font-bold shadow-md hover:bg-primary transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[20px]">fact_check</span>
                            <span>+ Entri Peminjaman Cepat</span>
                        </button>
                    </div>
                </div>

                {{-- 4 Kartu Statistik --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-space-md">
                    <div
                        class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Total Koleksi Buku</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">local_library</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['total_judul'] }} <span
                                class="font-headline-sm font-normal text-outline">Judul</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="inline-flex items-center gap-1 text-tertiary"><span
                                    class="material-symbols-outlined text-[15px]">inventory_2</span>
                                {{ $stats['total_eksemplar'] }} eksemplar</span>
                            <span class="text-outline">Stok fisik total</span>
                        </div>
                    </div>
                    <div
                        class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Total Anggota Aktif</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                                <span class="material-symbols-outlined text-[22px]">badge</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['total_anggota'] }} <span
                                class="font-headline-sm font-normal text-outline">Orang</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="inline-flex items-center gap-1 text-tertiary"><span
                                    class="material-symbols-outlined text-[15px]">verified</span>
                                {{ $stats['total_siswa'] }} siswa terdaftar</span>
                            <span class="text-outline">+{{ $stats['total_petugas'] }} petugas</span>
                        </div>
                    </div>
                    <div
                        class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Peminjaman Hari Ini</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-error-container/50 flex items-center justify-center text-error">
                                <span class="material-symbols-outlined text-[22px]">event_note</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['pinjam_hari_ini'] }} <span
                                class="font-headline-sm font-normal text-outline">Transaksi</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="text-on-surface-variant">{{ $stats['kembali_hari_ini'] }} dikembalikan</span>
                            <span class="text-primary font-bold">{{ $stats['aktif'] }} aktif</span>
                        </div>
                    </div>
                    <div
                        class="p-space-lg rounded-xl bg-surface-container-lowest shadow-sm flex flex-col justify-between gap-space-md">
                        <div class="flex items-start justify-between">
                            <span class="font-label-md text-on-surface-variant">Booking & Waiting List</span>
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">hourglass_bottom</span></div>
                        </div>
                        <div class="font-headline-lg text-headline-lg text-on-surface font-bold">
                            {{ $stats['reservasi'] }} <span
                                class="font-headline-sm font-normal text-outline">Reservasi</span></div>
                        <div class="flex items-center justify-between font-label-sm">
                            <span class="text-tertiary font-bold">{{ $stats['booking_aktif'] }} menunggu
                                giliran</span>
                            <span class="text-on-surface-variant">{{ $stats['queue_aktif'] }} dalam antrean</span>
                        </div>
                    </div>
                </div>

                {{-- Konten 2 kolom --}}
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-space-md">
                    {{-- Peminjaman Terbaru --}}
                    <div
                        class="xl:col-span-2 bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center justify-between flex-wrap gap-space-sm">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                                    Peminjaman Terbaru
                                    <span
                                        class="px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm">{{ $semuaCount }}
                                        Transaksi</span>
                                </h2>
                                <p class="font-body-sm text-on-surface-variant mt-1">Daftar sirkulasi peminjaman buku
                                    terakhir{{ $q ? ' untuk pencarian: "' . $q . '"' : '' }}</p>
                            </div>
                            <a href="{{ route('admin.circulation') }}"
                                class="inline-flex items-center gap-1 text-primary font-label-md hover:underline">
                                Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>

                        {{-- Tab filter --}}
                        <div class="flex items-center gap-space-xs">
                            @foreach (['semua' => "Semua ({$semuaCount})", 'aktif' => "Aktif ({$aktifCount})", 'tempo' => "Tempo Dekat ({$tempoCount})"] as $key => $label)
                                <a href="{{ route('admin.dashboard', array_filter(['tab' => $key, 'q' => $q])) }}"
                                    class="px-4 py-2 rounded-lg font-label-md whitespace-nowrap transition-colors
                                      {{ $tab === $key ? 'bg-primary-fixed text-primary font-bold ring-1 ring-primary-container' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low/70 text-on-surface-variant font-label-sm uppercase">
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
                                        @php $initials = collect(explode(' ', $b->borrower->name))->take(2)->map(fn($w) => strtoupper(substr($w,0,1)))->join(''); @endphp
                                        <tr
                                            class="border-t border-outline-variant/30 hover:bg-surface-container-low/40 transition-colors">
                                            <td class="py-space-md px-space-md">
                                                <div class="flex items-center gap-space-md">
                                                    <div
                                                        class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold font-label-md shrink-0">
                                                        {{ $initials }}</div>
                                                    <div class="flex flex-col min-w-0">
                                                        <span
                                                            class="font-label-md text-on-surface truncate">{{ $b->borrower->name }}</span>
                                                        <span class="font-body-sm text-outline">NISN:
                                                            {{ $b->borrower->nisn }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-space-md px-space-md">
                                                <div class="flex flex-col min-w-0">
                                                    <span
                                                        class="font-label-md text-on-surface truncate max-w-[220px]">{{ $b->book->title }}</span>
                                                    <span
                                                        class="font-body-sm text-outline">{{ $b->book->category->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="py-space-md px-space-md text-body-sm whitespace-nowrap">
                                                {{ $b->borrow_date->format('d M Y') }}</td>
                                            <td
                                                class="py-space-md px-space-md text-body-sm whitespace-nowrap {{ $b->status === 'terlambat' ? 'text-error font-bold' : '' }}">
                                                {{ $b->due_date->format('d M Y') }}</td>
                                            <td class="py-space-md px-space-md">
                                                @if ($b->status === 'dikembalikan')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold"><span
                                                            class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                                                        Dikembalikan</span>
                                                @elseif($b->status === 'terlambat')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-label-sm font-bold"><span
                                                            class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                        Terlambat</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-fixed text-primary font-label-sm font-bold"><span
                                                            class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                                        Dipinjam</span>
                                                @endif
                                            </td>
                                            <td class="py-space-md px-space-md text-right">
                                                <div class="flex items-center justify-end gap-space-xs">
                                                    <a href="{{ route('admin.circulation') }}"
                                                        class="px-3 py-1.5 rounded-lg bg-surface-container-low text-on-surface-variant hover:bg-surface-container font-label-sm">Detail</a>
                                                    @if ($b->status !== 'dikembalikan')
                                                        <form method="POST"
                                                            action="{{ route('admin.circulation.return', $b->id) }}"
                                                            onsubmit="return confirm('Proses pengembalian {{ $b->book->title }} dari {{ $b->borrower->name }}?');">
                                                            @csrf
                                                            <button type="submit"
                                                                class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary hover:bg-primary font-label-sm font-bold shadow-sm">Kembalikan</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="py-10 text-center text-secondary font-body-md">
                                                Tidak ada transaksi{{ $q ? ' yang cocok' : '' }}.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="flex items-center justify-between font-label-sm text-on-surface-variant pt-space-sm border-t border-outline-variant/30">
                            <span class="flex items-center gap-space-md flex-wrap">
                                <span class="inline-flex items-center gap-1"><span
                                        class="w-2 h-2 rounded-full bg-error"></span> Total Aktif: <strong
                                        class="text-on-surface">{{ $stats['aktif'] }} Buku</strong></span>
                                <span class="inline-flex items-center gap-1"><span
                                        class="w-2 h-2 rounded-full bg-tertiary"></span> Dikembalikan Hari Ini: <strong
                                        class="text-on-surface">{{ $stats['kembali_hari_ini'] }} Buku</strong></span>
                            </span>
                            <span class="text-outline">Data real-time dari database</span>
                        </div>
                    </div>

                    {{-- Aktivitas Terbaru --}}
                    <div
                        class="bg-surface-container-lowest rounded-2xl shadow-sm p-space-lg flex flex-col gap-space-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-on-surface">Aktivitas Terbaru</h2>
                                <p class="font-body-sm text-on-surface-variant mt-1">Log kegiatan sirkulasi</p>
                            </div>
                            <span
                                class="px-2.5 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-sm font-bold inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span> Live
                            </span>
                        </div>
                        <div
                            class="flex flex-col gap-space-lg relative before:absolute before:left-[5px] before:top-2 before:bottom-2 before:w-px before:bg-outline-variant/40">
                            @forelse($activities as $a)
                                <div class="flex items-start gap-space-md relative">
                                    <span
                                        class="w-2.5 h-2.5 rounded-full mt-1.5 shrink-0 {{ $a['type'] === 'return' ? 'bg-tertiary' : 'bg-primary' }}"></span>
                                    <div class="flex flex-col min-w-0 flex-1">
                                        <span
                                            class="font-label-md text-on-surface">{{ $a['type'] === 'return' ? 'Buku Dikembalikan' : 'Peminjaman Buku' }}</span>
                                        <span class="font-body-sm text-on-surface-variant truncate">
                                            <strong class="text-on-surface">{{ $a['who'] }}</strong>
                                            {{ $a['type'] === 'return' ? 'mengembalikan' : 'meminjam' }}
                                            <em class="text-primary">"{{ $a['book'] }}"</em>
                                        </span>
                                    </div>
                                    <span
                                        class="font-label-sm text-outline whitespace-nowrap">{{ $a['when']->diffForHumans() }}</span>
                                </div>
                            @empty
                                <p class="font-body-sm text-secondary">Belum ada aktivitas.</p>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.circulation') }}"
                            class="mt-auto inline-flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-primary-fixed/50 text-primary font-label-md font-bold hover:bg-primary-fixed transition-colors">
                            Lihat Semua Log Sirkulasi <span
                                class="material-symbols-outlined text-[16px]">open_in_new</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL ENTRI PEMINJAMAN CEPAT --}}
    <div id="quickModal"
        class="fixed inset-0 z-[60] hidden bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-margin">
        <div class="w-full max-w-md bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl">
            <div class="flex items-center justify-between mb-space-md">
                <h3 class="font-headline-md text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">fact_check</span>
                    <span>Entri Peminjaman Cepat</span>
                </h3>
                <button onclick="document.getElementById('quickModal').classList.add('hidden')"
                    class="w-8 h-8 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.quick-borrow') }}" class="flex flex-col gap-space-md">
                @csrf
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md text-on-surface-variant">Anggota Peminjam</label>
                    <select name="borrower_id" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container">
                        <option value="">— Pilih anggota —</option>
                        @foreach ($borrowers as $br)
                            <option value="{{ $br->id }}">{{ $br->name }} ({{ $br->nisn }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-space-xs">
                    <label class="font-label-md text-on-surface-variant">Buku yang Dipinjam</label>
                    <select name="book_id" required
                        class="px-4 py-2.5 bg-surface-container-low rounded-lg text-on-surface font-body-md outline-none focus:ring-2 focus:ring-primary-container">
                        <option value="">— Pilih buku (stok tersedia) —</option>
                        @foreach ($books as $bk)
                            <option value="{{ $bk->id }}">{{ $bk->title }} (stok: {{ $bk->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <p class="font-body-sm text-on-surface-variant bg-surface-container-low rounded-lg p-3">
                    Jatuh tempo otomatis mengikuti pengaturan sistem
                    ({{ \App\Models\SettingsSystem::get('max_borrow_days', 7) }} hari). Prioritas waiting list tetap
                    dihormati.
                </p>
                <div class="flex items-center justify-end gap-space-sm">
                    <button type="button" onclick="document.getElementById('quickModal').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md font-bold shadow-sm">Catat
                        Peminjaman</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
