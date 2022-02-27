<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Repositories\cart\CartRepository;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(CartRepository $cart)
    {
        return view('store.cart',compact('cart'));
    }
    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'product_id'=>'required|int|exists:products,id',
            'quantity'=>'int|min:1',
        ]);
        $cart->add($request->product_id,$request->quantity);
        return redirect()->back()->with('success','product added to cart');

    }
    public function destroy(CartRepository $cart,$id){
        $cart->destroy($cart,$id);
        return redirect()->back();
    }
}
