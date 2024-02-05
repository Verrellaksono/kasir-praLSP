@extends('template.master')

@section('title', 'Kasir | Tambah Transaksi')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    for
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <select name="produk_id" id="" class="form-control border ps-2">
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->namaProduk }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control border ps-2" id="" name="nama_produk"
                                value="{{ isset($p_detail) ? $p_detail->namaProduk : '' }} ">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Harga Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control border ps-2" id="" name="harga_satuan"
                                value="{{ isset($p_detail) ? $p_detail->harga : '' }}">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-minus"></i></button>
                                <input type="number" class="form-control border ps-2" name="qty" id="">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <b>Subtotal : Rp. 20000</b>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>#</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href=""><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    </table>
                    <a href="" class="btn btn-primary">Selesai</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Total </label>
                        <input type="number" name="total" class="form-control border ps-2" id="">
                    </div>

                    <div class="form-group">
                        <label for="">Dibayarkan </label>
                        <input type="number" name="dibayarkan" class="form-control border ps-2" id="">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Hitung</button>

                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="number" name="Kembalian" class="form-control border ps-2" id="" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
