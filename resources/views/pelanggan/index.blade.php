@extends('template.master')

@section('title', 'Kasir | Data Pelanggan')

@section('content')
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

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Pelanggan</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0" id="pesanan">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal"
                            data-target="#myModal">
                            <i class="fa fa-plus"></i> Data Pelanggan</button>
                        {{-- <a href="index.php?menu=barang" class="btn btn-success btn-md">
                            <i class="fa fa-refresh"></i> Refresh Data</a> --}}
                        <div class="clearfix"></div>
                        <br />
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Pelanggan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Telp
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($pelanggans as $pelanggan)
                                    <tr>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $counter++ }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">
                                            {{ $pelanggan->namaPelanggan }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $pelanggan->alamat }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $pelanggan->noTelp }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 d-flex gap-2">
                                            <a href="{{ route('pelanggan.edit', $pelanggan['id']) }}"
                                                class="btn btn-warning btn-sm mb-0">Edit</a>
                                            <form
                                                action="{{ route('pelanggan.destroy', ['pelanggan' => $pelanggan['id']]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-0"
                                                    data-confirm-delete="true">Hapus</button>
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

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style=" border-radius:0px;">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i>Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    <div class="modal-body">
                        <table class="table table-striped bordered">
                            @csrf
                            <tr>
                                <td>Nama Pelanggan</td>
                                <td><input type="text" placeholder="Nama Pelanggan" required class="form-control"
                                        name="namaPelanggan"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><input type="text" placeholder="Alamat" required class="form-control" name="alamat">
                                </td>
                            </tr>
                            <tr>
                                <td>No. Telp</td>
                                <td><input type="text" required Placeholder="Nomor Telpon" class="form-control"
                                        name="noTelp">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert
                            Data</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
