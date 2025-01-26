@extends('welcome')
@section('title', 'Data Kategori')

@section('content')
<div class="position-absolute top-50 start-50 translate-middle" style="width: 60%; margin-left: 10px; margin-right: 10px; padding: 20px;">
    <h2 style="color: black; text-align: center; padding: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; text-shadow: 2px 3px #dddddd;"">Data Kategori</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal" style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem; float: inline-end; margin-bottom: 1.5rem; box-shadow: 2px 3px #dddddd;">
        Tambah Data
    </button>

    <table id="display" class="table table-striped" style="font-family: Arial, Helvetica, sans-serif; border: 1px solid #dddddd; text-align: left; padding: 5px; width: 100%; box-shadow: 2px 5px rgba(15, 15, 15, 0.56);">
        <thead>
            <tr>
                <th scope="col" style="width: 7rem; text-align: center;">No</th>
                <th scope="col" style="text-align: center;">Nama</th>
                <th scope="col" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->Name_Category }}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $item->id }}">Edit</button>

                        <form action="{{ route('categories.destroy', $item->ID_Category) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data Tersebut?')">
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Name_Category">Nama Kategori</label>
                        <input type="text" class="form-control" id="Name_Category" name="Name_Category" required placeholder="Masukkan Nama Kategori">
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
 @foreach ($categories as $item)
<div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Data Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $item->ID_Category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Name_Category">Nama Kategori</label>
                        <input type="text" class="form-control" id="Name_Category" name="Name_Category" value="{{ $item->Name_Category }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
