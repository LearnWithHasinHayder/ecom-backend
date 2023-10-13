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
        $orders->map(function($order){
            $order->products->map(function($product){
                unset($product->description);
                unset($product->category);
                unset($product->image);
                unset($product->rating);
                unset($product->rating_count);
                // unset($product->created_at);
                // unset($product->updated_at);
                unset($product->pivot->order_id);
                unset($product->pivot->product_id);
                return $product;
            });
        });
        return $orders;
    }

    function getOrderDetails($id, Request $request){
        $order = Order::findOrFail($id);
        $order->products->map(function($product){
            unset($product->description);
            unset($product->category);
            unset($product->image);
            unset($product->rating);
            unset($product->rating_count);
            // unset($product->created_at);
            // unset($product->updated_at);
            unset($product->pivot->order_id);
            unset($product->pivot->product_id);
            return $product;
        });
        return $order;
    }

    // function deleteOrder(Request $request, $id){
    //     $user = auth()->user();
    //     $order = Order::findOrFail($id);
    //     $order->delete();
    //     return response()->json([
    //         'message' => 'Order deleted successfully'
    //     ]);
    // }

    function allOrders(){
        $orders = Order::with('products')->get();
        return $orders;
    }
}
