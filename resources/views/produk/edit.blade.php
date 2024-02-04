@extends('template.master')

@section('title', 'Kasir | Edit Produk')

@section('content')
    <a href="{{ route('produk.index') }}" class="btn btn-primary mb-3 me-3"><i class="fa fa-angle-left"></i>
        Kembali</a>
    <h4>Edit Produk</h4>
    <div class="card card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <form action="{{ route('produk.update', ['produk' => $produk['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td>ID Barang</td>
                        <td><input type="text" readonly="readonly" class="form-control" value="{{ $produk->id }}"
                                name="id"></td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td><input type="text" class="form-control" value="{{ $produk->namaProduk }}" name="namaProduk">
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><input type="number" class="form-control" value="{{ $produk->harga }}" name="harga"></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td><input type="number" class="form-control" value="{{ $produk->stok }}" name="stok"></td>
                    </tr>
                    <tr>
                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button>

                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection
