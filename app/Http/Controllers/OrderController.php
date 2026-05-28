<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Cart;
use Barryvdh\DomPDF\Facade\Pdf;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{

    public function checkout()
    {
       

        $cart = session()->get('cart', []);

        foreach($cart as $item)
        {
            Cart::updateOrCreate(

                [
                    'user_id'=>auth()->id(),

                    'product_id'=>$item['id']
                ],

                [
                    'product_qty'=>$item['qty']
                ]

            );
        }

        $cartItems = Cart::with('product')
            ->where('user_id',auth()->id())
            ->get();

        return view(
            'cart.checkout',
            compact('cartItems')
        );
    }


    // STRIPE CHECKOUT

    public function stripeCheckout()
    {

    
        $cartItems = Cart::with('product')
            ->where('user_id',auth()->id())
            ->get();

        $lineItems = [];

        foreach($cartItems as $item)
        {

            $lineItems[] = [

                'price_data'=>[

                    'currency'=>'inr',

                    'product_data'=>[

                        'name'=>$item->product->name

                    ],

                    'unit_amount'=>$item->product->price * 100
                ],

                'quantity'=>$item->product_qty
            ];
        }

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        $session = Session::create([

            'payment_method_types'=>['card'],

            'line_items'=>$lineItems,

            'mode'=>'payment',

            'success_url'=>route(
                'payment.success'
            ),

            'cancel_url'=>route(
                'payment.cancel'
            ),

        ]);

        return redirect(
            $session->url
        );
    }


    // SUCCESS

    public function paymentSuccess()
    {
            $paymentId = uniqid('PAY');
        $cartItems = Cart::with('product')
            ->where('user_id',auth()->id())
            ->get();

        foreach($cartItems as $item)
        {

            Order::create([

                'user_id'=>auth()->id(),

                'product_id'=>$item->product_id,

                'product_qty'=>$item->product_qty,

                'product_price'=>$item->product->price,
                  'payment_id' => $paymentId



            ]);
        }

        Cart::where(
            'user_id',
            auth()->id()
        )->delete();

        session()->forget('cart');

        return redirect()
            ->route('invoice')
            ->with(
                'success',
                'Payment Successful!'
            );
    }


    // CANCEL

    public function paymentCancel()
    {
        return redirect()
            ->route('checkout')
            ->with(
                'error',
                'Payment Failed!'
            );
    }


   public function invoice()
{
    $latestPayment = Order::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->first();

    $orders = Order::with('product')
        ->where(
            'payment_id',
            $latestPayment->payment_id
        )
        ->get();

    return view(
        'cart.invoice',
        compact('orders')
    );
}
    public function invoicePdf()
    {
     $latestPayment = Order::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->first();

    $orders = Order::with('product')
        ->where(
            'payment_id',
            $latestPayment->payment_id
        )
        ->get();
        $pdf=Pdf::loadView('cart.invoice-pdf',compact('orders'));
        return $pdf->download('invoice.pdf');
    }

}