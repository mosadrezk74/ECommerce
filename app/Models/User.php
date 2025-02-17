<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'UserID';


    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'PasswordHash',
        'PhoneNumber',
        'IsActive'
    ];

    protected $hidden = [
        'PasswordHash',
        'remember_token'
    ];

    public function getEmailForVerification()
    {
        return $this->Email;
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->EmailVerifiedAt);
    }

    public function markEmailAsVerified()
    {
        $this->EmailVerifiedAt = now();
        $this->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification);
    }
}
?>
