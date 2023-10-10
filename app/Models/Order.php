<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //create relationship with Order Product with a pivot table Order_Products

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
        // return $this->belongsToMany(Product::class)->withPivot('quantity', 'price')->as('order_products');
    }
}
