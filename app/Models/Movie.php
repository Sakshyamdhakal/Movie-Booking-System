<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // A movie has many bookings
    public function bookings()
    {
        return $this->hasMany(MovieBooking::class);
    }
}

