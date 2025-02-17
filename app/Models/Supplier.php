<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'SupplierID';
    protected $table = 'Suppliers';
    public $timestamps = false;

    protected $fillable = [
        'SupplierName',
        'ContactName',
        'PhoneNumber',
        'Email',
        'Address'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'SupplierID');
    }
}
