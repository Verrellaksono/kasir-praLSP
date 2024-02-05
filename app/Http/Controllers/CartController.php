<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Session::get('cart', []);
        return view('cart.index', compact('cartItems'));
    }
}
