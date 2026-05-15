<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // Product already exists
        if(isset($cart[$id]))
        {
            $cart[$id]['qty'] += $request->qty;
        }
        else
        {
            $cart[$id] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $product->price,

                'image' => $product->image,

                'qty' => $request->qty
            ];
        }

       session()->put('cart', $cart);

          return redirect()->route('cart.index');
    }
    public function index()
    {
        $cart = session()->get('cart', []);

        return view(
            'cart.index',
            compact('cart')
        );
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id]))
        {
            unset($cart[$id]);

            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id]))
        {
            $cart[$id]['qty'] = $request->qty;

            session()->put('cart', $cart);
        }
         return redirect()->back();
    }

     public function checkout()
    {
        $cart = session()->get('cart', []);

        return view(
            'cart.checkout',
            compact('cart')
        );
    }
}
