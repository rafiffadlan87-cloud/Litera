<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_standard" name="shell-type" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col justify-between">
    <header
        class="fixed top-0 left-0 right-0 w-full z-50 bg-surface-container-lowest/95 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div
            class="h-16 max-w-7xl mx-auto px-margin lg:px-margin-tablet flex items-center justify-between gap-space-lg">
            <div class="flex items-center gap-space-lg">
                <a class="flex items-center gap-space-sm" data-path="home" href="#">
                    <img alt="Brand logo" class="h-8 w-auto object-contain"
                        src="https://lh3.googleusercontent.com/aida/AEtjO1U20eueRvINwtCvUQUrewyIAA52OGmrXDRnn1qPScIA-EeHM4-9wrMfAli4eM5vAPeABpF9CULDVLmnFxwS01wS0o4ruLhP4vchl1cOjLttB3ReibSZsAg6fA0PQb5aKDs5_EM4TL38g75xaTI2Uyw4Y66rGAo7aoSa5qyuSZHDvFKUU0cNgy3Cc8By-NHCTdZPRMLG-yzYMyY7qOqANWzgZ00u49m0oPSkcqjRUI47QLBqgdmRSroWP50" />
                </a>
                <nav class="hidden xl:flex items-center gap-space-lg ml-space-md"
                    data-active-classes="text-primary font-bold">
                    <a aria-current="page" class="transition-colors text-primary font-bold" data-path="home"
                        href="#">Home</a>
                    <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="katalog" href="#">Katalog</a>
                    <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="kategori" href="#">Kategori</a>
                    <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="tentang-kami" href="#">Tentang Kami</a>
                    <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="bantuan" href="#">Bantuan</a>
                </nav>
            </div>
            <div class="flex items-center gap-space-md flex-1 max-w-xs md:max-w-sm ml-auto mr-space-md">
                <div class="relative w-full">
                    <span
                        class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                    <input
                        class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-on-surface placeholder-outline font-body-sm text-body-sm focus:outline-none focus:bg-surface-container-lowest focus:shadow-[0_0_0_2px_#2563eb] transition-all"
                        placeholder="Cari judul buku, penulis, ISBN..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-space-sm">
                <a class="hidden sm:inline-flex items-center justify-center h-10 px-space-lg rounded-lg font-label-lg text-label-lg text-on-surface hover:bg-surface-container-low transition-colors"
                    data-path="masuk" href="#">Masuk</a>
                <a class="inline-flex items-center justify-center h-10 px-space-lg rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg hover:bg-primary shadow-[0_1px_3px_0_rgba(15,23,42,0.05)] transition-all active:scale-95"
                    data-path="daftar" href="#">Daftar</a>
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center ml-space-xs">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full pt-16 flex-1 bg-surface">
        <div class="flex flex-col w-full">
            <!-- Top Subtle Background Aura -->
            <div class="relative w-full overflow-hidden">
                <div
                    class="absolute -top-40 right-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl pointer-events-none -z-10">
                </div>
                <div
                    class="absolute top-80 -left-20 w-[450px] h-[450px] bg-tertiary/5 rounded-full blur-3xl pointer-events-none -z-10">
                </div>

                <!-- 1. HERO SECTION -->
                <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 lg:py-14 w-full">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <!-- Left Hero Content (7 Cols) -->
                        <div class="lg:col-span-7 flex flex-col gap-5">
                            <!-- Badge Pill -->
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed w-fit shadow-sm">
                                <span class="text-sm">✨</span>
                                <span class="font-label-md text-label-md tracking-tight">Platform Literasi Digital
                                    Modern</span>
                            </div>
                            <!-- Main Headline -->
                            <h1
                                class="font-headline-lg text-3xl sm:text-4xl lg:text-[44px] lg:leading-[52px] text-on-surface font-extrabold tracking-tight">
                                Membaca Hari Ini, <br class="hidden sm:inline" />
                                <span class="text-primary-container">Membangun Masa Depan</span>
                            </h1>
                            <!-- Description -->
                            <p class="font-body-lg text-body-lg text-secondary max-w-xl leading-relaxed">
                                Akses ribuan buku digital, jurnal ilmiah, dan bahan bacaan berkualitas kapan saja.
                                Pinjam buku dengan mudah dan pantau riwayat baca secara praktis melalui portal
                                perpustakaan terpadu.
                            </p>
                            <!-- Search Container Box -->
                            <div
                                class="bg-surface-container-lowest p-3 sm:p-4 rounded-xl shadow-md border-0 mt-2 flex flex-col gap-3">
                                <div class="flex flex-col sm:flex-row items-stretch gap-2.5">
                                    <div class="relative flex-1 flex items-center">
                                        <span
                                            class="material-symbols-outlined absolute left-3.5 text-secondary text-[22px]">search</span>
                                        <input
                                            class="w-full h-12 pl-11 pr-4 bg-surface-container-low text-on-surface placeholder-secondary font-body-md text-body-md rounded-lg focus:outline-none focus:bg-surface-container-lowest focus:shadow-[0_0_0_2px_#2563eb] transition-all"
                                            id="main-search-input"
                                            placeholder="Cari judul buku, penulis, kategori, atau nomor ISBN..."
                                            type="text" />
                                    </div>
                                    <button
                                        class="h-12 px-6 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg flex items-center justify-center gap-2 hover:bg-primary transition-all active:scale-[0.98] shadow-sm whitespace-nowrap"
                                        type="button">
                                        <span class="material-symbols-outlined text-[20px]">auto_stories</span>
                                        Cari Buku
                                    </button>
                                </div>
                                <!-- Quick Filter Chips -->
                                <div class="flex items-center gap-1.5 flex-wrap pt-1">
                                    <span class="font-label-sm text-label-sm text-secondary mr-1">Kategori
                                        Populer:</span>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm transition-all"
                                        data-category="all">Semua</button>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface font-label-sm text-label-sm transition-all"
                                        data-category="fiksi">Fiksi</button>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface font-label-sm text-label-sm transition-all"
                                        data-category="nonfiksi">Non Fiksi</button>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface font-label-sm text-label-sm transition-all"
                                        data-category="teknologi">Teknologi</button>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface font-label-sm text-label-sm transition-all"
                                        data-category="sains">Sains</button>
                                    <button
                                        class="filter-chip px-3 py-1 rounded-full bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface font-label-sm text-label-sm transition-all"
                                        data-category="bisnis">Bisnis</button>
                                </div>
                            </div>
                            <!-- Quick Metrics Stat Bar -->
                            <div class="grid grid-cols-3 gap-3 pt-3">
                                <div class="bg-surface-container-lowest/80 p-3 rounded-lg shadow-sm">
                                    <span
                                        class="font-headline-md text-headline-md text-primary-container font-extrabold block">12.400+</span>
                                    <span
                                        class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Koleksi
                                        Buku Digital</span>
                                </div>
                                <div class="bg-surface-container-lowest/80 p-3 rounded-lg shadow-sm">
                                    <span
                                        class="font-headline-md text-headline-md text-on-surface font-extrabold block">8.500+</span>
                                    <span
                                        class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Siswa
                                        &amp; Mahasiswa Aktif</span>
                                </div>
                                <div class="bg-surface-container-lowest/80 p-3 rounded-lg shadow-sm">
                                    <span
                                        class="font-headline-md text-headline-md text-tertiary-container font-extrabold block">98%</span>
                                    <span
                                        class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Tingkat
                                        Kepuasan</span>
                                </div>
                            </div>
                        </div>
                        <!-- Right Hero Visual Showcase (5 Cols) -->
                        <div class="lg:col-span-5 relative mt-4 lg:mt-0">
                            <div
                                class="relative bg-surface-container-lowest p-3 rounded-2xl shadow-xl overflow-visible">
                                <!-- Hero Photo Card -->
                                <div class="relative overflow-hidden rounded-xl aspect-[4/3] bg-surface-container-low">
                                    <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                        data-alt="Modern study table"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkBUF6s7UbTT5Lf59A4HnvrkNmmCvqcdsW2N0g6k4br17PR6pZyNBAVDCx6zA7Y4skIGmg3P4ZMpQBU7RdWarLJWqin1WKLhRDg_20nDKgTLUYxlUsQZ-pZpkWM8X164B0_J42EqqRbjYKf49cMKvVJ3fkW-QL8q5D4DrarS7MOpNxsEJASqry7EWSjMA-dHukVHIVX9-nYu96F0BYpUotIZJ3Jsg3BU_cN63XcVZVVuaV7t2dSkHK" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-inverse-surface/60 via-transparent to-transparent">
                                    </div>
                                    <!-- Floating Overlay Tags directly on top of image -->
                                    <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-tertiary-container shadow-sm">
                                            <span
                                                class="w-2 h-2 rounded-full bg-tertiary-container animate-pulse"></span>
                                            5.000+ Koleksi Aktif
                                        </span>
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-on-surface shadow-sm">
                                            <span class="text-amber-500 font-bold">⭐</span>
                                            Terakreditasi A
                                        </span>
                                    </div>
                                </div>
                                <!-- Floating Activity Notification Badge -->
                                <div class="mt-3 p-3 rounded-xl bg-surface-container-low/90 flex items-start gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-primary-fixed flex items-center justify-center shrink-0 mt-0.5">
                                        <span
                                            class="material-symbols-outlined text-primary-container text-[18px]">bookmark_added</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2">
                                            <span
                                                class="font-label-sm text-label-sm text-primary-container uppercase tracking-wider">Aktivitas
                                                Terkini</span>
                                            <span class="font-body-sm text-body-sm text-secondary text-[11px]">2 mnt
                                                lalu</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface truncate mt-0.5">
                                            <strong class="font-semibold">Filosofi Teras</strong> baru dipinjam oleh
                                            <span class="text-secondary">Rian (F. Teknik)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 2. POPULAR BOOKS SECTION -->
                <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-10 w-full">
                    <!-- Section Header -->
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-8">
                        <div>
                            <div
                                class="flex items-center gap-2 text-primary-container font-label-md text-label-md uppercase tracking-wider mb-1">
                                <span class="material-symbols-outlined text-[18px]">trending_up</span>
                                Rekomendasi Terbanyak
                            </div>
                            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                                Buku Populer Mingguan
                            </h2>
                            <p class="font-body-md text-body-md text-secondary mt-1">
                                Paling sering dibaca &amp; direkomendasikan oleh kurator perpustakaan
                            </p>
                        </div>
                        <a class="inline-flex items-center gap-1 font-label-lg text-label-lg text-primary-container hover:text-primary transition-colors group"
                            href="#">
                            Lihat Semua Katalog (120+)
                            <span
                                class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                    <!-- 5-Column Responsive Book Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                        <!-- Book Card 1: Laskar Pelangi -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div class="flex flex-col">
                                <!-- Cover image placeholder -->
                                <div
                                    class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container-low mb-3">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-alt="Book cover Laskar Pelangi"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7mIF6wGnzq_qi1mUxnR3jtUQqlR7qyRkpXUw-TZPYfWGq8ebN2eGLKud9DbTqkUxW41qWyzRkgdDwRm5Y11fIvBa-js87R9ULfu_XcxTFRqpu6fgwF5LS8IqwW8teSdV4zBbgVBM0tB-lwfOy4H_MTUfHG_SaKtKtmLs4fXxQJaASJBRCizay3eMO-PwHWtKmAaG-A-84Svw72Ry1BA9jFep6jzqthnx3oEmWzo_OMyLcHzYJ-Bsd" />
                                    <span
                                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">
                                        Fiksi
                                    </span>
                                </div>
                                <div class="flex items-center justify-between gap-1 mb-1">
                                    <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                        <span class="material-symbols-outlined text-[15px] fill-current"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        4.9 <span class="text-secondary font-normal">(420)</span>
                                    </span>
                                </div>
                                <h3
                                    class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                    Laskar Pelangi
                                </h3>
                                <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">
                                    Andrea Hirata
                                </p>
                                <!-- Status Badge: Tersedia -->
                                <div
                                    class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-label-sm text-label-sm w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Tersedia (8 Salinan)
                                </div>
                            </div>
                            <!-- Actions -->
                            <div class="flex items-center gap-2 mt-4 pt-2">
                                <button
                                    class="flex-1 h-10 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors flex items-center justify-center gap-1 shadow-sm active:scale-95">
                                    Pinjam Buku
                                </button>
                                <button
                                    class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                    title="Simpan ke favorit">
                                    <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                </button>
                            </div>
                        </div>
                        <!-- Book Card 2: Filosofi Teras -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div class="flex flex-col">
                                <div
                                    class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container-low mb-3">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-alt="Book cover Filosofi Teras"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqJ0iK1kOZKim2TJ_T4j9iKLd34jLlByHugHUuFDC58Kny4AkP2PF3VhCgG_YR6LaAmXBSuxGXti31GtZdQ3jwV0MxjLzzr3AxrbzmgvFKFP7arMnc4sdlW2qNL-OIK-GhtS9V_FItuRDbu-xwHo-kPuxERLKbmRV75Q-XT684Ed84DyTbFGRZ0_Fo35uOTfUsKrOS3gqgjJz6RTtfDseiZ4yv4lt8wA8nom13PvlugyzRzY_2QjEA" />
                                    <span
                                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">
                                        Non Fiksi
                                    </span>
                                </div>
                                <div class="flex items-center justify-between gap-1 mb-1">
                                    <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                        <span class="material-symbols-outlined text-[15px] fill-current"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        4.8 <span class="text-secondary font-normal">(380)</span>
                                    </span>
                                </div>
                                <h3
                                    class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                    Filosofi Teras
                                </h3>
                                <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">
                                    Henry Manampiring
                                </p>
                                <div
                                    class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-label-sm text-label-sm w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Tersedia (4 Salinan)
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4 pt-2">
                                <button
                                    class="flex-1 h-10 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors flex items-center justify-center gap-1 shadow-sm active:scale-95">
                                    Pinjam Buku
                                </button>
                                <button
                                    class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                    title="Simpan ke favorit">
                                    <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                </button>
                            </div>
                        </div>
                        <!-- Book Card 3: Atomic Habits -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div class="flex flex-col">
                                <div
                                    class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container-low mb-3">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-alt="Book cover Atomic Habits"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCa2L3iibu4LGuTehQfLDX2x10Bq96GJvWlA5hRmDeretfR4mHT_vOJZnmXEE3iJ5ZjV0fXJjnktLwj6pvGUZCqbNY5ZIcOrgN0UuNODOA6CplH913i8sMkDw5tvyiDY9SadXijAeNqsuxyQlXLN_BiG0rMZVSq3VycDDlcA_iz6VSm0cFW_rR9y2edndIqSOJfTJfM1Halpfn9Hv0BZoyi3rD6m04HZFLwIn_o4beHFBbv2KCe_umv" />
                                    <span
                                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">
                                        Self Help
                                    </span>
                                </div>
                                <div class="flex items-center justify-between gap-1 mb-1">
                                    <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                        <span class="material-symbols-outlined text-[15px] fill-current"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        5.0 <span class="text-secondary font-normal">(610)</span>
                                    </span>
                                </div>
                                <h3
                                    class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                    Atomic Habits
                                </h3>
                                <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">
                                    James Clear
                                </p>
                                <!-- Status Badge: Antrean (Amber) -->
                                <div
                                    class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 font-label-sm text-label-sm w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Antrean: 3 Orang
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4 pt-2">
                                <button
                                    class="flex-1 h-10 rounded-lg bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors flex items-center justify-center gap-1 active:scale-95">
                                    Masuk Antrean
                                </button>
                                <button
                                    class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                    title="Simpan ke favorit">
                                    <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                </button>
                            </div>
                        </div>
                        <!-- Book Card 4: Bumi Manusia -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div class="flex flex-col">
                                <div
                                    class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container-low mb-3">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-alt="Book cover Bumi Manusia"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBo9NzOtPeOmc67HI428NSRxtFfTNwG7E4YaYidKuNrBXsd7SWO7_xKlOI1Pk8MfvlaXIHxnaWjbwv-MKnU_9F_JZZAoc1aZzmbgOAM0YF-iPxyZRbeydo7zXHI0xl7fMyy3H5l6xvXt7to0_kFy63o7oPTSudRe7rgZee-ovhoWyQPkv3bydaZX-9yVytisaZKtayyViIXquFl35KFDlGbmjX_7l962YCdHZ_cV1YRPcNCxffFfrz6" />
                                    <span
                                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">
                                        Sejarah
                                    </span>
                                </div>
                                <div class="flex items-center justify-between gap-1 mb-1">
                                    <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                        <span class="material-symbols-outlined text-[15px] fill-current"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        4.9 <span class="text-secondary font-normal">(512)</span>
                                    </span>
                                </div>
                                <h3
                                    class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                    Bumi Manusia
                                </h3>
                                <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">
                                    Pramoedya Ananta Toer
                                </p>
                                <!-- Status Badge: Dipinjam (Soft Rose) -->
                                <div
                                    class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 font-label-sm text-label-sm w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Dipinjam (Kembali 4 hr)
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4 pt-2">
                                <button
                                    class="flex-1 h-10 rounded-lg bg-surface-container-low text-secondary font-label-md text-label-md hover:bg-surface-container hover:text-on-surface transition-colors flex items-center justify-center gap-1 active:scale-95">
                                    Ingatkan Saya
                                </button>
                                <button
                                    class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                    title="Simpan ke favorit">
                                    <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                </button>
                            </div>
                        </div>
                        <!-- Book Card 5: Kecerdasan Buatan -->
                        <div
                            class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                            <div class="flex flex-col">
                                <div
                                    class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-surface-container-low mb-3">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        data-alt="Book cover Kecerdasan Buatan"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpWi_T6oHCXG8yjfg0Q9dixfFAIRM1AFU-HK5hhXLxHRNOa85_mQ6xPm7MatWejXh7aSvFuR8u0bQSwmt42mQIoYL3g6K0kofjroWI4y4rtNBgclg-EgvpcdbmBLoeF1n8i7ZOjCa81n0XNFmfLLdOq-3XjtFZowhIJa-L97DMQPxtcwvEC-9Gcz62InGKp2ocF3JLN0CnboZCmrKlCzsF4Dk_xC4axJFNyFdg8QzstCqLP-mTJH1Q" />
                                    <span
                                        class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">
                                        Teknologi
                                    </span>
                                </div>
                                <div class="flex items-center justify-between gap-1 mb-1">
                                    <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                        <span class="material-symbols-outlined text-[15px] fill-current"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        4.7 <span class="text-secondary font-normal">(245)</span>
                                    </span>
                                </div>
                                <h3
                                    class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                    Kecerdasan Buatan &amp; Masa Depan
                                </h3>
                                <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">
                                    Dr. Ir. Rian Pratama
                                </p>
                                <div
                                    class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-label-sm text-label-sm w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    Tersedia (2 Salinan)
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4 pt-2">
                                <button
                                    class="flex-1 h-10 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors flex items-center justify-center gap-1 shadow-sm active:scale-95">
                                    Pinjam Buku
                                </button>
                                <button
                                    class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                    title="Simpan ke favorit">
                                    <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 3. HOW IT WORKS / ALUR PEMINJAMAN SECTION -->
                <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-12 w-full">
                    <div class="text-center max-w-2xl mx-auto mb-10">
                        <span
                            class="font-label-md text-label-md text-primary-container uppercase tracking-wider font-semibold">
                            Proses Cepat &amp; Praktis
                        </span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mt-1">
                            Alur Peminjaman Mudah
                        </h2>
                        <p class="font-body-md text-body-md text-secondary mt-2">
                            Nikmati pengalaman membaca terintegrasi dari mana saja dalam 3 langkah sederhana.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Step 1 -->
                        <div
                            class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow relative flex flex-col gap-4 group">
                            <div class="flex items-center justify-between">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary-fixed text-primary-container flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[26px]">manage_search</span>
                                </div>
                                <span
                                    class="font-headline-lg text-3xl font-black text-surface-container tracking-tighter">01</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">
                                    Temukan Buku Favorit
                                </h3>
                                <p class="font-body-md text-body-md text-secondary mt-2 leading-relaxed">
                                    Jelajahi ribuan judul referensi lewat kolom pencarian pintar atau filter kategori
                                    perpustakaan secara spesifik.
                                </p>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div
                            class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow relative flex flex-col gap-4 group">
                            <div class="flex items-center justify-between">
                                <div
                                    class="w-12 h-12 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[26px]">touch_app</span>
                                </div>
                                <span
                                    class="font-headline-lg text-3xl font-black text-surface-container tracking-tighter">02</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">
                                    Ajukan Pinjam 1-Klik
                                </h3>
                                <p class="font-body-md text-body-md text-secondary mt-2 leading-relaxed">
                                    Klik tombol pinjam dengan akun siswa/mahasiswa tanpa formulir manual yang rumit dan
                                    tanpa antrean panjang.
                                </p>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div
                            class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow relative flex flex-col gap-4 group">
                            <div class="flex items-center justify-between">
                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[26px]">devices</span>
                                </div>
                                <span
                                    class="font-headline-lg text-3xl font-black text-surface-container tracking-tighter">03</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">
                                    Baca Digital / Ambil Fisik
                                </h3>
                                <p class="font-body-md text-body-md text-secondary mt-2 leading-relaxed">
                                    Akses langsung e-book di web reader responsif atau scan barcode konfirmasi ke meja
                                    sirkulasi fisik di kampus.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 4. CALL TO ACTION BANNER -->
                <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 lg:pb-16 w-full">
                    <div
                        class="relative rounded-2xl bg-inverse-surface text-inverse-on-surface overflow-hidden p-8 sm:p-12 shadow-xl">
                        <!-- Ambient subtle glow element within banner -->
                        <div
                            class="absolute -top-24 -right-24 w-96 h-96 bg-primary-container/20 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute -bottom-24 -left-24 w-80 h-80 bg-tertiary-container/20 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                            <div class="max-w-2xl">
                                <div
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm text-white font-label-sm text-label-sm mb-4">
                                    <span class="material-symbols-outlined text-[16px] text-amber-400">verified</span>
                                    Keanggotaan Terintegrasi Bebas Biaya
                                </div>
                                <h2
                                    class="font-headline-lg text-2xl sm:text-3xl lg:text-4xl text-white font-extrabold tracking-tight leading-tight">
                                    Siap Memulai Petualangan Membaca?
                                </h2>
                                <p class="font-body-lg text-body-lg text-slate-300 mt-3 leading-relaxed">
                                    Aktifkan kartu anggota digitalmu hari ini dan nikmati batas peminjaman hingga 5 buku
                                    sekaligus tanpa biaya registrasi.
                                </p>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row lg:flex-col items-start sm:items-center lg:items-end gap-3 shrink-0">
                                <a class="h-12 px-7 rounded-xl bg-primary-container text-on-primary font-label-lg text-label-lg flex items-center justify-center gap-2 hover:bg-primary transition-all active:scale-95 shadow-lg shadow-primary/25 whitespace-nowrap"
                                    href="#">
                                    <span>Daftar Akun Anggota Gratis</span>
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                                <span class="font-body-sm text-body-sm text-slate-400">
                                    Sudah punya akun?
                                    <a class="text-white hover:underline font-semibold ml-1" href="#">Masuk di
                                        sini</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="w-full bg-surface-container-lowest mt-auto shadow-[0_-1px_8px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-space-xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-space-xl mb-space-xl">
                <div class="flex flex-col gap-space-md md:col-span-1">
                    <div class="flex items-center gap-space-sm">
                        <img alt="Brand logo" class="h-7 w-auto object-contain"
                            src="https://lh3.googleusercontent.com/aida/AEtjO1U20eueRvINwtCvUQUrewyIAA52OGmrXDRnn1qPScIA-EeHM4-9wrMfAli4eM5vAPeABpF9CULDVLmnFxwS01wS0o4ruLhP4vchl1cOjLttB3ReibSZsAg6fA0PQb5aKDs5_EM4TL38g75xaTI2Uyw4Y66rGAo7aoSa5qyuSZHDvFKUU0cNgy3Cc8By-NHCTdZPRMLG-yzYMyY7qOqANWzgZ00u49m0oPSkcqjRUI47QLBqgdmRSroWP50" />
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Akses ribuan buku, jurnal akademik,
                        dan publikasi ilmiah terverifikasi secara digital untuk kemajuan literasi masa depan.</p>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Layanan Koleksi</span>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="katalog" href="#">Katalog Buku Populer</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="kategori" href="#">Kategori &amp; Topik</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="bantuan" href="#">Prosedur Peminjaman</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="katalog" href="#">Pustaka Digital Siswa</a>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Pusat Informasi</span>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="tentang-kami" href="#">Tentang Smart Library</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="bantuan" href="#">Pusat Bantuan &amp; FAQ</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="tentang-kami" href="#">Kebijakan Privasi</a>
                    <a class="font-body-md text-body-md text-on-surface-variant hover:text-on-surface transition-colors"
                        data-path="bantuan" href="#">Syarat &amp; Ketentuan</a>
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
                <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 Smart Library. Hak Cipta Dilindungi
                    Undang-Undang.</p>
                <div class="flex items-center gap-space-md">
                    <span
                        class="font-label-sm text-label-sm text-tertiary-container bg-surface-container px-space-sm py-space-xs rounded-full">Sistem
                        Perpustakaan Aktif</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple interactive category chip toggling
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
