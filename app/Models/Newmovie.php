<?php

namespace App\Models;

use App\Observers\MovieObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([MovieObserver::class])]
class Newmovie extends Model
{
    protected $fillable=['name','description','image'];
    public function bookings()
{
    return $this->hasMany(MovieBooking::class, 'movie_id');
}
}


