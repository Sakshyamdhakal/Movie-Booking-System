<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userlogin extends Authenticatable
{
    use Notifiable;
    protected $table = 'userlogins';    
    protected $fillable = ['email', 'password'];
}
