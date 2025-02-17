<?php

namespace App\Models;

use App\Models\Tager;
use App\Models\Review;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $primaryKey = 'ProductID';
    protected $table = 'Products';
    public $timestamps = false;

    protected $fillable = [
        'ProductName',
        'Description',
        'Price',
        'StockQuantity',
        'SKU',
        'ImageURL',
        'CategoryID',
        'SupplierID',
        'IsActive'
    ];

    protected $casts = [
        'Price' => 'decimal:2',
        'CreatedAt' => 'datetime',
        'UpdatedAt' => 'datetime'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID');
    }


    use HasFactory;
}
