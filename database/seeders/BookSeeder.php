<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat kategori
        $categories = [
            'Sains & Teknologi' => Category::create(['name' => 'Sains & Teknologi']),
            'Pengembangan Diri' => Category::create(['name' => 'Pengembangan Diri']),
            'Fiksi & Sastra'    => Category::create(['name' => 'Fiksi & Sastra']),
            'Sejarah & Sosial'  => Category::create(['name' => 'Sejarah & Sosial']),
            'Teknologi Informasi' => Category::create(['name' => 'Teknologi Informasi']),
        ];

        // 2. Buku-buku dummy
        $books = [
            [
                'category_id' => $categories['Sains & Teknologi']->id,
                'title' => 'Fisika Dasar untuk Sains & Teknik',
                'author' => 'Halliday, Resnick & Jearl Walker',
                'year' => 2021, 'isbn' => '978-602-298-554-1', 'publisher' => 'Penerbit Erlangga',
                'rack' => 'Rak B-04', 'stock' => 8, 'rating' => 4.9, 'rating_count' => 48,
                'description' => "Buku teks klasik yang menjadi rujukan utama dalam pembelajaran fisika di tingkat perguruan tinggi.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCq8RruQ6ZB_OnaQ_X8tBmvhqYYycdMectVcfWj262F9j6zQekSdCJTMBzEP92xtSlomuBOZs2MvmEkpvkjtWSi2wlQlSjFW4ZJRztanNIVPNsT_ezvSP_yFr-JtRCawfJ4ToJ-34YNWlCrO9j6pmvcL5dkVYHJnbfWdWAQBgI3Zr6eAlgJk_pJtIt75zOhPmip9EHNRpuE0D_iC1mB32mN35k8u0VlWAZGpzDELTjnu6cLsOzBwoAZ',
            ],
            [
                'category_id' => $categories['Pengembangan Diri']->id,
                'title' => 'Filosofi Teras: Mental Tangguh Masa Kini',
                'author' => 'Henry Manampiring',
                'year' => 2019, 'isbn' => '978-602-412-518-9', 'publisher' => 'Penerbit Kompas',
                'rack' => 'Rak C-01', 'stock' => 4, 'rating' => 4.8, 'rating_count' => 112,
                'description' => "Buku bestseller yang memperkenalkan filsafat Stoisisme dalam konteks kehidupan modern Indonesia.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCpxSA84q177pHwH8u8yOHmx35o_G6NvVJvU2kiXv4Dudi6OBuTpnEUVwQaNSam9kgKVz10g6ICItKBnBVnULxRBzMumr7MgDnohnjetAyZkM3115GtkEvtVBmUwVLKXLjXy5tWfrxsWBIwDcVn5s930v3R4IATHwKoAXHjuXzj0PinhvvsZEtRArAUzk6lPdipFEHgcCgnjCD4TOuKSe7VJ3jbV5U2KFul-29jkBIrp50z3-cepFTz',
            ],
            [
                'category_id' => $categories['Pengembangan Diri']->id,
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'year' => 2018, 'isbn' => '978-602-063-317-6', 'publisher' => 'Penerbit Gramedia',
                'rack' => 'Rak C-05', 'stock' => 0, 'rating' => 4.9, 'rating_count' => 240,
                'description' => "Panduan praktis membangun kebiasaan baik melalui perubahan kecil yang konsisten.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBBWx-mVmBNBKE5lfCdFTCZieJ1coHPa0wyJC9NzH3MTPOnSE1qpdEP-36uT_tcXYQtiMZL4bodNCw1_Cmyse9rQzLUETidVw8UmVIrn8txpITdiwRrsFDS69lDkhczJsCZGnOREug1QVIADjMy8064W72BbeVK99OvMs-C5w7eV4kFV6cGv3rFa6YUPnrE0N6s6_G-vCHTPt8jIiZx3HvDSVmph5G2BbFpZSyduwh_PJ6_AhKjikwt',
            ],
            [
                'category_id' => $categories['Fiksi & Sastra']->id,
                'title' => 'Bumi Manusia (Tetralogi Buru)',
                'author' => 'Pramoedya Ananta Toer',
                'year' => 2015, 'isbn' => '978-979-973-123-5', 'publisher' => 'Hasta Mitra',
                'rack' => 'Rak A-02', 'stock' => 0, 'rating' => 4.9, 'rating_count' => 310,
                'description' => "Novel pertama dari Tetralogi Buru karya sastrawan legendaris Indonesia.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBa-bLkdPgMU0Ohd0Bh6RkvSszh90UMwb7AMKtF7CzeoeQ8zhysBvhRWvh7FGGORhY2eqf55jGDBUP0HZdfp-NPgu7zYhCIkmxw1Tz0A8zD8FdgXffd2iN_7b6E2zeG6gx2BGur6HXn1DaOCRmicgYyAvNHOPYFfCwcayl9A6xJ28wET4AJc5FLL21Rk6d5kaAM1BJooG9EHwVn0zoQc8V1-4PnPR9RojIDYCiG42Uem1uuAbV57vR0',
            ],
            [
                'category_id' => $categories['Teknologi Informasi']->id,
                'title' => 'Kecerdasan Buatan & Masa Depan Kemanusiaan',
                'author' => 'Dr. Ir. Rian Pratama, M.T.',
                'year' => 2023, 'isbn' => '978-623-011-239-0', 'publisher' => 'Penerbit Informatika',
                'rack' => 'Rak T-11', 'stock' => 2, 'rating' => 4.7, 'rating_count' => 35,
                'description' => "Buku terkini yang membahas perkembangan AI, machine learning, dan dampaknya terhadap masa depan pekerjaan.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBu6CQpLgp1KLAxlIxE5GLyyEcQ4e8Mr7xmSinv0r0-xJdqT1tJmaEP4b56o6YB0J69InPyD4FyT3cpk2sY_vQsAqdAv2i30eCuwxwxK-Mg3i5E073MmIEQ7IW4aqlQIm8oKGtcc53YPGPH3PPZ8WRxtI5ZZUHLTp2zMvEuBAn9VSj8wZy7-VL4lZh6TwYI2C-QY7L-ggaeJkQqKh3oPGOtJWVMbW33j6WAH8k7ACvTfa3vbxFZ05I-',
            ],
            [
                'category_id' => $categories['Fiksi & Sastra']->id,
                'title' => 'Laskar Pelangi (Edisi Khusus)',
                'author' => 'Andrea Hirata',
                'year' => 2017, 'isbn' => '978-979-122-790-2', 'publisher' => 'Bentang Pustaka',
                'rack' => 'Rak A-05', 'stock' => 6, 'rating' => 4.9, 'rating_count' => 420,
                'description' => "Novel inspiratif tentang 10 anak Belitung yang berjuang meraih pendidikan di tengah keterbatasan.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDwy3PCYZsyoY6YGLyw1JJwo4YsJkJTJ-zc1rBUs42gsqa4azNLc1_WzrZ2AJs0QvrRnjtikbUSsUf5HMXwdL7FiDjjWfZ9iz6joYK-SM8MskGjEjKDEgncStaFM6SxMsHpbR94CaZvu06-6CuZU-sK-80MB1H6t8wMEGsSbC_jefxMKMlO-TtjrphX3QQaXI_7AdTAlZgNrwPyVBeQNe_rr41IDElPEpHtM6rJhgJWpqAxUpEQMi8v',
            ],
            [
                'category_id' => $categories['Teknologi Informasi']->id,
                'title' => 'Struktur Data & Algoritma Modern',
                'author' => 'Prof. Hendra Wijaya, Ph.D.',
                'year' => 2022, 'isbn' => '978-602-851-903-8', 'publisher' => 'Informatika Bandung',
                'rack' => 'Rak T-03', 'stock' => 3, 'rating' => 4.7, 'rating_count' => 56,
                'description' => "Buku teks komprehensif untuk mahasiswa informatika.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNd3_b7bAOoII_zncw1-FgomXZ9QanI6X-j0dVnni9kP10tnaEQ_v0UEuQRIema3FcmSNf4zEn9nGMXkwPucrJNw4PvXH_Uf-9vaUW7HT0pdcBh3Kmu7Y6eh2u6p6EN3hXRUa62V_hBMRM8mrLi5B4InIZ5FaDcGYXbtvUdz2vqjxwIWEf5q97zKwEQUctvyNPEcy6g7Y6rE1Bcxr9WG4_5ATqf7jjFbLcL9iuad8GdRxWj3gIr1gt',
            ],
            [
                'category_id' => $categories['Sejarah & Sosial']->id,
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'year' => 2020, 'isbn' => '978-602-424-416-3', 'publisher' => 'Penerbit KPG',
                'rack' => 'Rak S-08', 'stock' => 0, 'rating' => 4.9, 'rating_count' => 532,
                'description' => "Buku fenomenal yang menelusuri perjalanan Homo sapiens dari zaman batu hingga era digital.",
                'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuACtizyZxBimPZ7iI7fzDf_O9spE7FKCVZWzMq-AQOHremYojf3kRbzTLrBEMTh6YU7s3py8aq_6vdj5aH8klDJqWTOamkkb48IBFHdE0rnwXhkKQvvuRe1uMP6inRe3tgHGK4wAbtiBkD8BYd3K7ZLGSwPJJi2z7ltCOlbohkinlgsPMGqVYLjSA2UA8C76nL82KGfHQ_lpDVnmBXsnXt8CqtYcb0OoQUkOZjmG9lR-CXNqHJnXMr4',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}