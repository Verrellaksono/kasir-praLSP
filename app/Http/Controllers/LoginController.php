<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            auth()->login($user);
            if (auth()->user()->status == 'Administrator') {
                return redirect()->route('produk.index');
            } elseif (auth()->user()->status == 'Waiter') {
                return redirect()->route('produk.index');
            } elseif (auth()->user()->status == 'Kasir') {
                return redirect()->route('transaksi.index');
            } elseif (auth()->user()->status == 'Owner') {
                return redirect()->route('transaksi.index');
            }
        } else {
            return back()->withErrors(['login' => 'Username atau password salah']);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('viewLogin');
    }
}
