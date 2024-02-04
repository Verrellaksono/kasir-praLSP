@extends('template.master')

@section('title', 'Kasir | Data User')

@section('content')
    {{-- Table User --}}
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Users</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0" id="pesanan">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal"
                            data-target="#myModal">
                            <i class="fa fa-plus"></i> Insert User</button>
                        {{-- <a href="index.php?menu=barang" class="btn btn-success btn-md">
                        <i class="fa fa-refresh"></i> Refresh Data</a> --}}
                        <div class="clearfix"></div>
                        <br />
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Password
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $counter++ }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $user->username }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $user->password }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $user->status }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 d-flex gap-2">
                                            <a href="{{ route('user.edit', ['user' => $user['id']]) }}"
                                                class="btn btn-warning btn-sm mb-0">Edit</a>

                                            <form action="{{ route('user.destroy', ['user' => $user['id']]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-0">Hapus</button>
                                            </form>
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

    {{-- Insert User --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i>Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    <div class="modal-body">
                        <table class="table table-striped bordered">
                            @csrf
                            <tr>
                                <td>Username</td>
                                <td><input type="text" placeholder="Username" required class="form-control"
                                        name="username"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="text" placeholder="Password" required class="form-control"
                                        name="password"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <select name="status" class="form-control">
                                        <option value="Administrator" selected>Administrator</option>
                                        <option value="Petugas">Petugas</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                            User</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
