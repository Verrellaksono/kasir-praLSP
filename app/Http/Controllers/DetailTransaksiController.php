<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function create(Request $request)
    {
        $produk_id = $request->produk_id;
        $penjualan_id = $request->penjualan_id;

        $td = DetailPenjualan::wherePenjualanId($penjualan_id)->whereProdukId($produk_id)->first();

        $transaksi = Penjualan::find($penjualan_id);
        if ($td == null) {
            $data = ([
                'subtotal' => $request->subtotal,
                'penjualan_id' => $penjualan_id,
                'produk_id' => $produk_id,
                'jumlahProduk' => $request->qty,
            ]);
            DetailPenjualan::create($data);

            $dt = [
                'totalHarga' => $transaksi->totalHarga + $request->subtotal,
            ];
            $transaksi->update($dt);
        } else {
            $data = ([
                'subtotal' => $request->subtotal + $td->subtotal,
                'jumlahProduk' => $request->qty + $td->jumlahProduk,
            ]);
            $td->update($data);

            $dt = [
                'totalHarga' => $transaksi->totalHarga + $request->subtotal,
            ];
            $transaksi->update($dt);
        }
        return redirect('transaksi/' . $penjualan_id . '/edit');
    }

    public function destroy()
    {
        $id = request('id');
        // dd($id);
        $td = DetailPenjualan::find($id);
        $td->delete();
        return redirect()->back();
    }
}
