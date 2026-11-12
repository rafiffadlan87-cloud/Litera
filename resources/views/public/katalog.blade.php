@extends('layouts.public')

@section('title', 'Katalog Buku — Smart Library')

@section('content')
    <div class="flex flex-col w-full">
        <div class="relative w-full overflow-hidden">
            <div
                class="absolute -top-40 right-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl pointer-events-none -z-10">
            </div>

            {{-- Breadcrumb --}}
            <div class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pt-6 w-full">
                <nav aria-label="Breadcrumb" class="flex items-center gap-1 font-body-sm text-body-sm text-secondary">
                    <a href="{{ route('home') }}" class="flex items-center gap-1 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[16px]">home</span>Home
                    </a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-on-surface font-semibold" aria-current="page">Katalog Buku</span>
                </nav>
            </div>

            {{-- Header + Form Pencarian --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 w-full">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-6">
                    <div>
                        <div
                            class="flex items-center gap-2 text-primary-container font-label-md text-label-md uppercase tracking-wider mb-1">
                            <span class="material-symbols-outlined text-[18px]">local_library</span>
                            Koleksi Perpustakaan
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Katalog Buku</h1>
                        <p class="font-body-md text-body-md text-secondary mt-1">
                            Menampilkan <strong class="text-on-surface">{{ $books->count() }}</strong> judul
                            @if ($search !== '')
                                untuk pencarian <strong class="text-primary-container">"{{ $search }}"</strong>
                            @endif
                            @if ($kategori !== 'all')
                                pada kategori <strong class="text-primary-container">{{ $namaKategori }}</strong>
                            @endif
                        </p>
                    </div>
                    <form action="{{ route('katalog') }}" method="GET" class="flex items-stretch gap-2 w-full lg:w-auto">
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                        <div class="relative flex-1 lg:w-72">
                            <span
                                class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-secondary text-[20px] pointer-events-none">search</span>
                            <input type="text" name="q" value="{{ $search }}"
                                placeholder="Cari judul atau penulis..."
                                class="w-full h-11 pl-11 pr-4 bg-surface-container-lowest text-on-surface placeholder-secondary font-body-md text-body-md rounded-lg shadow-sm focus:outline-none focus:shadow-[0_0_0_2px_#2563eb] transition-all" />
                        </div>
                        <button type="submit"
                            class="h-11 px-5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors active:scale-95 shadow-sm whitespace-nowrap">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Chip filter kategori --}}
                <div class="flex items-center gap-1.5 flex-wrap pb-2">
                    <a href="{{ route('katalog', array_filter(['q' => $search])) }}"
                        class="px-3 py-1 rounded-full font-label-sm text-label-sm transition-all {{ $kategori === 'all' ? 'bg-primary-container text-on-primary' : 'bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface' }}">
                        Semua
                    </a>
                    @foreach ($categories as $c)
                        <a href="{{ route('katalog', array_filter(['kategori' => $c['slug'], 'q' => $search])) }}"
                            class="px-3 py-1 rounded-full font-label-sm text-label-sm transition-all {{ $kategori === $c['slug'] ? 'bg-primary-container text-on-primary' : 'bg-surface-container-low text-secondary hover:bg-surface-container hover:text-on-surface' }}">
                            {{ $c['nama'] }}
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Grid Buku --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pb-14 w-full">
                @if ($books->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                        @foreach ($books as $b)
                            @php
                                $badgeMap = [
                                    'tersedia' => ['bg-emerald-50 text-emerald-700', 'bg-emerald-600'],
                                    'antrean' => ['bg-amber-50 text-amber-700', 'bg-amber-500'],
                                    'dipinjam' => ['bg-rose-50 text-rose-700', 'bg-rose-500'],
                                ];
                                [$badgeClass, $dotClass] = $badgeMap[$b['status']] ?? $badgeMap['tersedia'];
                                $tujuanAksi = auth()->check() ? route('siswa.dashboard') : route('login');
                            @endphp
                            <div
                                class="bg-surface-container-lowest rounded-xl p-3.5 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                                <div class="flex flex-col">
                                    <div
                                        class="relative aspect-[3/4] w-full rounded-lg overflow-hidden bg-gradient-to-br {{ $b['gradien'] }} mb-3">
                                        {{-- Ikon = cadangan kalau gambar gagal dimuat --}}
                                        <span
                                            class="material-symbols-outlined absolute inset-0 flex items-center justify-center text-white/70 text-[52px] group-hover:scale-110 transition-transform duration-500">auto_stories</span>
                                        {{-- Foto sampul asli --}}
                                        @if (!empty($b['cover']))
                                            <img src="{{ $b['cover'] }}" alt="Sampul {{ $b['judul'] }}" loading="lazy"
                                                onerror="this.remove()"
                                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                        @endif
                                        <span
                                            class="absolute top-2 left-2 px-2 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-primary-container">{{ $b['kategori_nama'] }}</span>
                                    </div>  
                                    <div class="flex items-center justify-between gap-1 mb-1">
                                        <span class="flex items-center gap-1 font-label-sm text-label-sm text-amber-600">
                                            <span class="material-symbols-outlined text-[15px]"
                                                style="font-variation-settings: 'FILL' 1;">star</span>
                                            {{ number_format($b['rating'], 1) }} <span
                                                class="text-secondary font-normal">({{ $b['ulasan'] }})</span>
                                        </span>
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-on-surface line-clamp-1 font-bold group-hover:text-primary-container transition-colors">
                                        {{ $b['judul'] }}</h3>
                                    <p class="font-body-sm text-body-sm text-secondary truncate mt-0.5">{{ $b['penulis'] }}
                                    </p>
                                    <div
                                        class="mt-2.5 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full {{ $badgeClass }} font-label-sm text-label-sm w-fit">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                        {{ $b['keterangan'] }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4 pt-2">
                                    <button onclick="window.location.href='{{ $tujuanAksi }}'"
                                        class="flex-1 h-10 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors flex items-center justify-center gap-1 shadow-sm active:scale-95">
                                        {{ $b['status'] === 'tersedia' ? 'Pinjam Buku' : ($b['status'] === 'antrean' ? 'Masuk Antrean' : 'Ingatkan Saya') }}
                                    </button>
                                    <button
                                        class="w-10 h-10 rounded-lg bg-surface-container-low text-secondary hover:text-primary hover:bg-surface-container flex items-center justify-center transition-colors"
                                        title="Simpan ke favorit">
                                        <span class="material-symbols-outlined text-[20px]">bookmark_border</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty state: uji negatif tampil rapi, bukan error --}}
                    <div
                        class="bg-surface-container-lowest rounded-2xl p-12 shadow-sm text-center flex flex-col items-center gap-3">
                        <div class="w-16 h-16 rounded-full bg-surface-container-low flex items-center justify-center">
                            <span class="material-symbols-outlined text-[32px] text-secondary">find_off</span>
                        </div>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold">Buku tidak ditemukan</h2>
                        <p class="font-body-md text-body-md text-secondary max-w-md">Coba ubah kata kunci atau pilih
                            kategori lain untuk menemukan koleksi yang kamu cari.</p>
                        <a href="{{ route('katalog') }}"
                            class="mt-2 h-10 px-6 inline-flex items-center rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors active:scale-95">Lihat
                            Semua Buku</a>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
