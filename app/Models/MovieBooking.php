<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieBooking extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id','movie', 'name', 'email', 'seats', 'user_id'];
    protected $table = 'movie_bookings';

    public function movie()
    {
        return $this->belongsTo(Newmovie::class,'movie_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
