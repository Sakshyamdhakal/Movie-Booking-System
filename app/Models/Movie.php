<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title'];

    // A movie has many bookings
    public function bookings()
    {
        return $this->hasMany(MovieBooking::class);
    }
}

