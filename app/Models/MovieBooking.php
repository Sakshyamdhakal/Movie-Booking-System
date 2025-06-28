<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieBooking extends Model
{
    protected $fillable = ['movie_id','movie', 'name', 'email', 'seats'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
