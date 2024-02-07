<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
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
            return redirect()->route('produk.index')->with('success', 'Data produk berhasil ditambahkan');
        } else {
            return redirect()->route('produk.index')->with('error', 'Data produk gagal ditambahkan');
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
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus');
    }
}
