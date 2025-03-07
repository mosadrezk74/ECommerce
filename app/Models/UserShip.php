<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShip extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'AddressID';
    public $timestamps = false;
    protected $fillable = [
        'UserID',
        'CityID',
    ];

    public function user(){
        return $this->belongsTo(User::class , 'UserID');
    }

    public function city(){
        return $this->belongsTo(Provinve::class, 'CityID');
    }


    use HasFactory;
}
