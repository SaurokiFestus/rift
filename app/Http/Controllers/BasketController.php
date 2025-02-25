<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    //
    public function index(){
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $id){
        $id = (int) $id;
        $product = Product::findorFail($id);

        $cartItems = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItems){
            $cartItems->update(['quantity' => $cartItems->quantity + (int) $request->quantity]);
        } else{
            Cart::create([
                'user_id' => Auth::id(),
                'product_id'=> $id,
                'quantity' => (int)$request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function updateCart(Request $request, $id){
        $id = (int) $id;
        $cartItems = Cart::where('user_id', Auth::id())->where('product_id', $id)->firstorFail();
        $cartItems->update(['quantity' => $request->validate([
            'quantity' => 'required|integer|min:1'
        ])]);

        return redirect()->route('cart.index')->with('success', 'Cart has been Updated');
    }

    public function checkout(){
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()){
            return redirect()->route('cart.index')->with('error', 'Your basket is empty' );

        }

        $totalPrice = $cartItems->sum(function($item){
            return $item->product->price * $item->quantity;
        });

        $order= Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($cartItems as $item){
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price'=>$item->product->price
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('order.index')->with('success', 'Order successfully placed' );
    }
}
