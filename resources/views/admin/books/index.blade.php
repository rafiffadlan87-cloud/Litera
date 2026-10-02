<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Buku - LITERA Admin</title>
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
                        error: "#ba1a1a", outline: "#737686", primary: "#004ac6", surface: "#f8f9ff",
                        "surface-container": "#e5eeff", "surface-container-highest": "#d3e4fe",
                        "surface-container-high": "#dce9ff", background: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff", "on-primary": "#ffffff",
                        "surface-container-low": "#eff4ff", secondary: "#545f73",
                        "on-error-container": "#93000a", "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#b4c5ff", "on-surface-variant": "#434655",
                        "surface-variant": "#d3e4fe", "on-secondary": "#ffffff",
                        "tertiary-container": "#007d55", "on-primary-fixed": "#00174b",
                        "on-background": "#0b1c30", "secondary-fixed": "#d8e3fb",
                        "on-tertiary": "#ffffff", "on-error": "#ffffff", "on-surface": "#0b1c30",
                        tertiary: "#006242", "secondary-container": "#d5e0f8",
                        "error-container": "#ffdad6", "outline-variant": "#c3c6d7",
                        "primary-fixed": "#dbe1ff", "inverse-surface": "#213145",
                        "tertiary-fixed": "#6ffbbe", "primary-container": "#2563eb",
                        "primary-fixed-dim": "#b4c5ff", "secondary-fixed-dim": "#bcc7de",
                        "on-secondary-fixed": "#111c2d", "on-primary-fixed-variant": "#003ea8",
                        "on-secondary-fixed-variant": "#3c475a", "on-tertiary-fixed": "#002113",
                        "on-tertiary-fixed-variant": "#005236", "on-primary-container": "#eeefff",
                        "on-secondary-container": "#586377", "on-tertiary-container": "#bdffdb"
                    },
                    spacing: {
                        "space-xs": "0.25rem", "space-lg": "1rem", "gutter-sm": "0.75rem",
                        "margin-tablet": "1.5rem", gutter: "1rem", margin: "1rem",
                        "space-md": "0.75rem", "space-xl": "1.5rem", "space-sm": "0.5rem"
                    },
                    fontFamily: {
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans"], "label-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"], "headline-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"], "body-sm": ["Plus Jakarta Sans"]
                    }
                }
            }
        };
    </script>
</head>

