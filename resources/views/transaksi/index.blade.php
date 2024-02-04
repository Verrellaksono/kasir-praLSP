@extends('template.master')

@section('title', 'Kasir | Transaksi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Menu</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0 table-menu" id="pesanan">
                        <!-- Trigger the modal with a button -->
                        <div class="clearfix"></div>
                        <br />
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stok
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td class="text-secondary text-xs font-weight-bold ps-4">{{ $counter++ }}</td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 nama-produk">
                                            {{ $produk->namaProduk }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 stok">{{ $produk->stok }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 harga">{{ $produk->harga }}
                                        </td>
                                        <td class="text-secondary text-xs font-weight-bold ps-4 d-flex gap-2">
                                            <button type="button" class="btn btn-success add-to-cart btn-sm mb-0"
                                                data-barang-id="{{ $produk->id }}">
                                                Tambah
                                            </button>
                                        </td>
                                        <td>
                                        <td></td>
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

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Pembelian</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0" id="pesanan">
                        <!-- Trigger the modal with a button -->
                        <div class="clearfix"></div>
                        <br />
                        <table class="table tabelPembelian align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
                                @csrf


                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td><input type="text" id="total" name="total"
                                                class="form-control border ps-3" readonly>
                                        </td>
                                        <td><b>Bayar</b></td>
                                        <td><input type="number" id="bayar" class="form-control border ps-3"
                                                name="bayar"required></td>
                                        <td><button type="button" class="btn btn-primary mt-3"
                                                id="btnBayar">Bayar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Kembali</b></td>
                                        <td><input type="text" id="kembalian" class="form-control border ps-3" readonly>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Memanggil hitungTotal() saat halaman selesai dimuat
            hitungTotal();

            $('.add-to-cart').on('click', function() {
                var barangId = $(this).data('barang-id');
                var namaProduk = $(this).closest('tr').find('.nama-produk').text();
                var harga = parseFloat($(this).closest('tr').find('.harga').text()); // Parse as float

                // Ambil nilai counter
                var counter = $('.tabelPembelian tbody tr').length + 1;

                // Temukan tabel pembelian dan tambahkan baris baru
                var tabelPembelian = $('.tabelPembelian tbody');
                var newRow = '<tr>' +
                    '<td class="text-secondary text-xs font-weight-bold ps-4">' + counter +
                    '</td>' +
                    '<td class="text-secondary text-xs font-weight-bold ps-4" data-name="namaProduk">' +
                    namaProduk +
                    '</td>' +
                    '<td class="text-secondary text-xs font-weight-bold ps-4"><input type="number" class="form-control jumlahProduk" name="jumlahProduk" value="1" required></td>' +
                    '<td class="text-secondary text-xs font-weight-bold ps-4 harga" data-name="harga">' +
                    harga +
                    '</td>' +
                    '<td class="text-secondary text-xs font-weight-bold ps-4 subtotal" data-name="subtotal">' +
                    harga + '</td>' +
                    '</tr>';

                tabelPembelian.append(newRow);

                // Hitung total keseluruhan setelah menambahkan baris baru
                hitungTotal();
            });

            // Menambahkan event listener untuk menghitung subtotal secara dinamis saat nilai input berubah
            $(document).on('input', '.jumlahProduk', function() {
                var jumlahProduk = parseInt($(this).val()) || 1;
                var harga = parseFloat($(this).closest('tr').find('.harga').text());

                // Cek apakah harga adalah NaN atau kurang dari 0, jika iya, atur ke 0
                harga = isNaN(harga) || harga < 0 ? 0 : harga;

                var subtotal = harga * jumlahProduk;

                // Tampilkan subtotal, tetapi konversi ke string terlebih dahulu
                $(this).closest('tr').find('.subtotal').text(subtotal.toString());

                // Hitung total keseluruhan setelah mengubah nilai input
                hitungTotal();
            });

            function hitungTotal() {
                var total = 0;

                // Iterasi setiap baris dan tambahkan subtotal ke total
                $('.tabelPembelian tbody tr').each(function() {
                    total += parseFloat($(this).find('.subtotal').text()) || 0;
                });

                // Tampilkan total pada input total
                $('#total').val(total);

                // Mengupdate nilai total pada form bayar jika ada
                $('#bayar').attr('min', total); // Menyimpan total sebagai nilai minimum pembayaran
            }

            $('#btnBayar').on('click', function() {
                var total = parseFloat($('#total').val());
                var bayar = parseFloat($('#bayar').val());

                if (isNaN(bayar) || bayar < total) {
                    alert('Jumlah pembayaran tidak mencukupi.');
                    return;
                }

                $.ajax({
                    url: '{{ route('transaksi.store') }}',
                    method: 'POST',
                    data: $('#transaksiForm').serialize(),
                    success: function(response) {
                        // Handle successful transaction (redirect, etc.)
                        console.log("Transaksi berhasil:", response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors (display error messages, etc.)
                        console.error("Transaksi gagal:", error);
                    }
                });
            });

            $('#bayar').on('click', function() {
                console.log('Button Bayar Clicked');
                // ... (lanjutan kode)
            });
        });
    </script>
@endsection
