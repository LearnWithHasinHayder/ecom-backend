<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class ProductController extends Controller
{
    function index()
    {
        // $products = [];
        // $productCache = Cache::get('products');
        // if ($productCache) {
        //     $products = $productCache;
        // } else {
        //     $products = Http::get('https://fakestoreapi.com/products')->json();
        //     Cache::put('products', $products, 3600);
        //     //return $products;
        // }


        // foreach($products as $product){
        //     $product = [
        //         'title' => $product['title'],
        //         'price' => $product['price'],
        //         'description' => $product['description'],
        //         'category' => $product['category'],
        //         'image' => $product['image'],
        //         'rating' => $product['rating']['rate'],
        //         'rating_count' => $product['rating']['count'],
        //     ];
        //     Product::create($product);
        // }

        $products = Product::all();

        return $products;
    }

    function product($id)
    {
        $product = Product::find($id);
        return $product;
    }
}
