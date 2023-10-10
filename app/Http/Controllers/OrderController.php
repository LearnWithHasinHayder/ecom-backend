<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{


    function createOrder(Request $request)
    {
        $user = $request->user();
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = $request->total_amount;
        $order->save();
        $order->products()->attach($request->products);

        $order->save();
        return $order;
    }

    function getUserOrders(){
        $user = auth()->user();
        $orders = $user->orders()->with('products')->get();
        return $orders;
    }

    function getOrderDetails($id, Request $request){
        $order = Order::findOrFail($id);
        $order->products;
        return $order;
    }

    function allOrders(){
        $orders = Order::with('products')->get();
        return $orders;
    }
}
