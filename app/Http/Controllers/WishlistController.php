<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    //

    function addToWishList(Request $request)
    {
        $user = $request->user();
        $productId = $request->product_id;
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if (!$wishlist) {
            $wishlist = new Wishlist();
            $wishlist->user_id = $user->id;
            $wishlist->product_id = $productId;
            $wishlist->save();
        }
        return response()->json([
            'message' => 'Product added to wishlist'
        ]);
    }

    function removeFromWishList(Request $request, $productId)
    {
        $user = $request->user();
        Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();
        return response()->json([
            'message' => 'Product removed from wishlist'
        ]);
    }

    function getWishList(Request $request)
    {
        $user = $request->user();
        $wishlist = $user->wishlist()->pluck('product_id')->toArray();
        return response()->json([
            'wishlist' => $wishlist
        ]);
    }
}
