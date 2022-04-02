<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\orderAdress;
use App\Models\User;
use App\Repositories\cart\CartRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class checkoutController extends Controller
{
    public function index(CartRepository $cart)
    {
        $user = Auth::check() ? Auth::user() : new User();
        return view('store.checkout', compact('cart', 'user'));
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'shipping.first_name' => 'required',
            'shipping.last_name' => 'required',
            'shipping.street_address' => 'required',
            'shipping.city' => 'required',
            'shipping.country_code' => 'required',
            'shipping.phone_number' => 'required'

        ]);
        DB::beginTransaction();
        try {
            //add order
            $order = $this->storeOrder($request,$cart);
            //add order adress
            $this->storeAdress($request,$order);
            //add ordr Items
            $this->storeProductItems($cart,$order);
            //cart remove
            $cart->empty();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        User::find(1);
        event(new OrderCreated($order));
        return redirect()->route("payment.create",$order->id);
    }
    protected  function storeOrder(Request $request,CartRepository $cart)
    {
        return Order::create([
            'tax' => $request->post('tax', 0),
            'discount' => $request->post('discount', 0),
            'total' => $cart->total(),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'payment_status' => 'pending',
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
    }
    protected function storeAdress(Request $request ,$order)
    {
        $shipping_adresses = $request->input('shipping');
            $shipping_adresses['type'] = "shipping";
            // dd($shipping_adresses);
            $order->addresses()->create($shipping_adresses);
            $billing_adresses = $request->input('billing');
            if (!$billing_adresses) {
                $billing_adresses = $shipping_adresses;
            }
            $billing_adresses['type'] = "billing";
            $order->addresses()->create($billing_adresses);
    }
    protected FUNCTION storeProductItems(CartRepository $cart,$order)
    {
        foreach ($cart->all() as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }
    }
}
