@extends('layouts.public')

@section('title', 'Kategori & Topik — Smart Library')

@section('content')
    <div class="flex flex-col w-full">
        <div class="relative w-full overflow-hidden">
            <div class="absolute top-80 -left-20 w-[450px] h-[450px] bg-tertiary/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

            {{-- Breadcrumb --}}
            <div class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pt-6 w-full">
                <nav aria-label="Breadcrumb" class="flex items-center gap-1 font-body-sm text-body-sm text-secondary">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">home</span>Home
                    </a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface font-semibold" aria-current="page">Kategori &amp; Topik</span>
                </nav>
            </div>

            {{-- Header --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 w-full text-center">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed w-fit shadow-sm mb-3">
                    <span class="material-symbols-outlined text-[16px]">category</span>
                    <span class="font-label-md text-label-md tracking-tight">Navigasi Koleksi</span>
                </div>
                <h1 class="font-headline-lg text-3xl lg:text-4xl text-on-surface font-extrabold tracking-tight">Kategori &amp; Topik Buku</h1>
                <p class="font-body-md text-body-md text-secondary mt-3 max-w-2xl mx-auto">
                    Telusuri koleksi berdasarkan bidang minat. Setiap kategori terhubung langsung ke katalog buku yang
                    sudah dikurasi oleh pustakawan.
                </p>
            </section>

            {{-- Grid Kategori --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pb-14 w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($categories as $c)
                        <a href="{{ route('katalog', ['kategori' => $c['slug']]) }}"
                            class="group bg-surface-container-lowest rounded-2xl p-6 shadow-sm hover:shadow-md transition-all flex flex-col gap-4">
                            <div class="flex items-start justify-between">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $c['gradien'] }} flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-white text-[24px]">{{ $c['ikon'] }}</span>
                                </div>
                                <span
                                    class="px-2.5 py-1 rounded-full bg-surface-container-low text-secondary font-label-sm text-label-sm">
                                    {{ $c['jumlah'] }} judul
                                </span>
                            </div>
                            <div>
                                <h2
                                    class="font-headline-sm text-headline-sm text-on-surface font-bold group-hover:text-primary-container transition-colors">
                                    {{ $c['nama'] }}
                                </h2>
                                <p class="font-body-md text-body-md text-secondary mt-1.5 leading-relaxed">{{ $c['deskripsi'] }}</p>
                            </div>
                            <span
                                class="inline-flex items-center gap-1 font-label-md text-label-md text-primary-container mt-auto">
                                Jelajahi Kategori
                                <span class="material-symbols-outlined text-[18px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                            </span>
                        </a>
                    @endforeach
                </div>

                {{-- Banner bantuan --}}
                <div
                    class="mt-8 bg-surface-container-lowest rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">lightbulb</span>
                    </div>
                    <div class="flex-1">
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Bingung mulai dari mana?</h2>
                        <p class="font-body-md text-body-md text-secondary mt-1">Lihat rekomendasi buku populer mingguan di
                            beranda, atau tanyakan langsung ke pustakawan melalui pusat bantuan.</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('home') }}"
                            class="h-10 px-5 inline-flex items-center rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors active:scale-95">Buku
                            Populer</a>
                        <a href="{{ route('bantuan') }}"
                            class="h-10 px-5 inline-flex items-center rounded-lg bg-surface-container-low text-secondary font-label-md text-label-md hover:bg-surface-container hover:text-on-surface transition-colors active:scale-95">Bantuan</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection