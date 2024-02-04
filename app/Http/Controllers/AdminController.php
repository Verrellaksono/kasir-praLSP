<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
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

    public function user()
    {
        // Mengambil Data Admin
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function insertUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
        ]);

        if ($user) {
            return redirect()->route('admin.user')->with('success', 'Data user berhasil ditambahkan');
        } else {
            return redirect()->route('admin.user')->with('error', 'Data user gagal ditambahkan');
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.userEdit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);

        $user = User::find($id);

        if ($user) {
            $user->update([
                'username' => $request->username,
                'password' => $request->password,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.user')->with('success', 'Data user berhasil diperbarui');
        } else {
            return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
        }
    }

    public function hapusUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.user')->with('success', 'Data user berhasil dihapus');
        } else {
            return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
        }
    }
}
