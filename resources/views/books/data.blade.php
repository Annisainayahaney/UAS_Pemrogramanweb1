@extends('welcome')
@section('title', 'Data Buku')

@section('content')
<div class="position-absolute top-50 start-50 translate-middle" style="width: 60%; margin-left: 10px; margin-right: 10px; padding: 20px;">
    <h2 style="color: black; text-align: center; padding: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; text-shadow: 2px 3px #dddddd;">Data Buku</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal" style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem; float: inline-end; margin-bottom: 1.5rem; box-shadow: 2px 3px #dddddd;">
        Tambah Data
    </button>

    <table id="display" class="table table-striped" style="font-family: Arial, Helvetica, sans-serif; border: 1px solid #dddddd; text-align: left; padding: 5px; width: 100%; box-shadow: 2px 5px rgba(15, 15, 15, 0.56);">
        <thead>
            <tr>
                <th scope="col" style="width: 7rem; text-align: center;">No</th>
                <th scope="col" style="text-align: center;">Judul Buku</th>
                <th scope="col" style="text-align: center;">Penulis</th>
                <th scope="col" style="text-align: center;">Penerbit</th>
                <th scope="col" style="text-align: center;">Sinopsis</th>
                <th scope="col" style="text-align: center;">Kategori</th>
                <th scope="col" style="text-align: center;">Like</th>
                <th scope="col" style="text-align: center;">Dislike</th>
                <th scope="col" style="text-align: center;">Status</th>
                <th scope="col" style="text-align: center; white-space: nowrap;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: left; white-space: nowrap;">{{ $item->Judul_Buku }}</td>
                    <td style="text-align: left; white-space: nowrap;">{{ $item->Nama_Penulis }}</td>
                    <td style="text-align: left; white-space: nowrap;">{{ $item->Tahun_Terbit }}, {{ $item->Nama_Penerbit }}</td>
                    <td style="text-align: left; word-break: break-word;">{{ $item->Sinopsis }}</td>
                    <td style="text-align: center; white-space: nowrap;">{{ $item->ID_Category }}</td>
                    <td style="text-align: center; white-space: nowrap;">{{ $item->Likes }}</td>
                    <td style="text-align: center; white-space: nowrap;">{{ $item->Dislikes }}</td>
                    <td style="text-align: center; white-space: nowrap;">{{ $item->status }}</td>
                    <td style="text-align: center; white-space: nowrap;">
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBookModal{{ $item->ID_Buku }}">Edit</button>

                        <!-- Delete Button -->
                        <form action="{{ route('books.destroy', $item->ID_Buku) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data Tersebut?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Tambah Data Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Judul_Buku">Judul Buku</label>
                        <input type="text" class="form-control" id="Judul_Buku" name="Judul_Buku" required placeholder="Masukkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <label for="Nama_Penulis">Nama Penulis</label>
                        <input type="text" class="form-control" id="Nama_Penulis" name="Nama_Penulis" required placeholder="Masukkan Nama Penulis">
                    </div>
                    <div class="form-group">
                        <label for="Tahun_Terbit">Tahun Terbit</label>
                        <input type="text" class="form-control" id="Tahun_Terbit" name="Tahun_Terbit" value="{{ old('Tahun_Terbit') }}" required placeholder="Masukkan Tahun Terbit" pattern="\d{4}" title="Masukkan tahun dalam format 4 digit (YYYY)" maxlength="4">
                    </div>
                    <div class="form-group">
                        <label for="Nama_Penerbit">Nama Penerbit</label>
                        <input type="text" class="form-control" id="Nama_Penerbit" name="Nama_Penerbit" required placeholder="Masukkan Nama Penerbit">
                    </div>
                    <div class="form-group">
                        <label for="Sinopsis">Sinopsis</label>
                        <textarea class="form-control" id="Sinopsis" name="Sinopsis" required placeholder="Masukkan Sinopsis Buku"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ID_Category">Category</label>
                        <select name="ID_Category" id="ID_Category" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->ID_Category }}">{{ $category->Name_Category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label><br>
                        <label>
                            <input type="radio" name="status" value="publish" required> Publish
                        </label>
                        <label>
                            <input type="radio" name="status" value="pending" required> Pending
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
@foreach ($books as $item)
<div class="modal fade" id="editBookModal{{ $item->ID_Buku }}" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel">Edit Data Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('books.update', $item->ID_Buku) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Judul_Buku">Judul Buku</label>
                        <input type="text" class="form-control" id="Judul_Buku" name="Judul_Buku" value="{{ $item->Judul_Buku }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Nama_Penulis">Nama Penulis</label>
                        <input type="text" class="form-control" id="Nama_Penulis" name="Nama_Penulis" value="{{ $item->Nama_Penulis }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Tahun_Terbit">Tahun Terbit</label>
                        <input type="text" class="form-control" id="Tahun_Terbit" name="Tahun_Terbit" value="{{ $item->Tahun_Terbit }}" required placeholder="Masukkan Tahun Terbit" pattern="\d{4}" title="Masukkan tahun dalam format 4 digit (YYYY)" maxlength="4">
                    </div>
                    <div class="form-group">
                        <label for="Nama_Penerbit">Nama Penerbit</label>
                        <input type="text" class="form-control" id="Nama_Penerbit" name="Nama_Penerbit" value="{{ $item->Nama_Penerbit }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Sinopsis">Sinopsis</label>
                        <textarea class="form-control" id="Sinopsis" name="Sinopsis" required>{{ $item->Sinopsis }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="ID_Category">Category:</label>
                        <select name="ID_Category" id="ID_Category" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->ID_Category }}" {{ $item->ID_Category == $category->ID_Category ? 'selected' : '' }}>
                                    {{ $category->Name_Category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label><br>
                        <label>
                            <input type="radio" name="status" value="publish" {{ $item->status == 'publish' ? 'checked' : '' }} required> Publish
                        </label>
                        <label>
                            <input type="radio" name="status" value="pending" {{ $item->status == 'pending' ? 'checked' : '' }} required> Pending
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
