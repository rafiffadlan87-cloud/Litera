<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /* =========================================================
    | DATA CONTOH (sementara) — nanti tinggal ganti jadi Book::all()
    ========================================================= */
    private function books(): array
    {
        return [
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'kategori' => 'fiksi', 'kategori_nama' => 'Fiksi', 'rating' => 4.9, 'ulasan' => 420, 'status' => 'tersedia', 'keterangan' => 'Tersedia (8 Salinan)', 'gradien' => 'from-sky-500 to-indigo-600', 'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB7mIF6wGnzq_qi1mUxnR3jtUQqlR7qyRkpXUw-TZPYfWGq8ebN2eGLKud9DbTqkUxW41qWyzRkgdDwRm5Y11fIvBa-js87R9ULfu_XcxTFRqpu6fgwF5LS8IqwW8teSdV4zBbgVBM0tB-lwfOy4H_MTUfHG_SaKtKtmLs4fXxQJaASJBRCizay3eMO-PwHWtKmAaG-A-84Svw72Ry1BA9jFep6jzqthnx3oEmWzo_OMyLcHzYJ-Bsd'],
            ['judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'kategori' => 'nonfiksi', 'kategori_nama' => 'Non Fiksi', 'rating' => 4.8, 'ulasan' => 380, 'status' => 'tersedia', 'keterangan' => 'Tersedia (4 Salinan)', 'gradien' => 'from-teal-500 to-emerald-700', 'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqJ0iK1kOZKim2TJ_T4j9iKLd34jLlByHugHUuFDC58Kny4AkP2PF3VhCgG_YR6LaAmXBSuxGXti31GtZdQ3jwV0MxjLzzr3AxrbzmgvFKFP7arMnc4sdlW2qNL-OIK-GhtS9V_FItuRDbu-xwHo-kPuxERLKbmRV75Q-XT684Ed84DyTbFGRZ0_Fo35uOTfUsKrOS3gqgjJz6RTtfDseiZ4yv4lt8wA8nom13PvlugyzRzY_2QjEA'],
            ['judul' => 'Atomic Habits', 'penulis' => 'James Clear', 'kategori' => 'selfhelp', 'kategori_nama' => 'Self Help', 'rating' => 5.0, 'ulasan' => 610, 'status' => 'antrean', 'keterangan' => 'Antrean: 3 Orang', 'gradien' => 'from-amber-500 to-orange-600', 'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCa2L3iibu4LGuTehQfLDX2x10Bq96GJvWlA5hRmDeretfR4mHT_vOJZnmXEE3iJ5ZjV0fXJjnktLwj6pvGUZCqbNY5ZIcOrgN0UuNODOA6CplH913i8sMkDw5tvyiDY9SadXijAeNqsuxyQlXLN_BiG0rMZVSq3VycDDlcA_iz6VSm0cFW_rR9y2edndIqSOJfTJfM1Halpfn9Hv0BZoyi3rD6m04HZFLwIn_o4beHFBbv2KCe_umv'],
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'kategori' => 'sejarah', 'kategori_nama' => 'Sejarah', 'rating' => 4.9, 'ulasan' => 512, 'status' => 'dipinjam', 'keterangan' => 'Dipinjam (Kembali 4 hr)', 'gradien' => 'from-rose-500 to-red-700', 'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBo9NzOtPeOmc67HI428NSRxtFfTNwG7E4YaYidKuNrBXsd7SWO7_xKlOI1Pk8MfvlaXIHxnaWjbwv-MKnU_9F_JZZAoc1aZzmbgOAM0YF-iPxyZRbeydo7zXHI0xl7fMyy3H5l6xvXt7to0_kFy63o7oPTSudRe7rgZee-ovhoWyQPkv3bydaZX-9yVytisaZKtayyViIXquFl35KFDlGbmjX_7l962YCdHZ_cV1YRPcNCxffFfrz6'],
            ['judul' => 'Kecerdasan Buatan & Masa Depan', 'penulis' => 'Dr. Ir. Rian Pratama', 'kategori' => 'teknologi', 'kategori_nama' => 'Teknologi', 'rating' => 4.7, 'ulasan' => 245, 'status' => 'tersedia', 'keterangan' => 'Tersedia (2 Salinan)', 'gradien' => 'from-violet-500 to-purple-700', 'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBpWi_T6oHCXG8yjfg0Q9dixfFAIRM1AFU-HK5hhXLxHRNOa85_mQ6xPm7MatWejXh7aSvFuR8u0bQSwmt42mQIoYL3g6K0kofjroWI4y4rtNBgclg-EgvpcdbmBLoeF1n8i7ZOjCa81n0XNFmfLLdOq-3XjtFZowhIJa-L97DMQPxtcwvEC-9Gcz62InGKp2ocF3JLN0CnboZCmrKlCzsF4Dk_xC4axJFNyFdg8QzstCqLP-mTJH1Q'],
            ['judul' => 'Cosmos: Semesta Raya', 'penulis' => 'Carl Sagan', 'kategori' => 'sains', 'kategori_nama' => 'Sains', 'rating' => 4.8, 'ulasan' => 301, 'status' => 'tersedia', 'keterangan' => 'Tersedia (5 Salinan)', 'gradien' => 'from-cyan-500 to-blue-700', 'cover' => 'https://covers.openlibrary.org/b/isbn/9780345539434-M.jpg'],
            ['judul' => 'Rich Dad Poor Dad', 'penulis' => 'Robert T. Kiyosaki', 'kategori' => 'bisnis', 'kategori_nama' => 'Bisnis', 'rating' => 4.6, 'ulasan' => 289, 'status' => 'tersedia', 'keterangan' => 'Tersedia (6 Salinan)', 'gradien' => 'from-emerald-500 to-green-700', 'cover' => 'https://covers.openlibrary.org/b/isbn/9781612565118-M.jpg'],
            ['judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'kategori' => 'fiksi', 'kategori_nama' => 'Fiksi', 'rating' => 4.7, 'ulasan' => 352, 'status' => 'tersedia', 'keterangan' => 'Tersedia (3 Salinan)', 'gradien' => 'from-blue-500 to-indigo-700', 'cover' => 'https://covers.openlibrary.org/b/isbn/9789791227896-M.jpg'],
            ['judul' => 'Sapiens', 'penulis' => 'Yuval Noah Harari', 'kategori' => 'sejarah', 'kategori_nama' => 'Sejarah', 'rating' => 4.8, 'ulasan' => 410, 'status' => 'antrean', 'keterangan' => 'Antrean: 2 Orang', 'gradien' => 'from-stone-500 to-stone-700', 'cover' => 'https://covers.openlibrary.org/b/isbn/9780062316097-M.jpg'],
            ['judul' => 'Clean Code', 'penulis' => 'Robert C. Martin', 'kategori' => 'teknologi', 'kategori_nama' => 'Teknologi', 'rating' => 4.9, 'ulasan' => 505, 'status' => 'dipinjam', 'keterangan' => 'Dipinjam (Kembali 2 hr)', 'gradien' => 'from-slate-600 to-slate-800', 'cover' => 'https://covers.openlibrary.org/b/isbn/9780132350884-M.jpg'],
        ];
    }

    private function categories(): array
    {
        return [
            ['slug' => 'fiksi',      'nama' => 'Fiksi',      'ikon' => 'auto_stories', 'gradien' => 'from-sky-500 to-indigo-600',    'deskripsi' => 'Novel, cerpen, dan karya sastra imajinatif lainnya.'],
            ['slug' => 'nonfiksi',   'nama' => 'Non Fiksi',  'ikon' => 'menu_book',    'gradien' => 'from-teal-500 to-emerald-700', 'deskripsi' => 'Buku pengetahuan nyata, biografi, dan esai.'],
            ['slug' => 'selfhelp',   'nama' => 'Self Help',  'ikon' => 'psychology',   'gradien' => 'from-amber-500 to-orange-600', 'deskripsi' => 'Pengembangan diri, motivasi, dan produktivitas.'],
            ['slug' => 'sejarah',    'nama' => 'Sejarah',    'ikon' => 'museum',       'gradien' => 'from-rose-500 to-red-700',     'deskripsi' => 'Catatan peristiwa masa lalu dan peradaban.'],
            ['slug' => 'teknologi',  'nama' => 'Teknologi',  'ikon' => 'memory',       'gradien' => 'from-violet-500 to-purple-700','deskripsi' => 'Informatika, pemrograman, dan rekayasa.'],
            ['slug' => 'sains',      'nama' => 'Sains',      'ikon' => 'biotech',      'gradien' => 'from-cyan-500 to-blue-700',    'deskripsi' => 'Sains populer, astronomi, dan riset ilmiah.'],
            ['slug' => 'bisnis',     'nama' => 'Bisnis',     'ikon' => 'trending_up',  'gradien' => 'from-emerald-500 to-green-700','deskripsi' => 'Manajemen, finansial, dan kewirausahaan.'],
        ];
    }

    public function katalog(Request $request)
    {
        $search   = trim((string) $request->query('q', ''));
        $kategori = (string) $request->query('kategori', 'all');

        $categories = collect($this->categories());
        $books      = collect($this->books());

        if ($kategori !== 'all') {
            $books = $books->where('kategori', $kategori);
        }

        if ($search !== '') {
            $needle = mb_strtolower($search);
            $books  = $books->filter(
                fn ($b) =>
                str_contains(mb_strtolower($b['judul']), $needle) ||
                str_contains(mb_strtolower($b['penulis']), $needle)
            );
        }

        return view('public.katalog', [
            'books'        => $books->values(),
            'categories'   => $categories,
            'search'       => $search,
            'kategori'     => $kategori,
            'namaKategori' => $categories->firstWhere('slug', $kategori)['nama'] ?? 'Semua Kategori',
        ]);
    }

    public function kategori()
    {
        $books = collect($this->books());

        $categories = collect($this->categories())
            ->map(function ($c) use ($books) {
                $c['jumlah'] = $books->where('kategori', $c['slug'])->count();
                return $c;
            })
            ->filter(fn ($c) => $c['jumlah'] > 0) // aturan anti-pajangan: kategori kosong disembunyikan
            ->values();

        return view('public.kategori', compact('categories'));
    }

    public function tentangKami()
    {
        return view('public.tentang-kami');
    }

    public function bantuan()
    {
        return view('public.bantuan');
    }
}
