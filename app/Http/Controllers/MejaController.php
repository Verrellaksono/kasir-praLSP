<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meja = Meja::all();
        return view('meja.index', compact('meja'));
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
            'no_meja' => 'required',
        ]);

        $meja = new Meja();
        $meja->no_Meja = $request->input('no_meja');
        $meja->save();

        if ($meja->save()) {
            return redirect()->route('meja.index')->with('success', 'Data Meja berhasil ditambahkan');
        } else {
            return redirect()->route('meja.index')->with('error', 'Data Meja gagal ditambahkan');
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
        $meja = Meja::find($id);
        return view('meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_meja' => 'required',
        ]);

        $meja = Meja::find($id);
        $meja->no_meja = $request->input('no_meja');
        $meja->save();
        return redirect()->route('meja.index')->with('success', 'Data Meja berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meja = Meja::find($id);
        $meja->delete();
        return redirect()->route('meja.index')->with('success', 'Data Meja berhasil dihapus');
    }
}
