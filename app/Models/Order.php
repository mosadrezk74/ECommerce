<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'OrderID';
    protected $table = 'Orders';
    public $timestamps = false;

    protected $fillable = [
        'UserID', 'OrderDate', 'TotalAmount', 'Status',
        'ShippingAddressID', 'PaymentMethod'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'OrderID');
    }
}
