<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='addresses';
    protected $fillable=[
        'City',
        'Address',
        'UserID'
    ];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class, 'UserID');
    }
    use HasFactory;
}
