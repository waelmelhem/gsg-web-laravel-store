<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required|int|exists:products,id',
            'quantity'=>'int|min:1',
        ]);
        
        $cart=Cart::where(
            [
                'cookie_id'=>app("cart.cookie_id"),
                'product_id'=>$request->product_id
            ]
        )->first();
        // dd(!!$cart);
        if(!$cart){
            Cart::create([
                'id'=>Str::uuid(),
                'cookie_id'=>app("cart.cookie_id"),
                'user_id'=>Auth::id(),
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
            ]);
    }
    else{
        $cart->increment('quantity',$request->quantity);
    }
        return redirect()->back()->with('success','product added to cart');

    }
}
