<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
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
            'namaPelanggan' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->namaPelanggan = $request->input('namaPelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->noTelp = $request->input('noTelp');
        $pelanggan->save();

        if ($pelanggan->save()) {
            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan');
        } else {
            return redirect()->route('pelanggan.index')->with('error', 'Data pelanggan gagal ditambahkan');
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
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaPelanggan' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
        ]);

        $pelanggan = Pelanggan::find($id);
        $pelanggan->namaPelanggan = $request->input('namaPelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->noTelp = $request->input('noTelp');
        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}
