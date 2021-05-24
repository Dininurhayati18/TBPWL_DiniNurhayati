@extends('adminlte::page')

@section('title', 'Kategori Barang')

@section('content_header')
<h1 class="text-center text-bold">KATEGORI</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahCategoryModal"><i class="fa fa-plus"></i> Tambah Kategori</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KETERANGAN</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button type="button" id="btn-delete-category" class="btn" data-toggle="modal" data-target="#deleteCategoryModal" data-id="{{ $category->id }}"><i class="fa fa-trash"></i></button>
                                                <button type="button" id="btn-edit-category" class="btn" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Kategori --}}
    <div class="modal fade" id="tambahCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" class="form-control" name="description" id="description" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Kategori --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update') }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-name">Nama</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required/>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Keterangan</label>
                            <input type="text" class="form-control" name="description" id="edit-description" required/>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Hapus Kategori --}}
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data tersebut?
                    <form action="{{ route('category.delete') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function(){
             // update category
            $(document).on('click', '#btn-edit-category', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: baseurl+'/ajax/dataCategory/'+id,
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        $('#edit-name').val(res.name);
                        $('#edit-description').val(res.description);
                        $('#edit-id').val(res.id);
                    },
                });
            });
            // delete 
            $(document).on('click', '#btn-delete-category', function(){
                let id = $(this).data('id');
                let nama = $(this).data('name');
                $('#delete-id').val(id);
                $('#delete-nama').text(nama);
            });
        });
    </script>
@stop
