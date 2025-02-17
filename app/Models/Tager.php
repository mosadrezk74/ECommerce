<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tager extends Model
{
    protected $table='merchant_accounts';
    protected $fillable=[
        'banking_id',
        'user_id',
        'name',
        'slug',
        'address',
        'bank_account_name',
        'bank_account_number',
        'bank_branch_name',
        'image',
        'balance',
    ];
    use HasFactory;
}
