<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\IFTTTHandler;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        $pelanggans = Pelanggan::all();
        $penjualans = Penjualan::with('user', 'pelanggan', 'detailPenjualan.produk')->orderBy('created_at', 'desc')->get();
        $data = ([
            'produks' => $produks,
            'pelanggans' => $pelanggans,
            'penjualans' => $penjualans,
        ]);
        return view('transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = ([
            'tanggalPenjualan' => now(),
            'totalHarga' => 0,
            'pelanggan_id' => $request->pelanggan_id,
            'user_id' => auth()->user()->id,
        ]);
        $transaksi = Penjualan::create($data);
        return redirect('transaksi/' . $transaksi->id . '/edit');
    }

    protected function addTransaksi()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produks = Produk::all();
        $pelanggan = Pelanggan::all();

        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);

        $transaksi_detail = DetailPenjualan::with('produk')->wherePenjualanId($id)->get();
        // dd($transaksi_detail);

        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }

        $subtotal = 0;
        if ($p_detail) {
            $subtotal = $qty * $p_detail->harga;
            $p_detail->stok - $qty;
        }

        $transaksi = Penjualan::find($id);

        $message = "";
        $pembayaran = request('dibayarkan');
        if ($pembayaran) {
            $kembalian = $pembayaran - $transaksi->totalHarga;
            if ($kembalian < 0) {
                return redirect()->back()->withInput()->with('error', 'Pembayaran kurang');
            } else {
                $message = "Pembayaran Berhasil";
            }
        } else {
            $kembalian = 0;
        }

        $data = [
            'produks' => $produks,
            'pelanggans' => $pelanggan,
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'transaksi_detail' => $transaksi_detail,
            'transaksi' => $transaksi,
            'kembalian' => $kembalian,
            'message' => $message,
        ];
        return view('transaksi.tambah', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
