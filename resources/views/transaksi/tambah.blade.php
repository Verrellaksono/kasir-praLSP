@extends('template.master')

@section('title', 'Kasir | Tambah Transaksi')

@section('content')
    <a href="{{ route('transaksi.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form action="" method="GET">
                                <div class="d-flex gap-2">
                                    <select name="produk_id" id="" class="form-control border ps-2">
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->namaProduk }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary m-0"><i
                                            class="fas fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('detail-transaksi.create') }}" method="POST">
                        @csrf

                        <input type="hidden" name="penjualan_id" value="{{ Request::segment(2) }}">
                        <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                        <input type="hidden" name="nama_produk"
                            value="{{ isset($p_detail) ? $p_detail->namaProduk : '' }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control border ps-2" id="" name="nama_produk"
                                    disabled value="{{ isset($p_detail) ? $p_detail->namaProduk : '' }} ">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Harga Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control border ps-2" id="" name="harga_satuan"
                                    disabled value="{{ isset($p_detail) ? $p_detail->harga : '' }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}"
                                        class="btn btn-primary btn-sm m-0 me-2 @if ($qty <= 1) ? disabled : '' @endif"><i
                                            class="fas fa-minus"></i></a>
                                    <input type="number" value="{{ $qty }}" class="form-control border ps-2"
                                        name="qty" id="">
                                    <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}"
                                        class="btn btn-primary btn-sm m-0 ms-2"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="" class="h6">Subtotal : </label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control border text-bold ps-2" id=""
                                    name="subtotal" value="{{ $subtotal }}" disabled>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
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
                            <th>Subtotal</th>
                            <th>#</th>
                        </tr>
                        @foreach ($transaksi_detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->produk ? $item->produk->namaProduk : 'Produk tidak ditemukan' }}</td>
                                <td>{{ $item->jumlahProduk }}</td>
                                <td>{{ $item->subtotal }}</td>
                                <td>
                                    <a href="{{ url('detail-transaksi/destroy') }}?id={{ $item->id }}"><i
                                            class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="GET">

                        <div class="form-group">
                            <label for="">Total </label>
                            <input type="number" name="total" class="form-control border ps-2" id=""
                                value="{{ $transaksi->totalHarga }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="">Dibayarkan </label>
                            <input type="number" name="dibayarkan" class="form-control border ps-2" id=""
                                value="{{ request('dibayarkan') }}">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block mt-3">Bayar</button>
                        </div>
                    </form>

                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="number" name="Kembalian" class="form-control border ps-2" id="" disabled
                            value="{{ $kembalian }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
