<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Smart Library — Perpustakaan Digital')</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col justify-between">
    <header
        class="fixed top-0 left-0 right-0 w-full z-50 bg-surface-container-lowest/95 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-16 max-w-7xl mx-auto px-margin lg:px-margin-tablet flex items-center justify-between gap-space-lg">
            <div class="flex items-center gap-space-lg">
                <a class="flex items-center gap-space-sm" href="{{ route('home') }}" aria-label="Beranda Smart Library">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-primary text-[20px]">menu_book</span>
                    </div>
                    <span class="hidden md:block font-headline-sm text-headline-sm font-bold text-on-surface">Smart
                        Library</span>
                </a>
                <nav class="hidden xl:flex items-center gap-space-lg ml-space-md">
                    <a href="{{ route('home') }}" @class([
                        'transition-colors text-primary font-bold' => request()->routeIs('home'),
                        'font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors' => !request()->routeIs('home'),
                    ]) @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>

                    <a href="{{ route('katalog') }}" @class([
                        'transition-colors text-primary font-bold' => request()->routeIs('katalog'),
                        'font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors' => !request()->routeIs('katalog'),
                    ]) @if (request()->routeIs('katalog')) aria-current="page" @endif>Katalog</a>

                    <a href="{{ route('kategori') }}" @class([
                        'transition-colors text-primary font-bold' => request()->routeIs('kategori'),
                        'font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors' => !request()->routeIs('kategori'),
                    ]) @if (request()->routeIs('kategori')) aria-current="page" @endif>Kategori</a>

                    <a href="{{ route('tentang-kami') }}" @class([
                        'transition-colors text-primary font-bold' => request()->routeIs('tentang-kami'),
                        'font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors' => !request()->routeIs('tentang-kami'),
                    ]) @if (request()->routeIs('tentang-kami')) aria-current="page" @endif>Tentang Kami</a>

                    <a href="{{ route('bantuan') }}" @class([
                        'transition-colors text-primary font-bold' => request()->routeIs('bantuan'),
                        'font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors' => !request()->routeIs('bantuan'),
                    ]) @if (request()->routeIs('bantuan')) aria-current="page" @endif>Bantuan</a>
                </nav>
            </div>

            {{-- Search navbar: benar-benar mencari ke halaman Katalog --}}
            <div class="flex items-center gap-space-md flex-1 max-w-xs md:max-w-sm ml-auto mr-space-md">
                <form action="{{ route('katalog') }}" method="GET" role="search" class="relative w-full">
                    <span
                        class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-outline text-[20px] pointer-events-none">search</span>
                    <input name="q" value="{{ request('q') }}"
                        class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-on-surface placeholder-outline font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest focus:shadow-[0_0_0_2px_#2563eb] transition-all"
                        placeholder="Cari judul buku, penulis, ISBN..." type="text" />
                </form>
            </div>

            <div class="flex items-center gap-space-sm">
                @guest
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex items-center justify-center h-10 px-space-lg rounded-lg font-label-lg text-label-lg text-on-surface hover:bg-surface-container-low transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center h-10 px-space-lg rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary shadow-[0_1px_3px_0_rgba(15,23,42,0.05)] transition-all active:scale-95">
                        Daftar
                    </a>
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center ml-space-xs">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                    </div>
                @else
                    <span class="hidden sm:block font-label-lg text-on-surface font-semibold">Halo,
                        {{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center ml-space-xs"
                        title="{{ Auth::user()->name }}">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                    </div>
                    <a href="{{ route('siswa.dashboard') }}"
                        class="hidden md:inline-flex items-center justify-center h-10 px-space-lg rounded-lg bg-emerald-500 text-white font-label-lg text-label-lg hover:bg-emerald-600 shadow-[0_1px_3px_0_rgba(15,23,42,0.05)] transition-all active:scale-95">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center justify-center h-10 px-space-lg rounded-lg bg-rose-500 text-white font-label-lg text-label-lg hover:bg-rose-600 shadow-[0_1px_3px_0_rgba(15,23,42,0.05)] transition-all active:scale-95">
                            Logout
                        </button>
                    </form>
                @endguest

                {{-- Tombol menu mobile --}}
                <button id="mobile-menu-btn" aria-expanded="false" aria-controls="mobile-menu"
                    class="xl:hidden w-10 h-10 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-on-surface flex items-center justify-center transition-colors">
                    <span id="mobile-menu-icon" class="material-symbols-outlined text-[22px]">menu</span>
                </button>
            </div>
        </div>

        {{-- Panel menu mobile --}}
        <div id="mobile-menu"
            class="hidden xl:hidden border-t border-surface-container bg-surface-container-lowest px-margin py-space-md flex flex-col gap-1">
            @foreach ([
                'home' => ['Home', route('home')],
                'katalog' => ['Katalog', route('katalog')],
                'kategori' => ['Kategori', route('kategori')],
                'tentang-kami' => ['Tentang Kami', route('tentang-kami')],
                'bantuan' => ['Bantuan', route('bantuan')],
            ] as $route => [$label, $url])
                <a href="{{ $url }}" @class([
                    'px-3 py-2.5 rounded-lg font-label-lg text-label-lg transition-colors',
                    'bg-primary-fixed text-primary font-bold' => request()->routeIs($route),
                    'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' => !request()->routeIs($route),
                ])>{{ $label }}</a>
            @endforeach
        </div>
    </header>

    <main class="w-full pt-16 flex-1 bg-surface">
        @yield('content')
    </main>

    <footer class="w-full bg-surface-container-lowest mt-auto shadow-[0_-1px_8px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-space-xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-space-xl mb-space-xl">
                <div class="flex flex-col gap-space-md md:col-span-1">
                    <div class="flex items-center gap-space-sm">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-primary text-[20px]">menu_book</span>
                        </div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Akses ribuan buku, jurnal akademik,
                        dan publikasi ilmiah terverifikasi secara digital untuk kemajuan literasi masa depan.</p>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Layanan Koleksi</span>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('katalog') }}">Katalog Buku Populer</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('kategori') }}">Kategori &amp; Topik</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('bantuan') }}">Prosedur Peminjaman</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('katalog') }}">Pustaka Digital Siswa</a>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Pusat Informasi</span>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('tentang-kami') }}">Tentang Smart Library</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('bantuan') }}">Pusat Bantuan &amp; FAQ</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('tentang-kami') }}">Kebijakan Privasi</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        href="{{ route('bantuan') }}">Syarat &amp; Ketentuan</a>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Kontak Layanan</span>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Gedung Pustaka Pusat Lt. 3, Jl.
                        Pendidikan No. 12, Jakarta</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Email: bantuan@smartlibrary.id</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Telp: (021) 555-8920</p>
                </div>
            </div>
            <div class="pt-space-lg flex flex-col sm:flex-row items-center justify-between gap-space-md">
                <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 Smart Library. Hak Cipta
                    Dilindungi Undang-Undang.</p>
                <div class="flex items-center gap-space-md">
                    <span
                        class="font-label-sm text-label-sm text-tertiary-container bg-surface-container px-space-sm py-space-xs rounded-full">Sistem
                        Perpustakaan Aktif</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle menu mobile
        const mobileMenuButton = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                const isOpen = !mobileMenu.classList.toggle('hidden');
                mobileMenuButton.setAttribute('aria-expanded', isOpen);
                mobileMenuIcon.textContent = isOpen ? 'close' : 'menu';
            });
        }

        // Category chip toggling (dipakai di home & katalog)
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.filter-chip').forEach(c => {
                    c.classList.remove('bg-primary-container', 'text-on-primary');
                    c.classList.add('bg-surface-container-low', 'text-secondary');
                });
                this.classList.remove('bg-surface-container-low', 'text-secondary');
                this.classList.add('bg-primary-container', 'text-on-primary');
            });
        });

        // Bookmark toggle micro-interaction
        document.querySelectorAll('button[title="Simpan ke favorit"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('.material-symbols-outlined');
                if (icon.textContent === 'bookmark_border') {
                    icon.textContent = 'bookmark';
                    icon.classList.add('text-primary-container');
                    icon.style.fontVariationSettings = "'FILL' 1";
                } else {
                    icon.textContent = 'bookmark_border';
                    icon.classList.remove('text-primary-container');
                    icon.style.fontVariationSettings = "'FILL' 0";
                }
            });
        });
    </script>
</body>

</html>