<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
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
            return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
        } else {
            return redirect()->route('user.index')->with('error', 'Data user gagal ditambahkan');
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
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
        } else {
            return redirect()->route('user.index')->with('error', 'User tidak ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
