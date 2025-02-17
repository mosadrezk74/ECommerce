<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'CartID';
    protected $table = 'Cart';

    protected $fillable = [
        'UserID',
        'ProductID',
        'Quantity',
        'Price'

    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
