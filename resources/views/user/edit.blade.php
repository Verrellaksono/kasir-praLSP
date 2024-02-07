@extends('template.master')

@section('title', 'Kasir | Edit User')

@section('content')
    <a href="{{ route('user.index') }}" class="btn btn-primary mb-3 me-3"><i class="fa fa-angle-left"></i>
        Kembali</a>
    <h4>Edit User</h4>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <form action="{{ route('user.update', ['user' => $user['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td>ID User</td>
                        <td><input type="text" readonly="readonly" class="form-control" value="{{ $user->id }}"
                                name="id"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" class="form-control" value="{{ $user->username }}" name="username">
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="text" class="form-control" value="{{ $user->password }}" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select class="form-select" name="status">
                                <option value="Administrator" {{ $user->status == 'Administrator' ? 'selected' : '' }}>
                                    Administrator</option>
                                <option value="Petugas" {{ $user->status == 'Petugas' ? 'selected' : '' }}>
                                    Petugas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button>
                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection
