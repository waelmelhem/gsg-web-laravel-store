<?php

namespace App\Http\Controllers;

use App\Repositories\cart\CartRepository;
use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function index(CartRepository $cart){
        return view('store.checkout',compact('cart'));
    }

    public function store(Request $request ,CartRepository $cart){
        return view('store.checkout',compact('cart'));
    }
}
