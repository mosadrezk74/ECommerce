<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'PaymentID';
    protected $table = 'Payments';
    public $timestamps = false;

    protected $fillable = [
        'OrderID',
        'Amount',
        'PaymentMethod',
        'TransactionID',
        'Status',
        'PaymentDate'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'OrderID');
    }
}
