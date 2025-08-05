<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieBooking extends Model
{
    protected $fillable = ['movie_id','movie', 'name', 'email', 'seats'];
    protected $table = ['movie_bookings'];
    public function movie()
    {
        return $this->belongsTo(Newmovie::class,'movie_id');
        
    }
}
