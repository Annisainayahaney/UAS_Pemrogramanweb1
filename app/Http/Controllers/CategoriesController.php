<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name_Category' => 'required|string|max:255',
        ]);

        Categories::create(['Name_Category' => $request->Name_Category]);

        return redirect()->route('categories.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, Categories $category, $id)
    {
        $request->validate([
            'Name_Category' => 'required|string|max:255',
        ]);

        $category = Categories::findOrFail($id);
        $category->update(['Name_Category' => $request->Name_Category]);

        return redirect()->route('categories.index')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Data berhasil dihapus');
    }
}
