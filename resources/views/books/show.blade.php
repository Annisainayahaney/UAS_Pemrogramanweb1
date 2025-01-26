@extends('welcome')

@section('title', 'Detail Buku')

@section('content')
    <!-- Wrapper for full-page centering -->
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card" style="width: 50%; margin: 10px auto; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.65);">
            @foreach ($book as $item)
                <div class="blog-detail" style="padding: 20px;">
                    <h2 style="text-align: center;">{{ $item->Judul_Buku }}</h2>
                    <p style="text-align: center; font-style: italic;">{{ $item->Nama_Penulis }}</p>
                    <p style="text-align: justify; font-size: 1.1em;">{{ $item->Sinopsis }}</p>

                    <div class="publisher-info" style="display: flex; margin-top: 20px;">
                        <span>{{ $item->Tahun_Terbit }}, {{ $item->Nama_Penerbit }}</span>
                    </div>
                </div>

                <!-- Like/Dislike Section -->
                <div class="like-dislike-section" style="margin-top: 20px; display: flex; justify-content: center; gap: 20px;">
                    <!-- Like Button -->
                    <form action="{{ route('books.like', $item->ID_Buku) }}" method="POST" style="margin-right: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-outline-success">Like</button>
                    </form>
                    <!-- Dislike Button -->
                    <form action="{{ route('books.dislike', $item->ID_Buku) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Dislike</button>
                    </form>
                </div>

                <!-- Display Like and Dislike counts -->
                <div class="like-dislike-counts" style="text-align: center; margin-top: 10px;">
                    <p><strong>Likes:</strong> {{ $item->Likes ?? 0 }}</p>
                    <p><strong>Dislikes:</strong> {{ $item->Dislikes ?? 0 }}</p>
                </div>
            @endforeach

            <a href="{{ url('/') }}" class="btn btn-outline-secondary" style="margin-top: 20px;">Kembali ke Daftar Buku</a>
        </div>
    </div>
@endsection
