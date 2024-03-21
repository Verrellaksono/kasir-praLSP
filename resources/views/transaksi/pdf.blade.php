<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1 style="text-align: center">Data Laporan Transaksi</h1>

    <table border="1px" rules="all" align="center" style="width: 95%">
        <thead>
            <tr>
                <th>No</th>
                <th>Petugas
                </th>
                <th>
                    Pelanggan
                </th>
                <th>Produk
                </th>
                <th>Jumlah
                </th>
                <th>Subtotal
                </th>
                <th>Total
                </th>
                <th>Tanggal
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

    <script>
        window.print();
    </script>
</body>

</html>
