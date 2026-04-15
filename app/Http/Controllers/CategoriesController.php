<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::withCount('items')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'division' => 'required|in:Sarpras,Tefa,TU',
        ]);

        Categories::create($request->only('name', 'division'));

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Categories $category) // ✅ lowercase $category
    {
        return view('categories.edit', compact('category')); // ✅ cocok
    }

    public function update(Request $request, Categories $category) // ✅ lowercase
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'division' => 'required|in:Sarpras,Tefa,TU', // ✅
        ]);

        $category->update($request->only('name', 'division'));

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Categories $category) // ✅ lowercase
    {
        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}