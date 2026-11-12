<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Katalog Buku - LITERA</title>
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
                        "on-primary-fixed-variant": "#003ea8",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dbe1ff",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-secondary-fixed": "#111c2d",
                        "inverse-surface": "#213145",
                        "surface-bright": "#f8f9ff",
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
                        "surface-tint": "#0053db",
                        surface: "#f8f9ff",
                        "inverse-on-surface": "#eaf1ff",
                        secondary: "#545f73",
                        "on-secondary": "#ffffff",
                        "surface-container": "#e5eeff",
                        "secondary-fixed-dim": "#bcc7de",
                        "on-surface-variant": "#434655",
                        "on-secondary-fixed-variant": "#3c475a",
                        "surface-dim": "#cbdbf5",
                        "tertiary-container": "#007d55",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe",
                        error: "#ba1a1a",
                        "surface-container-high": "#dce9ff",
                        "on-primary-container": "#eeefff",
                        "on-surface": "#0b1c30",
                        "on-tertiary-fixed": "#002113",
                        primary: "#004ac6",
                        "on-tertiary-container": "#bdffdb",
                        "on-error-container": "#93000a",
                        outline: "#737686",
                        "on-tertiary": "#ffffff",
                        "on-secondary-container": "#586377",
                        "on-error": "#ffffff"
                    },
                    spacing: {
                        "gutter-sm": "0.75rem",
                        "margin-tablet": "1.5rem",
                        gutter: "1rem",
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

    {{-- SIDEBAR --}}
    @include('partials.siswa-sidebar')

    {{-- MAIN --}}
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <header
            class="fixed top-0 left-0 lg:left-72 right-0 h-16 pl-16 lg:pl-margin-tablet bg-surface-container-lowest/90 backdrop-blur-xl shadow-sm z-40 flex items-center justify-between px-margin-tablet">
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md">
                <span class="text-secondary">Portal Siswa</span>
                <span class="material-symbols-outlined text-[16px] text-outline">chevron_right</span>
                <span class="text-primary font-bold">Katalog Buku</span>
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

                {{-- Header --}}
                <section class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md mb-space-xl">
                    <div>
                        <div
                            class="flex items-center gap-space-xs text-primary font-label-md uppercase tracking-wider mb-space-xs">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span>
                            <span>Koleksi Terintegrasi Perpustakaan</span>
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Katalog Buku</h1>
                        <p class="font-body-md text-secondary mt-space-xs max-w-2xl">Jelajahi dan pinjam ribuan koleksi
                            bahan pustaka, e-book, dan literatur akademik terverifikasi.</p>
                    </div>
                    <div
                        class="flex items-center gap-space-sm px-space-md py-space-sm bg-surface-container-lowest rounded-full shadow-sm text-secondary font-label-md">
                        <span class="w-2.5 h-2.5 rounded-full bg-primary animate-pulse"></span>
                        <span>Menampilkan <strong class="text-on-surface font-bold">{{ $books->count() }}</strong> dari
                            <strong class="text-on-surface font-bold">{{ $totalBooks }}</strong> Koleksi</span>
                    </div>
                </section>

                {{-- Filter Bar --}}
                <form method="GET" action="{{ route('siswa.katalog') }}"
                    class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm mb-space-xl flex flex-col gap-space-md">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md items-center">
                        <div class="md:col-span-5 relative">
                            <span
                                class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                            <input name="search" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-surface-container-low rounded-lg font-body-md text-on-surface placeholder:text-outline focus:bg-surface-container-lowest outline-none transition-all"
                                placeholder="Cari judul buku, pengarang, atau ISBN..." type="text" />
                        </div>
                        <div class="md:col-span-3 relative">
                            <select name="category"
                                class="w-full px-3.5 py-2.5 bg-surface-container-low rounded-lg font-label-md text-on-surface appearance-none outline-none transition-all pr-8 cursor-pointer">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                        ({{ $cat->books_count }})
                                    </option>
                                @endforeach
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <div class="md:col-span-2 relative">
                            <select name="status"
                                class="w-full px-3.5 py-2.5 bg-surface-container-low rounded-lg font-label-md text-on-surface appearance-none outline-none transition-all pr-8 cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>
                                    Tersedia</option>
                                <option value="habis" {{ request('status') === 'habis' ? 'selected' : '' }}>Stok Habis
                                </option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">expand_more</span>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-space-xs px-4 py-2.5 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-lg transition-all shadow-sm active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">search</span>
                                <span>Cari</span>
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Grid Buku --}}
                @if ($books->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg mb-space-xl">
                        @foreach ($books as $book)
                            <a href="{{ route('siswa.detail', $book->id) }}"
                                class="group bg-surface-container-lowest rounded-xl p-space-md shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                                <div>
                                    <div
                                        class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container mb-space-md shadow-inner">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            src="{{ $book->cover ?? 'https://via.placeholder.com/300x400?text=No+Cover' }}"
                                            alt="{{ $book->title }}" />
                                        <div class="absolute top-2.5 left-2.5">
                                            <span
                                                class="px-2.5 py-1 rounded-full font-label-sm bg-surface-container-lowest/90 backdrop-blur-sm text-on-surface font-semibold shadow-sm">
                                                {{ $book->category->name ?? 'Tanpa Kategori' }}
                                            </span>
                                        </div>
                                        <div class="absolute top-2.5 right-2.5">
                                            @if ($book->stock > 0)
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm bg-tertiary-fixed text-tertiary font-bold shadow-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                                                    Tersedia ({{ $book->stock }})
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm bg-secondary-fixed text-on-secondary-fixed-variant font-bold shadow-sm">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                                    Habis
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="absolute bottom-2.5 left-2.5 right-2.5 flex items-center justify-between px-2.5 py-1 rounded bg-inverse-surface/85 backdrop-blur-sm text-inverse-on-surface font-label-sm">
                                            <span class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-tertiary-fixed text-[14px]">meeting_room</span>
                                                {{ $book->rack ?? 'Rak -' }}
                                            </span>
                                            <span class="flex items-center gap-0.5 text-amber-300">
                                                <span class="material-symbols-outlined text-[14px]"
                                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                                {{ number_format($book->rating, 1) }} ({{ $book->rating_count }})
                                            </span>
                                        </div>
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-on-surface line-clamp-2 leading-snug group-hover:text-primary transition-colors">
                                        {{ $book->title }}</h3>
                                    <p class="font-body-sm text-secondary mt-1 line-clamp-1">{{ $book->author }}</p>
                                    <p class="font-label-sm text-outline mt-0.5">ISBN: {{ $book->isbn ?? '-' }} •
                                        {{ $book->year }}</p>
                                </div>
                                <div class="mt-space-md pt-space-md flex items-center gap-space-xs">
                                    <div
                                        class="flex-1 py-2 px-3 bg-primary-container hover:bg-primary text-on-primary rounded-lg font-label-md flex items-center justify-center gap-1 shadow-sm transition-all">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        <span>Lihat Detail</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div
                        class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm flex flex-col sm:flex-row items-center justify-between gap-space-md mb-space-xl">
                        <span class="font-body-md text-secondary">
                            Menampilkan <strong class="text-on-surface">{{ $books->firstItem() ?? 0 }} -
                                {{ $books->lastItem() ?? 0 }}</strong> dari <strong
                                class="text-on-surface">{{ $books->total() }}</strong> koleksi
                        </span>
                        <div class="flex items-center gap-space-xs">
                            {{ $books->links('pagination::tailwind') }}
                        </div>
                    </div>
                @else
                    <div class="bg-surface-container-lowest rounded-xl p-12 shadow-sm text-center">
                        <span class="material-symbols-outlined text-[64px] text-outline">search_off</span>
                        <h3 class="font-headline-md text-on-surface mt-3">Tidak Ada Buku Ditemukan</h3>
                        <p class="font-body-md text-secondary mt-1">Coba ubah kata kunci atau filter pencarian Anda.
                        </p>
                    </div>
                @endif

            </div>
        </main>
    </div>
</body>

</html>
