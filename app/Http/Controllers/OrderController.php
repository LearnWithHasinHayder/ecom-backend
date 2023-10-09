<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    function addProductsToOrder(Request $request)
    {
        $order = $request->order;
        $products = $request->products;
        $order->products()->attach($products);

        return $order;
    }

    function createOrder(Request $request)
    {
        $user = $request->user();
       //create new Order
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = $request->total_amount;
        $order->save();
        $order->products()->attach($request->products);

        $order->save();
        return $order;
    }

    function createNewOrderWithProducts(Request $request){
        $user = auth()->user();
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_number = '123456789';
        $order->total_amount = 100;
        $order->save();

        //now attach products to this order
        $products = $request->products;
        $order->products()->attach($products);

        return $order;
    }

    function getUserOrders(){
        $user = auth()->user();
        $orders = $user->orders()->with('products')->get();
        return $orders;
    }

    function getOrderDetails($id, Request $request){
        $order = Order::find($id);
        $order->products;
        return $order;
    }

    function allOrders(){
        $orders = Order::with('products')->get();
        return $orders;
    }
}