<body class="bg-background font-body-md text-on-surface antialiased">

    <aside
        class="fixed left-0 top-0 h-full w-72 bg-inverse-surface text-inverse-on-surface z-50 flex flex-col justify-between shadow-sm">
        <div class="flex flex-col">
            <div class="p-space-lg flex items-center gap-space-sm">
                <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined text-[24px]">menu_book</span>
                </div>
                <div class="flex flex-col">
                    <span
                        class="font-headline-sm text-headline-sm text-surface-container-lowest leading-none">LITERA</span>
                    <span class="font-label-sm text-label-sm text-primary-fixed-dim mt-space-xs">Portal Admin</span>
                </div>
            </div>
            <div
                class="mx-space-lg mb-space-md p-space-sm bg-on-background/40 rounded-xl flex items-center gap-space-sm">
                <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
                <div class="flex flex-col min-w-0 flex-1">
                    <span
                        class="font-label-md text-label-md text-surface-container-lowest truncate">{{ Auth::user()->name }}</span>
                    <span class="font-label-sm text-label-sm text-outline-variant truncate">Administrator</span>
                </div>
            </div>
            <nav class="flex flex-col gap-space-xs px-space-md">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">grid_view</span>
                    <span class="font-label-lg text-label-lg">Dashboard</span>
                </a>

                {{-- Kelola Buku (AKTIF / HIGHLIGHT) --}}
                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg bg-primary-container text-on-primary font-bold shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">book_2</span>
                    <span class="font-label-lg text-label-lg">Kelola Buku</span>
                </a>

                {{-- Kelola Kategori --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">sell</span>
                    <span class="font-label-lg text-label-lg">Kelola Kategori</span>
                </a>

                {{-- Kelola Anggota --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span class="font-label-lg text-label-lg">Kelola Anggota</span>
                </a>

                {{-- Kelola Peminjaman --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">swap_horiz</span>
                    <span class="font-label-lg text-label-lg">Kelola Peminjaman</span>
                </a>

                {{-- Kelola Booking --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">bookmark</span>
                    <span class="font-label-lg text-label-lg">Kelola Booking</span>
                </a>

                {{-- Waiting List --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                    <span class="font-label-lg text-label-lg">Waiting List</span>
                </a>

                {{-- Kelola Pengembalian --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">assignment_return</span>
                    <span class="font-label-lg text-label-lg">Kelola Pengembalian</span>
                </a>

                {{-- Laporan --}}
                <a href="#"
                    class="flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-surface-container-highest/20 hover:text-surface-container-lowest transition-colors">
                    <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                    <span class="font-label-lg text-label-lg">Laporan</span>
                </a>
            </nav>
        </div>
        <div class="p-space-md">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-space-sm px-space-md py-space-sm rounded-lg text-outline-variant hover:bg-error-container hover:text-on-error-container transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span class="font-label-lg text-label-lg">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="pl-72 min-h-screen flex flex-col bg-background">
        <header
            class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-space-xl">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-outline">Portal Admin</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Kelola Buku</span>
            </div>
            <div class="flex items-center gap-space-lg">
                <div class="hidden lg:flex items-center gap-space-xs text-on-surface-variant font-label-md">
                    <span class="material-symbols-outlined text-[18px] text-secondary">calendar_today</span>
                    <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
            </div>
        </header>

        <main class="w-full pt-16 bg-background flex-1 p-space-xl">
            @if(session('success'))
                <div
                    class="mb-space-lg flex items-center justify-between bg-tertiary-container/10 p-space-md rounded-xl shadow-sm text-tertiary">
                    <div class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        <span class="font-label-md font-bold">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div
                    class="mb-space-lg flex items-center justify-between bg-error-container/30 p-space-md rounded-xl shadow-sm text-error">
                    <div class="flex items-center gap-space-sm">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        <span class="font-label-md font-bold">{{ $errors->first() }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md mb-space-xl">
                <div class="flex flex-col gap-space-xs">
                    <div class="flex items-center gap-space-xs">
                        <h1 class="font-headline-lg text-headline-lg text-on-surface">Kelola Koleksi Buku</h1>
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-surface-container-high text-primary font-label-sm">Katalog
                            Utama</span>
                    </div>
                    <p class="font-body-md text-on-surface-variant max-w-2xl">
                        Kelola data katalog, ketersediaan eksemplar, alokasi nomor rak, dan pemantauan status sirkulasi
                        buku.
                    </p>
                </div>
                <button onclick="openAddBookModal()"
                    class="flex items-center gap-space-xs px-4 py-2.5 bg-primary-container text-on-primary rounded-xl font-label-lg shadow-sm hover:brightness-105 active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span>+ Tambah Buku</span>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-md mb-space-lg">
                <div
                    class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="font-label-sm text-outline uppercase tracking-wider">Total Buku</span>
                        <span class="font-headline-md text-on-surface mt-0.5">{{ $totalBuku }} Judul</span>
                        <span class="font-body-sm text-outline mt-0.5">{{ $totalEksemplar }} total eksemplar</span>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-surface-container flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-[24px]">collections_bookmark</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="font-label-sm text-outline uppercase tracking-wider">Buku Siap Pinjam</span>
                        <span class="font-headline-md text-tertiary-container mt-0.5">{{ $siapPinjam }} Judul</span>
                        <span
                            class="font-body-sm text-tertiary mt-0.5">{{ $totalBuku > 0 ? round($siapPinjam / $totalBuku * 100) : 0 }}%
                            koleksi aktif</span>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-tertiary-container/10 flex items-center justify-center text-tertiary-container">
                        <span class="material-symbols-outlined text-[24px]">check_circle</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="font-label-sm text-outline uppercase tracking-wider">Stok Habis</span>
                        <span class="font-headline-md text-error mt-0.5">{{ $dipinjamPenuh }} Judul</span>
                        <span class="font-body-sm text-outline mt-0.5">Perlu pengadaan</span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-error-container/40 flex items-center justify-center text-error">
                        <span class="material-symbols-outlined text-[24px]">sync_alt</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="font-label-sm text-outline uppercase tracking-wider">Waiting List Aktif</span>
                        <span class="font-headline-md text-on-surface mt-0.5">{{ $waitingList }} Buku</span>
                        <span class="font-body-sm text-outline mt-0.5">Prioritas reservasi</span>
                    </div>
                    <div
                        class="w-11 h-11 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-[24px]">hourglass_top</span>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.books.index') }}"
                class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm mb-space-lg">
                <div class="flex flex-col lg:flex-row gap-space-md items-stretch lg:items-center justify-between">
                    <div class="relative flex-1">
                        <span
                            class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                        <input name="search" value="{{ request('search') }}"
                            class="w-full h-11 pl-11 pr-space-md bg-surface-container-low rounded-xl text-on-surface font-body-md focus:outline-none shadow-sm"
                            placeholder="Cari judul buku, ISBN, atau nama penulis..." />
                    </div>
                    <div class="flex flex-wrap items-center gap-space-sm">
                        <div class="relative min-w-[170px]">
                            <select name="category"
                                class="w-full h-11 pl-3.5 pr-8 appearance-none bg-surface-container-low rounded-xl font-label-md text-on-surface shadow-sm cursor-pointer">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-outline pointer-events-none">arrow_drop_down</span>
                        </div>
                        <div class="relative min-w-[150px]">
                            <select name="status"
                                class="w-full h-11 pl-3.5 pr-8 appearance-none bg-surface-container-low rounded-xl font-label-md text-on-surface shadow-sm cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="habis" {{ request('status') === 'habis' ? 'selected' : '' }}>Stok Habis
                                </option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[18px] text-outline pointer-events-none">arrow_drop_down</span>
                        </div>
                        <button type="submit"
                            class="h-11 px-4 bg-primary-container text-on-primary hover:bg-primary rounded-xl font-label-md shadow-sm">Cari</button>
                        <a href="{{ route('admin.books.index') }}"
                            class="h-11 px-3.5 bg-surface-container-low hover:bg-surface-container-high rounded-xl text-on-surface flex items-center gap-space-xs font-label-md shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">filter_alt_off</span>
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-surface-container-low text-on-surface-variant font-label-sm uppercase tracking-wider">
                                <th class="py-space-md px-space-md text-center w-12">No</th>
                                <th class="py-space-md px-space-lg min-w-[280px]">Judul & ISBN</th>
                                <th class="py-space-md px-space-md min-w-[200px]">Penulis & Penerbit</th>
                                <th class="py-space-md px-space-md min-w-[160px]">Kategori</th>
                                <th class="py-space-md px-space-md min-w-[150px]">Stok</th>
                                <th class="py-space-md px-space-md min-w-[130px]">Status</th>
                                <th class="py-space-md px-space-md text-center min-w-[120px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low font-body-sm">
                            @forelse($books as $i => $book)
                                @php
                                    $borrowed = $book->borrowings()->whereNull('returned_at')->count();
                                    $totalCopies = $book->stock + $borrowed;
                                    $percentage = $totalCopies > 0 ? round(($book->stock / $totalCopies) * 100) : 0;
                                    $queueCount = $book->queues()->count();
                                @endphp
                                <tr class="hover:bg-surface-container-low/60">
                                    <td class="py-space-md px-space-md text-center font-label-md text-outline">
                                        {{ $books->firstItem() + $i }}
                                    </td>
                                    <td class="py-space-md px-space-lg">
                                        <div class="flex items-center gap-space-md">
                                            <img class="w-12 h-16 object-cover rounded-lg shadow-sm"
                                                src="{{ $book->cover && str_starts_with($book->cover, 'http') ? $book->cover : ($book->cover ? asset('storage/' . $book->cover) : 'https://via.placeholder.com/200x280?text=No+Cover') }}"
                                                alt="{{ $book->title }}" />
                                            <div class="flex flex-col min-w-0">
                                                <span
                                                    class="font-headline-sm text-on-surface truncate">{{ $book->title }}</span>
                                                <span class="font-label-sm text-outline mt-0.5">ISBN:
                                                    {{ $book->isbn ?? '-' }}</span>
                                                <div class="flex items-center gap-space-xs mt-1">
                                                    <span
                                                        class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[13px]">pin_drop</span>
                                                        {{ $book->rack ?? '-' }}
                                                    </span>
                                                    <span class="text-outline text-[11px]">• {{ $book->year ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-space-md px-space-md">
                                        <div class="flex flex-col">
                                            <span class="font-label-lg text-on-surface">{{ $book->author }}</span>
                                            <span class="font-body-sm text-outline">{{ $book->publisher ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-space-md px-space-md">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full bg-surface-container-high text-primary font-label-sm">
                                            {{ $book->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-space-md px-space-md">
                                        <div class="flex flex-col gap-1.5 w-36">
                                            <div class="flex items-center justify-between text-label-sm">
                                                <span class="text-on-surface font-bold">{{ $book->stock }} /
                                                    {{ $totalCopies }}</span>
                                                <span
                                                    class="{{ $percentage > 50 ? 'text-tertiary-container' : ($percentage > 0 ? 'text-amber-600' : 'text-error') }} font-semibold">{{ $percentage }}%</span>
                                            </div>
                                            <div
                                                class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                                <div class="{{ $percentage > 50 ? 'bg-tertiary-container' : ($percentage > 0 ? 'bg-amber-500' : 'bg-error') }} h-full rounded-full"
                                                    style="width: {{ $percentage }}%;"></div>
                                            </div>
                                            <span class="text-[11px] text-outline">{{ $book->stock }} siap pinjam</span>
                                        </div>
                                    </td>
                                    <td class="py-space-md px-space-md">
                                        @if($book->stock > 0)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-container/15 text-tertiary-container font-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary-container"></span>
                                                Tersedia
                                            </span>
                                        @elseif($queueCount > 0)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                                Waiting ({{ $queueCount }})
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-error-container/60 text-error font-label-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                                Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-space-md px-space-md text-center">
                                        <div class="inline-flex items-center gap-1">
                                            <button onclick='openEditModal(@json($book))'
                                                class="w-8 h-8 rounded-lg flex items-center justify-center text-outline hover:text-primary hover:bg-surface-container"
                                                title="Ubah">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </button>
                                            <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus \'{{ addslashes($book->title) }}\'?')"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-outline hover:text-error hover:bg-error-container/40"
                                                    title="Hapus">
                                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center">
                                        <span
                                            class="material-symbols-outlined text-[48px] text-outline block mb-2">library_books</span>
                                        <p class="font-body-md text-secondary">Belum ada buku terdaftar.</p>
                                        <button onclick="openAddBookModal()"
                                            class="mt-3 px-4 py-2 bg-primary-container text-on-primary rounded-lg font-label-md">+
                                            Tambah Buku Pertama</button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($books->hasPages())
                    <div
                        class="p-space-md bg-surface-container-lowest flex flex-col sm:flex-row items-center justify-between gap-space-md border-t border-surface-container">
                        <span class="text-outline font-body-sm">Menampilkan <strong
                                class="text-on-surface">{{ $books->firstItem() ?? 0 }} -
                                {{ $books->lastItem() ?? 0 }}</strong> dari <strong
                                class="text-on-surface">{{ $books->total() }}</strong></span>
                        {{ $books->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    {{-- MODAL --}}
    <div class="fixed inset-0 z-50 hidden bg-inverse-surface/40 backdrop-blur-sm flex items-center justify-center p-space-md"
        id="bookModal">
        <form id="bookForm" method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data"
            class="bg-surface-container-lowest rounded-2xl w-full max-w-2xl max-h-[90vh] shadow-xl overflow-hidden flex flex-col">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <div class="px-space-xl py-space-lg bg-surface-container-low flex items-center justify-between">
                <div class="flex items-center gap-space-sm">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[22px]" id="modalIcon">library_add</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-on-surface" id="modalTitle">Tambah Buku</h3>
                        <p class="font-body-sm text-outline" id="modalSubtitle">Lengkapi metadata buku.</p>
                    </div>
                </div>
                <button type="button"
                    class="w-9 h-9 rounded-full flex items-center justify-center text-outline hover:bg-surface-container-high"
                    onclick="closeBookModal()">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <div class="p-space-xl overflow-y-auto flex flex-col gap-space-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Judul *</label>
                        <input name="title" id="f_title" required
                            class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">ISBN</label>
                        <input name="isbn" id="f_isbn" class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Penulis *</label>
                        <input name="author" id="f_author" required
                            class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Penerbit</label>
                        <input name="publisher" id="f_publisher"
                            class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Kategori *</label>
                        <select name="category_id" id="f_category" required
                            class="h-10 px-3 rounded-lg bg-surface-container-low">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Rak</label>
                        <input name="rack" id="f_rack" class="h-10 px-3 rounded-lg bg-surface-container-low"
                            placeholder="Rak A-01" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Stok *</label>
                        <input name="stock" id="f_stock" required min="0" type="number" value="1"
                            class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Tahun</label>
                        <input name="year" id="f_year" type="number"
                            class="h-10 px-3 rounded-lg bg-surface-container-low" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-sm">Cover (maks 2MB)</label>
                        <input name="cover" type="file" accept="image/*"
                            class="h-10 px-3 py-2 rounded-lg bg-surface-container-low file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-primary-container file:text-on-primary" />
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="font-label-sm">Deskripsi</label>
                    <textarea name="description" id="f_description" rows="3"
                        class="px-3 py-2 rounded-lg bg-surface-container-low"></textarea>
                </div>
            </div>
            <div class="p-space-lg bg-surface-container-low flex items-center justify-end gap-space-sm">
                <button type="button" class="px-4 py-2 rounded-xl hover:bg-surface-container-high"
                    onclick="closeBookModal()">Batal</button>
                <button type="submit"
                    class="px-5 py-2 rounded-xl bg-primary-container text-on-primary font-label-md shadow-sm"
                    id="submitBtn">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function openAddBookModal() {
            document.getElementById('bookForm').reset();
            document.getElementById('bookForm').action = '{{ route('admin.books.store') }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('modalTitle').textContent = 'Tambah Buku Baru';
            document.getElementById('modalIcon').textContent = 'library_add';
            document.getElementById('bookModal').classList.remove('hidden');
        }

        function openEditModal(book) {
            document.getElementById('bookForm').action = '/admin/books/' + book.id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('modalTitle').textContent = 'Edit: ' + book.title;
            document.getElementById('modalIcon').textContent = 'edit';
            document.getElementById('f_title').value = book.title || '';
            document.getElementById('f_isbn').value = book.isbn || '';
            document.getElementById('f_author').value = book.author || '';
            document.getElementById('f_publisher').value = book.publisher || '';
            document.getElementById('f_category').value = book.category_id || '';
            document.getElementById('f_rack').value = book.rack || '';
            document.getElementById('f_stock').value = book.stock || 0;
            document.getElementById('f_year').value = book.year || '';
            document.getElementById('f_description').value = book.description || '';
            document.getElementById('bookModal').classList.remove('hidden');
        }

        function closeBookModal() {
            document.getElementById('bookModal').classList.add('hidden');
        }
    </script>

</body>

</html>