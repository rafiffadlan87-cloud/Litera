@extends('layouts.public')

@section('title', 'Tentang Kami — Smart Library')

@section('content')
    <div class="flex flex-col w-full">
        <div class="relative w-full overflow-hidden">
            <div class="absolute -top-40 right-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

            {{-- Breadcrumb --}}
            <div class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pt-6 w-full">
                <nav aria-label="Breadcrumb" class="flex items-center gap-1 font-body-sm text-body-sm text-secondary">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">home</span>Home
                    </a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface font-semibold" aria-current="page">Tentang Kami</span>
                </nav>
            </div>

            {{-- 1. HERO PROFIL --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 lg:py-12 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 flex flex-col gap-5">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed w-fit shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">diversity_3</span>
                            <span class="font-label-md text-label-md tracking-tight">Profil Perpustakaan</span>
                        </div>
                        <h1
                            class="font-headline-lg text-3xl sm:text-4xl lg:text-[40px] lg:leading-[48px] text-on-surface font-extrabold tracking-tight">
                            Rumah Literasi Digital <span class="text-primary-container">Seluruh Warga Sekolah</span>
                        </h1>
                        <p class="font-body-lg text-body-lg text-secondary max-w-xl leading-relaxed">
                            Smart Library berdiri sejak 1999 sebagai unit pelayanan teknis bidang pustaka. Pada 2023 kami
                            bertransformasi menjadi perpustakaan hibrida: koleksi fisik tetap beredar, sekaligus ribuan
                            judul tersedia dalam format digital yang dapat diakses 24 jam dari mana saja.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface">
                                <span class="text-amber-500 font-bold">⭐</span> Terakreditasi A
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface">
                                <span class="material-symbols-outlined text-[16px] text-emerald-600">verified</span> Koleksi
                                Terverifikasi
                            </span>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface">
                                <span class="material-symbols-outlined text-[16px] text-primary-container">schedule</span>
                                Akses Digital 24/7
                            </span>
                        </div>
                    </div>
                    <div class="lg:col-span-5 grid grid-cols-2 gap-3">
                        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm">
                            <span
                                class="font-headline-md text-headline-md text-primary-container font-extrabold block">12.400+</span>
                            <span class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Koleksi Buku
                                Digital</span>
                        </div>
                        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm">
                            <span class="font-headline-md text-headline-md text-on-surface font-extrabold block">8.500+</span>
                            <span class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Anggota
                                Aktif</span>
                        </div>
                        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm">
                            <span
                                class="font-headline-md text-headline-md text-tertiary-container font-extrabold block">98%</span>
                            <span class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Tingkat
                                Kepuasan</span>
                        </div>
                        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm">
                            <span class="font-headline-md text-headline-md text-on-surface font-extrabold block">25+</span>
                            <span class="font-body-sm text-body-sm text-secondary leading-tight block mt-0.5">Tahun
                                Melayani</span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. VISI & MISI --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-10 w-full">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span
                        class="font-label-md text-label-md text-primary-container uppercase tracking-wider font-semibold">Arah
                        Layanan</span>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mt-1">Visi &amp; Misi</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-fixed text-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-[26px]">visibility</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Visi</h3>
                        <p class="font-body-md text-body-md text-secondary leading-relaxed">
                            Menjadi pusat literasi digital sekolah yang inklusif, modern, dan terpercaya dalam menopang
                            prestasi akademik serta kebiasaan membaca sepanjang hayat.
                        </p>
                    </div>
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined text-[26px]">flag</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Misi</h3>
                        <ol class="list-decimal list-inside font-body-md text-body-md text-secondary leading-relaxed space-y-1.5">
                            <li>Menyediakan koleksi buku digital dan fisik yang relevan dengan kurikulum.</li>
                            <li>Mempermudah proses peminjaman dan pengembalian.</li>
                            <li>Menghadirkan ruang baca nyaman fisik maupun daring.</li>
                            <li>Mengedukasi warga sekolah tentang literasi informasi yang sehat.</li>
                        </ol>
                    </div>
                </div>
            </section>

            {{-- 3. NILAI LAYANAN --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-10 w-full">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-fixed text-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-[26px]">public</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Aksesibilitas</h3>
                        <p class="font-body-md text-body-md text-secondary leading-relaxed">Koleksi digital terbuka 24 jam
                            bagi seluruh anggota terdaftar, tanpa batas jarak dan waktu.</p>
                    </div>
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined text-[26px]">verified_user</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Integritas</h3>
                        <p class="font-body-md text-body-md text-secondary leading-relaxed">Seluruh metadata buku dan riwayat
                            sirkulasi tercatat rapi serta dapat diaudit kapan pun.</p>
                    </div>
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex flex-col gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[26px]">rocket_launch</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Inovasi</h3>
                        <p class="font-body-md text-body-md text-secondary leading-relaxed">Terus mengadopsi teknologi
                            terbaru: web reader, notifikasi pengingat, dan katalog pintar.</p>
                    </div>
                </div>
            </section>

            {{-- 4. TIM PENGELOLA --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-10 w-full">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span
                        class="font-label-md text-label-md text-primary-container uppercase tracking-wider font-semibold">Orang
                        di Balik Layanan</span>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mt-1">Tim Pengelola
                        Perpustakaan</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ([
                        ['inisial' => 'RD', 'nama' => 'Dra. Ratna Dewita, M.Pd.', 'peran' => 'Kepala Perpustakaan', 'deskripsi' => 'Memimpin transformasi digital pustaka sejak 2023.', 'gradien' => 'from-sky-500 to-indigo-600'],
                        ['inisial' => 'BS', 'nama' => 'Bambang Sutrisno, S.IIP.', 'peran' => 'Staff Sirkulasi', 'deskripsi' => 'Mengurus peminjaman, pengembalian, dan bebas denda.', 'gradien' => 'from-teal-500 to-emerald-700'],
                        ['inisial' => 'SL', 'nama' => 'Sinta Larasati, S.IP.', 'peran' => 'Pustakawan Koleksi Digital', 'deskripsi' => 'Kurasi e-book, jurnal, dan berkas bacaan daring.', 'gradien' => 'from-amber-500 to-orange-600'],
                        ['inisial' => 'AW', 'nama' => 'Andi Wijaya, S.Kom.', 'peran' => 'Administrator Sistem', 'deskripsi' => 'Menjaga aplikasi Smart Library tetap cepat dan aman.', 'gradien' => 'from-violet-500 to-purple-700'],
                    ] as $t)
                        <div
                            class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center gap-3">
                            <div
                                class="w-16 h-16 rounded-full bg-gradient-to-br {{ $t['gradien'] }} flex items-center justify-center">
                                <span class="font-headline-sm text-headline-sm text-white font-bold">{{ $t['inisial'] }}</span>
                            </div>
                            <div>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">{{ $t['nama'] }}</h3>
                                <p class="font-label-md text-label-md text-primary-container mt-0.5">{{ $t['peran'] }}</p>
                                <p class="font-body-sm text-body-sm text-secondary mt-2 leading-relaxed">{{ $t['deskripsi'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- 5. CTA --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 lg:pb-16 w-full">
                <div class="relative rounded-2xl bg-inverse-surface text-inverse-on-surface overflow-hidden p-8 sm:p-12 shadow-xl">
                    <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-container/20 rounded-full blur-3xl pointer-events-none">
                    </div>
                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                        <div class="max-w-2xl">
                            <h2 class="font-headline-lg text-2xl sm:text-3xl text-white font-extrabold tracking-tight leading-tight">
                                Mari Tumbuh Bersama Smart Library</h2>
                            <p class="font-body-lg text-body-lg text-slate-300 mt-3 leading-relaxed">Jelajahi katalog kami
                                atau hubungi tim pengelola bila membutuhkan rekomendasi bacaan sesuai jurusanmu.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                            <a class="h-12 px-7 rounded-xl bg-primary-container text-on-primary font-label-lg text-label-lg flex items-center justify-center gap-2 hover:bg-primary transition-all active:scale-95 shadow-lg whitespace-nowrap"
                                href="{{ route('katalog') }}">
                                <span>Buka Katalog</span>
                                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                            <a class="h-12 px-7 rounded-xl bg-white/10 text-white font-label-lg text-label-lg flex items-center justify-center gap-2 hover:bg-white/20 transition-all active:scale-95 whitespace-nowrap"
                                href="{{ route('bantuan') }}">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection 