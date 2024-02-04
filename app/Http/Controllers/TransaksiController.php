<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('transaksi.index', compact('produks'));
    }

    public function addToCart(Request $request)
    {
        // Proses penambahan barang ke tabel pembelian
        // ...

        // Contoh:
        $barangId = $request->input('barang_id');
        $jumlah = $request->input('jumlah');


        return response()->json();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form, sesuaikan dengan kebutuhan aplikasi Anda
        $request->validate([
            'bayar' => 'required|numeric|min:' . $request->total, // Memastikan pembayaran cukup
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan data penjualan ke tabel penjualan
            $penjualan = new Penjualan;
            $penjualan->tanggalPenjualan = now();
            $penjualan->totalHarga = $request->total;
            // $penjualan->pelanggan_id = $request->input('pelanggan_id');
            $penjualan->user_id = auth()->user()->id;
            $penjualan->save();

            // Simpan detail transaksi ke tabel detail_penjualan
            foreach ($request->input('produk_id') as $index => $produkId) {
                // Tambahkan pesan log atau echo di sini untuk melihat nilai variabel
                Log::info("Index: $index, Produk ID: $produkId");

                $detailPenjualan = new DetailPenjualan;
                $detailPenjualan->penjualan_id = $penjualan->id;
                $detailPenjualan->produk_id = $produkId;
                $detailPenjualan->jumlahProduk = $request->input('jumlahProduk')[$index];
                $detailPenjualan->subtotal = $request->input('subtotal')[$index];
                $detailPenjualan->save();
            }

            // Commit transaction
            DB::commit();

            // Redirect or return success response
            return redirect()->route('nama_route_yang_diinginkan')
                ->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            // Log error and rollback transaction
            Log::error("Transaksi gagal: " . $e->getMessage());
            DB::rollback();

            // Redirect or return error response
            return redirect()->back()->with('error', 'Transaksi gagal: ' . $e->getMessage());
        }
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
        //
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
