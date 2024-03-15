<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasFactory , Notifiable ,HasApiTokens ;

    protected $fillable =[
        'first_name','last_name' , 'email' , 'password' ,'phone_number' ,'super_admin' ,'status','username','birthday',
        'gender',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'local',
        'status'
    ];
}
