<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id){
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('orderItems.product')->firstorFail();
        return view('orders.show', compact('order'));
    }
}
