@extends('welcome')

@section('title', 'Perpustakaan')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center">Daftar Buku</h2>

        <!-- Dropdown Kategori dan Search -->
        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Dropdown Kategori -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: 2px 0 5px #fff;">
                    Pilih Kategori
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('books.index') }}">Semua Kategori</a></li>
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{ route('books.index', ['category' => $category->ID_Category]) }}">{{ $category->Name_Category }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Search Form -->
            <form action="{{ route('books.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Judul Buku..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-light">Cari</button>
            </form>
        </div>

        <!-- Blog Container -->
        <div class="row justify-content-center">
            @forelse ($books as $item)
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
                    <div class="card shadow" style="width: 18rem;">
                        <!-- Judul Buku -->
                        <div class="card-header text-center">
                            <h5>{{ $item->Judul_Buku }}</h5>
                        </div>

                        <!-- Informasi Penulis dan Penerbit -->
                        <div class="card-body text-start">
                            <p><strong>Penulis:</strong> {{ $item->Nama_Penulis }}</p>
                            <p><strong>Penerbit:</strong> {{ $item->Tahun_Terbit }}, {{ $item->Nama_Penerbit }}</p>
                        </div>

                        <!-- Tombol -->
                        <div class="card-footer text-center">
                            <a href="{{ route('books.show', $item->ID_Buku) }}" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada buku yang ditemukan.</p>
            @endforelse
        </div>

        <!-- Tombol Tambah Data -->
        <div class="mt-4 text-center">
            <a href="{{ route('books.data') }}" class="btn btn-success">Tambah Data</a>
        </div>
    </div>
@endsection
