<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Sample\PayPalClient;
use Illuminate\Http\Request;
use PayPalHttp\HttpException;
use Illuminate\Support\Facades\App;
use App\Providers\RouteServiceProvider;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Payments\CapturesRefundRequest;

class paymentController extends Controller
{
    public function create(Order $order)
    {
        if ($order->payment_status == "paied") {
            return redirect(RouteServiceProvider::HOME);
        }
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => $order->id,
                    "amount" => [
                        "value" => $order->total,
                        "currency_code" => "ILS"
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route("payments.cancel", $order->id),
                "return_url" => route("payments.callback", $order->id)
            ]
        ];

        try {
            $client = App::make("paypal.client");
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            if ($response->statusCode == 201) {

                foreach ($response->result->links as $link) {
                    if ($link->rel == "approve") {
                        return redirect()->away($link->href);
                    }
                }
            }
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            dd($ex->getMessage());
        }
    }
    public function cancel(Order $order)
    {
    }
    public function callback(Request $request, Order $order)
    {
        if ($order->payment_status == "paied") {
            return redirect(RouteServiceProvider::HOME);
        }
        $paypal_order_id = $request->query('token');
        $client = App::make("paypal.client");
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $capture_request = new OrdersCaptureRequest($paypal_order_id);
        $capture_request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($capture_request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            if ($response->statusCode == 201 && $response->result->status == 'COMPLETED') {
                $order->forceFill([
                    "payment_status" => "paied",
                    'payment_method' => "palpay",
                    "payment_transaction_id" => $paypal_order_id,
                    "payment_data" => $response,
                ])->save();
                return redirect(RouteServiceProvider::HOME);
            }
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
    public function refund(Order $order)
    {
        if ($order->payment_status != "paied") {
            return redirect(RouteServiceProvider::HOME);
        }
        $captureId = $order->payment_data['result']['purchase_units'][0]['payments']['captures'][0]['id'];
        $request = new CapturesRefundRequest($captureId);
        $request->body = [
            'amount' =>
            [
                'value' => $order->total,
                'currency_code' => 'ILS'
            ]
        ];
        $client = App::make('paypal.client');
        $response = $client->execute($request);
        if($response->statusCode==201){
            $order->status="refunded";
            $order->save();
        }
        return $response;
    }
}
