<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table='coupons';
    protected $fillable=[
        'merchant_account_id',
        'name',
        'slug',
        'discount_amount',
        'expired',
    ];
    use HasFactory;
}
