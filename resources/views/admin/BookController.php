<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')->latest();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($kategori = $request->input('category')) {
            $query->where('category_id', $kategori);
        }

        // Filter rak
        if ($rak = $request->input('rack')) {
            $query->where('rack', $rak);
        }

        // Filter status
        if ($status = $request->input('status')) {
            if ($status === 'tersedia') {
                $query->where('stock', '>', 0);
            } elseif ($status === 'habis') {
                $query->where('stock', 0);
            }
        }

        $books = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        // Statistik
        $totalBuku = Book::count();
        $totalEksemplar = Book::sum('stock');
        $siapPinjam = Book::where('stock', '>', 0)->count();
        $dipinjamPenuh = Book::where('stock', 0)->count();
        $waitingList = \App\Models\BookQueue::distinct('book_id')->count('book_id');

        // Ambil daftar rak unik
        $racks = Book::whereNotNull('rack')->distinct()->pluck('rack');

        return view('admin.books.index', compact(
            'books', 'categories', 'racks',
            'totalBuku', 'totalEksemplar', 'siapPinjam', 'dipinjamPenuh', 'waitingList'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isbn'        => ['nullable', 'string', 'max:50'],
            'publisher'   => ['nullable', 'string', 'max:255'],
            'year'        => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'stock'       => ['required', 'integer', 'min:0'],
            'rack'        => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'title.required'       => 'Judul buku wajib diisi.',
            'author.required'      => 'Penulis wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori tidak valid.',
            'stock.required'       => 'Stok wajib diisi.',
            'cover.image'          => 'File cover harus berupa gambar.',
            'cover.max'            => 'Ukuran cover maksimal 2MB.',
        ]);

        // Handle upload cover
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('books', 'public');
        }

        Book::create($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku "' . $validated['title'] . '" berhasil ditambahkan!');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isbn'        => ['nullable', 'string', 'max:50'],
            'publisher'   => ['nullable', 'string', 'max:255'],
            'year'        => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'stock'       => ['required', 'integer', 'min:0'],
            'rack'        => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'cover'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Handle upload cover baru
        if ($request->hasFile('cover')) {
            // Hapus cover lama kalau ada & bukan URL eksternal
            if ($book->cover && !str_starts_with($book->cover, 'http')) {
                Storage::disk('public')->delete($book->cover);
            }
            $validated['cover'] = $request->file('cover')->store('books', 'public');
        }

        $book->update($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku "' . $book->title . '" berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;

        // Hapus cover kalau ada & bukan URL eksternal
        if ($book->cover && !str_starts_with($book->cover, 'http')) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku "' . $title . '" berhasil dihapus!');
    }
}