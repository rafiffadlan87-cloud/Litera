<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan daftar kategori + jumlah buku per kategori
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('admin.categories', compact('categories'));
    }

    // Tambah kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max'      => 'Nama kategori maksimal 100 karakter.',
            'name.unique'   => 'Kategori dengan nama ini sudah ada.',
        ]);

        Category::create($validated);

        return back()->with('success', 'Kategori "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    // Ubah nama kategori
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Kategori dengan nama ini sudah ada.',
        ]);

        $category->update($validated);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori (dengan proteksi relasi)
    public function destroy(Category $category)
    {
        $jumlahBuku = $category->books()->count();

        if ($jumlahBuku > 0) {
            return back()->with('error', 'Gagal menghapus: kategori "' . $category->name . '" masih dipakai ' . $jumlahBuku . ' buku. Pindahkan atau hapus buku tersebut dulu.');
        }

        $category->delete();

        return back()->with('success', 'Kategori "' . $category->name . '" berhasil dihapus!');
    }
}
