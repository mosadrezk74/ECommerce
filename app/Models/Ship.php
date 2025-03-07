<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $table = 'shipping';

    protected $fillable = [
        'ShippingMethod',
        'OrderID',
        'UserID',
        'TrackingNumber',
        'ShippingCost',
        'ShippedAt',
        'DeliveredAt',
        'Status',
        'City'

    ];

    protected $primaryKey = 'ShippingID';
    public function city(){
        return $this->belongsTo(Provinve::class);
    }

    public $timestamps = false;

    use HasFactory;
}
