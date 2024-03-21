@extends('template.master')

@section('title', 'Edit Nomor Meja')

@section('content')

    <a href="{{ route('meja.index') }}" class="btn btn-primary mb-3 me-3"><i class="fa fa-angle-left"></i>
        Kembali</a>
    @if (session('success'))
        <h6 class="alert alert-success text-white">
            {{ session('success') }}
        </h6>
    @endif

    @if (session('error'))
        <h6 class="alert alert-danger text-white">
            {{ session('error') }}
        </h6>
    @endif
    <h4>Edit Meja</h4>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <form action="{{ route('meja.update', ['meja' => $meja['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td>ID Meja</td>
                        <td><input type="text" readonly="readonly" class="form-control" value="{{ $meja->id }}"
                                name="id"></td>
                    </tr>
                    <tr>
                        <td>Nomor Meja</td>
                        <td><input type="text" class="form-control" value="{{ $meja->no_meja }}" name="no_meja">
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
