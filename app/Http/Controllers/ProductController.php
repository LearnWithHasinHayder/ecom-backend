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
        //now enter the products into the database from the following json
        // {
        //     "id": 2,
        //     "title": "Mens Casual Premium Slim Fit T-Shirts ",
        //     "price": 22.3,
        //     "description": "Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket.",
        //     "category": "men's clothing",
        //     "image": "https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg",
        //     "rating": {
        //     "rate": 4.1,
        //     "count": 259
        //     }
        //     }

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
        // $productCache = Cache::get('product' . $id);
        // if ($productCache) {
        //     return $productCache;
        // } else {
        //     $product = Http::get('https://fakestoreapi.com/products/' . $id)->json();
        //     Cache::put('product' . $id, $product, 3600);
        //     return $product;
        // }
    }
}
