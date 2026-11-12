@extends('layouts.public')

@section('title', 'Pusat Bantuan — Smart Library')

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
                    <span class="text-on-surface font-semibold" aria-current="page">Bantuan</span>
                </nav>
            </div>

            {{-- Header --}}
            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet py-8 w-full text-center">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed w-fit shadow-sm mb-3">
                    <span class="material-symbols-outlined text-[16px]">support_agent</span>
                    <span class="font-label-md text-label-md tracking-tight">Pusat Bantuan</span>
                </div>
                <h1 class="font-headline-lg text-3xl lg:text-4xl text-on-surface font-extrabold tracking-tight">Butuh Bantuan?</h1>
                <p class="font-body-md text-body-md text-secondary mt-3 max-w-2xl mx-auto">
                    Pelajari prosedur peminjaman, simak pertanyaan yang paling sering diajukan, atau hubungi langsung
                    tim perpustakaan pada jam layanan.
                </p>
            </section>

            <section class="max-w-7xl mx-auto px-margin lg:px-margin-tablet pb-14 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ===== KOLOM KIRI: PROSEDUR + FAQ ===== --}}
                    <div class="lg:col-span-2 flex flex-col gap-8">

                        {{-- Kategori Bantuan Cepat --}}
                        <div>
                            <h2 class="font-headline-md text-headline-md text-on-surface font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[22px] text-primary-container">topic</span>
                                Topik Bantuan
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ([
                                    ['ikon' => 'person', 'judul' => 'Akun & Login', 'deskripsi' => 'Pendaftaran, lupa kata sandi, verifikasi akun, dan pengaturan profil.', 'warna' => 'bg-blue-100 text-blue-700'],
                                    ['ikon' => 'auto_stories', 'judul' => 'Peminjaman Buku', 'deskripsi' => 'Cara meminjam buku digital, antrean, batas pinjam, dan konfirmasi ketersediaan.', 'warna' => 'bg-emerald-100 text-emerald-700'],
                                    ['ikon' => 'event_repeat', 'judul' => 'Pengembalian', 'deskripsi' => 'Deadline pengembalian, perpanjangan, denda, dan status buku.', 'warna' => 'bg-amber-100 text-amber-700'],
                                    ['ikon' => 'settings_suggest', 'judul' => 'Masalah Teknis', 'deskripsi' => 'Error halaman, tampilan mobile, gagal muat, dan bantuan browser.', 'warna' => 'bg-rose-100 text-rose-700'],
                                ] as $t)
                                    <div class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm flex items-start gap-3">
                                        <div class="w-11 h-11 rounded-xl {{ $t['warna'] }} flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[22px]">{{ $t['ikon'] }}</span>
                                        </div>
                                        <div>
                                            <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">{{ $t['judul'] }}</h3>
                                            <p class="font-body-sm text-body-sm text-secondary mt-1 leading-relaxed">{{ $t['deskripsi'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Prosedur Peminjaman --}}
                        <div>
                            <h2 class="font-headline-md text-headline-md text-on-surface font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[22px] text-primary-container">route</span>
                                Prosedur Peminjaman
                            </h2>
                            <div class="flex flex-col gap-3">
                                @foreach ([
                                    ['no' => '1', 'warna' => 'bg-primary-fixed text-primary-container', 'judul' => 'Masuk dengan Akun Sekolah', 'isi' => 'Gunakan akun siswa/mahasiswa yang sudah terdaftar. Belum punya? Daftar gratis melalui tombol Daftar di navbar.'],
                                    ['no' => '2', 'warna' => 'bg-primary-fixed text-primary-container', 'judul' => 'Cari & Pilih Buku', 'isi' => 'Gunakan kolom pencarian di navbar atau filter kategori pada halaman Katalog untuk menemukan judul yang diinginkan.'],
                                    ['no' => '3', 'warna' => 'bg-primary-fixed text-primary-container', 'judul' => 'Ajukan Peminjaman', 'isi' => 'Klik tombol Pinjam Buku. Maksimal 5 buku aktif per anggota dengan durasi pinjam 7 hari dan 1 kali perpanjangan 3 hari.'],
                                    ['no' => '4', 'warna' => 'bg-emerald-100 text-emerald-800', 'judul' => 'Baca Digital / Ambil Fisik', 'isi' => 'E-book langsung terbuka di web reader pada dashboard. Untuk buku fisik, tunjukkan kode peminjaman di meja sirkulasi.'],
                                ] as $s)
                                    <div class="flex gap-4 bg-surface-container-lowest rounded-xl p-5 shadow-sm">
                                        <div class="w-10 h-10 rounded-lg {{ $s['warna'] }} flex items-center justify-center shrink-0 font-headline-sm font-bold">{{ $s['no'] }}</div>
                                        <div>
                                            <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">{{ $s['judul'] }}</h3>
                                            <p class="font-body-md text-body-md text-secondary mt-1 leading-relaxed">{{ $s['isi'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- FAQ Accordion --}}
                        <div>
                            <h2 class="font-headline-md text-headline-md text-on-surface font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[22px] text-primary-container">help</span>
                                Pertanyaan yang Sering Diajukan
                            </h2>
                            <div class="flex flex-col gap-3">
                                @foreach ([
                                    ['tanya' => 'Berapa batas peminjaman dan durasinya?', 'jawab' => 'Setiap anggota aktif dapat meminjam maksimal 5 buku bersamaan dengan durasi 7 hari kalender, plus 1 kali perpanjangan selama 3 hari melalui dashboard.'],
                                    ['tanya' => 'Bagaimana cara mengembalikan buku?', 'jawab' => 'Buku fisik dikembalikan ke meja sirkulasi atau kotak pengembalian di lobi. Buku digital otomatis kembali saat masa pinjam berakhir, tanpa perlu tindakan apa pun.'],
                                    ['tanya' => 'Apa sanksi keterlambatan pengembalian?', 'jawab' => 'Denda keterlambatan Rp1.000 per buku per hari. Anggota dengan denda belum lunas tidak dapat mengajukan peminjaman baru sampai denda diselesaikan.'],
                                    ['tanya' => 'Buku yang saya cari sedang dipinjam, bagaimana?', 'jawab' => 'Klik tombol Masuk Antrean pada kartu buku. Sistem akan mengirim notifikasi otomatis begitu salinan tersedia kembali untuk kamu.'],
                                    ['tanya' => 'Saya lupa kata sandi akun, apa yang harus dilakukan?', 'jawab' => 'Gunakan tautan "Lupa kata sandi?" pada halaman Masuk, atau datang ke meja sirkulasi dengan kartu pelajar untuk reset manual oleh petugas.'],
                                    ['tanya' => 'Apakah data pribadi pengguna aman?', 'jawab' => 'Sistem dirancang dengan proteksi dasar seperti autentikasi, pembatasan hak akses per role, dan sanitasi input untuk mengurangi risiko penyalahgunaan data.'],
                                ] as $f)
                                    <details class="group bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                                        <summary class="flex items-center justify-between gap-3 cursor-pointer list-none px-5 py-4 [&::-webkit-details-marker]:hidden">
                                            <span class="flex items-start gap-3 font-label-lg text-label-lg text-on-surface font-semibold">
                                                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">help_outline</span>
                                                {{ $f['tanya'] }}
                                            </span>
                                            <span class="material-symbols-outlined text-secondary transition-transform group-open:rotate-180">expand_more</span>
                                        </summary>
                                        <div class="px-5 pb-5 pl-14 border-t border-surface-container">
                                            <p class="font-body-md text-body-md text-secondary leading-relaxed pt-4">{{ $f['jawab'] }}</p>
                                        </div>
                                    </details>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ===== KOLOM KANAN: KONTAK & JAM LAYANAN ===== --}}
                    <div class="flex flex-col gap-6">
                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm flex flex-col gap-4">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-[22px] text-primary-container">contact_support</span>
                                Kanal Kontak
                            </h2>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[20px] text-secondary mt-0.5">mail</span>
                                <p class="font-body-md text-body-md text-on-surface-variant">bantuan@smartlibrary.id</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[20px] text-secondary mt-0.5">call</span>
                                <p class="font-body-md text-body-md text-on-surface-variant">(021) 555-8920</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[20px] text-secondary mt-0.5">location_on</span>
                                <p class="font-body-md text-body-md text-on-surface-variant">Gedung Pustaka Pusat Lt. 3, Jl. Pendidikan No. 12, Jakarta</p>
                            </div>
                        </div>

                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm flex flex-col gap-4">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-[22px] text-primary-container">schedule</span>
                                Jam Layanan Fisik
                            </h2>
                            <div class="flex items-center justify-between font-body-md text-body-md">
                                <span class="text-on-surface-variant">Senin – Jumat</span>
                                <span class="text-on-surface font-semibold">07.30 – 16.00</span>
                            </div>
                            <div class="flex items-center justify-between font-body-md text-body-md">
                                <span class="text-on-surface-variant">Sabtu</span>
                                <span class="text-on-surface font-semibold">08.00 – 12.00</span>
                            </div>
                            <div class="flex items-center justify-between font-body-md text-body-md">
                                <span class="text-on-surface-variant">Minggu / Libur</span>
                                <span class="text-rose-600 font-semibold">Tutup</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-secondary pt-1 border-t border-surface-container">Layanan digital (e-book &amp; dashboard) tetap aktif 24 jam.</p>
                        </div>

                        <div class="relative rounded-2xl bg-inverse-surface text-white overflow-hidden p-6 shadow-xl">
                            <div class="absolute -top-16 -right-16 w-56 h-56 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>
                            <h2 class="font-headline-sm text-headline-sm font-bold relative z-10">Masih butuh bantuan?</h2>
                            <p class="font-body-sm text-body-sm text-slate-300 mt-2 relative z-10">Tim kami siap membantu pada jam layanan. Anggota juga bisa mengirim tiket dari dashboard.</p>
                            <a href="{{ auth()->check() ? route('siswa.dashboard') : route('login') }}"
                                class="mt-4 h-10 px-5 inline-flex items-center rounded-lg bg-primary-container text-on-primary font-label-md text-label-md hover:bg-primary transition-colors active:scale-95 relative z-10">
                                {{ auth()->check() ? 'Buka Dashboard' : 'Masuk ke Dashboard' }}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection