<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table='order_items';
    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'total_price',

    ];

    use HasFactory;
}
