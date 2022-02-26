<?php

namespace App\View\Components;

use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class cartMenue extends Component
{
    public $cart;
    public $total;
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart=Cart::where('cookie_id', '=',app("cart.cookie_id"))
        ->orWhere('user_id','=',Auth::id())
        ->get();
        $this->total=$this->cart->sum(function($item){
            return $item->quantity*$item->product->price;
        });
        $this->count=$this->cart->sum(function($item){
            return $item->quantity;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menue');
    }

}
