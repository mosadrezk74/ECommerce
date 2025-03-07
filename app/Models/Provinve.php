<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinve extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'ProvinceID';
    public $timestamps = false;
    use HasFactory;
}
