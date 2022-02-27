<?php

namespace App\View\Components;

use App\Models\cart;
use App\Repositories\cart\CartRepository;
use Illuminate\Support\Facades\App;
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
    public function __construct(CartRepository $cart)
    {
        $this->cart=$cart->all();
        $this->total=$cart->total();
        $this->count=$cart->count();
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
