<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table='taxes';

    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
