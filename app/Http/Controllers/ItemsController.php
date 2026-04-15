<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;


class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::with('category')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('items.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total'       => 'required|integer|min:0',
            'repair'      => 'required|integer|min:0',
        ]);

        Items::create($request->only('name', 'category_id', 'total', 'repair'));

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil ditambahkan.');
    }

    public function edit(Items $item)
    {
        $categories = Categories::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Items $item)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total'       => 'required|integer|min:0',
            'repair'      => 'required|integer|min:0',
        ]);

        $item->update($request->only('name', 'category_id', 'total', 'repair'));

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Items $item)
    {
        $item->delete();
        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil dihapus.');
    }
    public function export() 
    {
        return Excel::download(new ItemsExport, 'items_list.xlsx');
    }
    public function show($id)
    {
        // For now, just redirect back or show the item
        $item = Items::findOrFail($id);
        return view('items.show', compact('item'));
    }
}