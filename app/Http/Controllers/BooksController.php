<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $query = Books::query();

        if ($request->has('category') && $request->category) {
            $query->where('ID_Category', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where('Judul_Buku', 'like', '%' . $request->search . '%');
        }

        $query->where('status', 'publish');

        $books = $query->get();
        $categories = Categories::all();

        return view('books.index', compact('books', 'categories'));
    }
    Public function show($id)
    {
        $book = Books::where('ID_Buku', $id)->get();
        return view('books.show', compact('book'));
    }
    public function showdata()
    {
        $books = Books::all();
        $categories = Categories::all();
        return view('books.data', compact('books', 'categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'ID_Category' => 'required|exists:categories,ID_Category',
            'Judul_Buku' => 'required',
            'Nama_Penulis' => 'required',
            'Tahun_Terbit' => 'required|date_format:Y',
            'Nama_Penerbit' => 'required',
            'Sinopsis' => 'required',
            'status' => 'required|in:publish,pending',
        ]);

        Books::create([
            'Judul_Buku' => $request->Judul_Buku,
            'Nama_Penulis' => $request->Nama_Penulis,
            'Tahun_Terbit' => $request->Tahun_Terbit,
            'Nama_Penerbit' => $request->Nama_Penerbit,
            'Sinopsis' => $request->Sinopsis,
            'ID_Category' => $request->ID_Category,
            'status' => $request->status
        ]);

        // dd($request->all());

        return redirect()->route('books.data')->with('success', 'Data Buku berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_Category' => 'required|exists:categories,ID_Category',
            'Judul_Buku' => 'required',
            'Nama_Penulis' => 'required',
            'Tahun_Terbit' => 'required|date_format:Y',
            'Nama_Penerbit' => 'required',
            'Sinopsis' => 'required',
            'status' => 'required|in:publish,pending',
        ]);
        $books = Books::findOrFail($id);
        $books->update([
            'Judul_Buku' => $request->Judul_Buku,
            'Nama_Penulis' => $request->Nama_Penulis,
            'Tahun_Terbit' => $request->Tahun_Terbit,
            'Nama_Penerbit' => $request->Nama_Penerbit,
            'Sinopsis' => $request->Sinopsis,
            'ID_Category' => $request->ID_Category,
            'status' => $request->status
        ]);

        // dd($request->all());
        return redirect()->route('books.data')->with('success', 'Data Buku berhasil diperbarui.');
    }
    public function destroy($id)
    {
        Books::destroy($id);
        return redirect()->route('books.data')->with('success', 'Data Buku berhasil dihapus.');
    }
    public function like($id)
    {
        $book = Books::findOrFail($id);
        $book->likes += 1;
        $book->save();
        return back();
    }

    public function dislike($id)
    {
        $book = Books::findOrFail($id);
        $book->dislikes += 1;
        $book->save();
        return back();
    }


}
