<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function barang()
    {
        // Mengambil Data Produks
        $produks = Produk::all();
        return view('admin.barang', compact('produks'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'namaProduk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk = new Produk();
        $produk->namaProduk = $request->input('namaProduk');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');

        $produk->save();

        if ($produk->save()) {
            return redirect()->route('admin.barang')->with('success', 'Data produk berhasil ditambahkan');
        } else {
            return redirect()->route('admin.barang')->with('error', 'Data produk gagal ditambahkan');
        }
    }

    public function hapus($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('admin.barang')->with('success', 'Data produk berhasil dihapus');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('admin.barangEdit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaProduk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk = Produk::find($id);
        $produk->namaProduk = $request->input('namaProduk');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');

        $produk->save();
        return redirect()->route('admin.barang')->with('success', 'Data produk berhasil diupdate');
    }
}
