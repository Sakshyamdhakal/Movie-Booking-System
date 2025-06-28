<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Model
{
    protected $fillable=['name','email','password'];
    protected $hidden=['password','remember_token'];
    protected $casts =['email_verified_at'=>'datetime','password'=>'hashed'];
    protected $guard='admin';
}
