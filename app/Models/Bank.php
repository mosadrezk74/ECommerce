<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table='bankings';
    protected $fillable=[
        'name',
        'alias'
    ];
    use HasFactory;
}
