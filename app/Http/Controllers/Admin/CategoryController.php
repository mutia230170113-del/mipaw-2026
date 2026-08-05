<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|unique:categories,nama_kategori'
            ],
            [
                'nama_kategori.required' => 'Nama kategori wajib diisi.',
                'nama_kategori.unique' => 'Nama kategori sudah digunakan.'
            ]
        );
        

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id
            ],
            [
                'nama_kategori.required' => 'Nama kategori wajib diisi.',
                'nama_kategori.unique' => 'Nama kategori sudah digunakan.'
            ]
        );

        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}