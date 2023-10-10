<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'title', 'price', 'description', 'category', 'image', 'rating_rate', 'rating_count'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
