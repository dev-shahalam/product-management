<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public $fillable = [
        'product_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

}
