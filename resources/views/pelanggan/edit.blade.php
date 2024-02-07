@extends('template.master')

@section('title', 'Kasir | Edit Produk')

@section('content')
    <a href="{{ route('pelanggan.index') }}" class="btn btn-primary mb-3 me-3"><i class="fa fa-angle-left"></i>
        Kembali</a>
    <h4>Edit Pelanggan</h4>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <form action="{{ route('pelanggan.update', ['pelanggan' => $pelanggan['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td>ID Pelanggan</td>
                        <td><input type="text" readonly="readonly" class="form-control" value="{{ $pelanggan->id }}"
                                name="id"></td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td><input type="text" class="form-control" value="{{ $pelanggan->namaPelanggan }}"
                                name="namaPelanggan">
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><input type="text" class="form-control" value="{{ $pelanggan->alamat }}" name="alamat"></td>
                    </tr>
                    <tr>
                        <td>No.Telp</td>
                        <td><input type="number" class="form-control" value="{{ $pelanggan->noTelp }}" name="noTelp"></td>
                    </tr>
                    <tr>
                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data Pelanggan</button>

                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection
