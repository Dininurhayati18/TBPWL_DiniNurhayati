@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
<h1 class="text-center text-bold">USER</h1>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahUser"><i class="fa fa-plus"></i> Tambah User</button>
                    <div class="btn-group mb-5" role="group" aria-label="Basis Example">
                    </div>
                    <hr/>
                    <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>FOTO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                                <th>ROLES</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>
                                    @if($user->photo !== null)
                                    <img src="{{ asset('storage/photo_user/'.$user->photo) }}" width="100px" />
                                    @else
                                    [Picture Not Found]
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->password}}</td>
                                <td>{{$user->roles_id}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-delete-user" class="btn" data-toggle="modal" data-target="#deleteUserModal" data-id="{{ $user->id }}" data-cover="{{ $user->photo }}"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="btn-edit-user" class="btn" data-toggle="modal" data-target="#editUserModal" data-id="{{ $user->id }}"><i class="fa fa-edit"></i></button>
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

<!-- Modal Tambah User  -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('user.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group ">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input min="1" type="password" class="form-control" name="password" id="password" required />
                    </div>
                    <div class="form-group">
                        <label for="roles_id">Role</label>
                        <input type="text" class="form-control" name="roles_id" id="roles_id" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" class="form-control" name="photo" id="photo" />
                    </div>
                </div>
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

<!-- Modal Edit User -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="edit-name" required />
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="edit-username" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="edit-email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password lama</label>
                                <input min="0" type="text" class="form-control" name="password" id="edit-password" required />
                            </div>
                            <div class="form-group">
                                <label for="roles_id">Roles/label>
                                <input type="text" class="form-control" name="roles_id" id="edit-roles_id" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-photo">Picture</label>
                                <input type="file" class="form-control" name="photo" id="edit-photo" />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="old_photo" id="edit-old-photo" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete User -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data tersebut? <strong class="font-italic" id="delete-name"></strong>?
                <form method="post" action="{{ route('user.delete') }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="delete-id" value="" />
                <input type="hidden" name="old_photo" id="delete-old-photo" />
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
    $(function() {
        $(document).on('click', '#btn-edit-user', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let password = $(this).data('password');
            let roles_id = $(this).data('roles_id');
            let photo = $(this).data('photo');

            $('#image-area').empty();
            $('#edit-name').val(name);
            $('#edit-username').val(username);
            $('#edit-email').val(email);
            $('#edit-password').val(password);
            $('#edit-roles_id').val(roles_id);
            $('#edit-id').val(id);
            $('#edit-old-photo').val(photo);
            if (photo !== null) {
                $('#image-area').append(
                    "<img src='" + baseurl + "/storage/photo_user/" + photo + "' width='200px'/>"
                );
            } else {
                $('#image-area').append('[Gambar tidak tersedia]');
            }
            // $.ajax({
            //     type: "get",
            //     url: baseurl + '/admin/ajaxadmin/dataUser/' + id,
            //     dataType: 'json',
            //     success: function(res) {
            //         console.log(res);
            //         $('#edit-name').val(res.name);
            //         $('#edit-username').val(res.username);
            //         $('#edit-email').val(res.email);
            //         $('#edit-password').val(res.password);
            //         $('#edit-roles_id').val(res.roles_id);
            //         $('#edit-id').val(res.id);
            //         $('#edit-old-photo').val(res.photo);
            //         if (res.photo !== null) {
            //             $('#image-area').append(
            //                 "<img src='" + baseurl + "/storage/photo_user/" + res.photo + "' width='200px'/>"
            //             );
            //         } else {
            //             $('#image-area').append('[Gambar tidak tersedia]');
            //         }
            //     },
            // });
        });
        $(document).on('click', '#btn-delete-user', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let password = $(this).data('password');
            let roles_id = $(this).data('roles_id');
            let photo = $(this).data('photo');
            $('#delete-id').val(id);
            $('#delete-old-photo').val(photo);
            $('#delete-name').text(name);
            console.log("hai!");
        });
    });
</script>
@stop