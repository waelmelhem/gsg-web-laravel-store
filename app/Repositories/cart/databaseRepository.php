<?php

namespace App\Repositories\cart;

use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class DatabaseRepository implements CartRepository
{
    protected $item;
    protected $cookie_id;
    public function __construct()
    {
        $this->cookie_id=app("cart.cookie_id");
    }
    public function all()
    {
        $this->item=cart::with('product')
        ->where('cookie_id', '=',$this->cookie_id)
        ->orWhere('user_id','=',Auth::id()?:-12)
        ->get();
        return $this->item;
        // $id=Auth::id();
        // $this->item=cart::with('product')
        // ->where('cookie_id', '=',$this->cookie_id)
        // ->when($id,function($query,$id){
        //     $query->where('user_id',$id);
        // })
        // ->get();
        // return $this->item;
    }
    public function add($item,$qty=1){
        // dd($qty);

        $cart=Cart::where(
            [
                'cookie_id'=>$this->cookie_id,
                'product_id'=>$item
            ]
        )->when(Auth::check(),function($query){
            $query->Where('user_id',Auth::id());
        })->first();
        // dd($cart,$this->cookie_id);
        if(!$cart){
            Cart::create([
                'id'=>Str::uuid(),
                'cookie_id'=>$this->cookie_id,
                'user_id'=>Auth::id(),
                'product_id'=>$item,
                'quantity'=>$qty,
            ]);
    }
    else{
        $cart->increment('quantity',$qty);
    }

    }
    public function remove($id){
        Cart::where([
            'id'=>$id,
            'cookie_id'=>$this->cookie_id,
        ])
        ->delete();
        Cart::where([
            'id'=>$id,
            'user_id'=>Auth::id(),
        ])
        ->delete();
        
        // dd($this->cookie_id);
    }
    public function empty(){
        Cart::where([
            'cookie_id'=>$this->cookie_id,
        ])
        ->delete();
    }
    public function total(){
        return $this->item->sum(function($item){
            return $item->quantity*$item->product->price;
        });
    }
    public function count(){
        return $this->count=$this->item->sum(function($item){
            return $item->quantity;
        });
    }
    public function destroy(CartRepository $cart,$id)
    {
        
        $cart->remove($id);
        return redirect()->back();
    }
}