@extends('template.master')

@section('title', 'Kasir | Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Laporan Transaksi</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi.create') }}" method="GET">
                        <div class="row mt-2 d-flex justify-content-between align-items-center">
                            <div class="col-10 d-flex justify-content-start align-items-center gap-3">
                                @if (auth()->check() && auth()->user()->status !== 'Owner')
                                    <div class="col d-flex justify-content=center align-items-center">
                                        <label for="" class="m-0 text-bold">Nama Pelanggan : </label>
                                        <select name="pelanggan_id" id="" class="form-control border ps-2">
                                            @foreach ($pelanggans as $pelanggan)
                                                <option value="{{ $pelanggan->id }}"
                                                    @if ($loop->first) selected @endif>
                                                    {{ $pelanggan->namaPelanggan }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col d-flex justify-content=center align-items-center">
                                        <label for="" class="m-0 text-bold">Meja: </label>
                                        <select name="meja_id" id="" class="form-control border ps-2">
                                            @foreach ($meja as $meja)
                                                <option value="{{ $meja->id }}"
                                                    @if ($loop->first) selected @endif>
                                                    {{ $meja->no_meja }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col d-flex justify-content=center align-items-center">
                                        <button type="submit" class="btn btn-primary m-0"><i class="fas fa-plus"></i>
                                            Order</button>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-2 d-flex justify-content-end align-items-center ">
                                <a href="{{ route('transaksi.pdf') }}" class="btn btn-outline-primary m-0"><i
                                        class="fas fa-print"></i>
                                    Cetak</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive p-0" id="pesanan">
                        <!-- Trigger the modal with a button -->
                        <div class="clearfix"></div>
                        <br />
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Petugas
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pelanggan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subtotal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @if ($penjualans->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-secondary text-xs font-weight-bold ps-4">
                                            Tidak ada data</td>
                                    </tr>
                                @else
                                    @foreach ($penjualans as $penjualan)
                                        <tr>
                                            <td class="text-secondary text-xs font-weight-bold ps-4">{{ $counter++ }}
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4 nama-produk">
                                                @if ($penjualan->pelanggan)
                                                    {{ $penjualan->user->username }}
                                                @else
                                                    Pelanggan tidak ditemukan
                                                @endif
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4 stok">
                                                @if ($penjualan->pelanggan)
                                                    {{ $penjualan->pelanggan->namaPelanggan }}
                                                @else
                                                    Pelanggan tidak ditemukan
                                                @endif
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4">
                                                @foreach ($penjualan->detailPenjualan as $detail)
                                                    {{ $detail->produk->namaProduk }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4">
                                                @foreach ($penjualan->detailPenjualan as $detail)
                                                    {{ $detail->jumlahProduk }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4">
                                                @foreach ($penjualan->detailPenjualan as $detail)
                                                    Rp. {{ $detail->subtotal }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4 harga">
                                                Rp. {{ $penjualan->totalHarga }}.00,-
                                            </td>
                                            <td class="text-secondary text-xs font-weight-bold ps-4 harga">
                                                {{ $penjualan->tanggalPenjualan }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        @csrf
                        <tr>
                            <td>Produk yang dibeli</td>
                            <td><input type="text" placeholder="Nama Produk" required class="form-control"
                                    name="namaProduk"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="number" placeholder="Harga" required class="form-control" name="harga">
                            </td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><input type="number" required Placeholder="Stok" class="form-control" name="stok">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-blocked" data-dismiss="modal"><i
                            class="fa fa-plus"></i> Insert
                        Data</button>
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Generate Laporan',
                    action: function(e, dt, button, config) {
                        // Logic untuk generate laporan
                        alert('Laporan berhasil digenerate!');
                    }
                }]
            });
        });
    </script>
@endsection
