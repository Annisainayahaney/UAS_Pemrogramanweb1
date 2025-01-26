<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BooksController::class, 'index'])->name('books.index');
Route::get('/detail-buku/{id}', [BooksController::class, 'show'])->name('books.show');
Route::post('books/{id}/like', [BooksController::class, 'like'])->name('books.like');
Route::post('books/{id}/dislike', [BooksController::class, 'dislike'])->name('books.dislike');

Route::get('/data-kategori', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('/tambah-kategori', [CategoriesController::class, 'store'])->name('categories.store');
Route::put('/edit-kategori/{ID_Category}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{ID_Category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

Route::get('/data-buku', [BooksController::class, 'showdata'])->name('books.data');
Route::post('/tambah-buku', [BooksController::class, 'store'])->name('books.store');
Route::put('/edit-buku/{ID_Buku}', [BooksController::class, 'update'])->name('books.update');
Route::delete('/books/{ID_Buku}', [BooksController::class, 'destroy'])->name('books.destroy');

