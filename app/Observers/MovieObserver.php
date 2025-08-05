<?php

namespace App\Observers;

use App\Models\Newmovie;
use Illuminate\Support\Facades\Request;

class MovieObserver
{
    /**
     * Handle the Newmovie "created" event.
     */

     public function creating(Newmovie $newmovie){

        if(Request::hasFile('image'))  {
         $newmovie->image =Request::file('image')->store('posters','public');
        }

     }
    public function created(Newmovie $newmovie): void
    {
        //
    }

    /**
     * Handle the Newmovie "updated" event.
     */
    public function updated(Newmovie $newmovie): void
    {
        //
    }

    /**
     * Handle the Newmovie "deleted" event.
     */
    public function deleted(Newmovie $newmovie): void
    {
        //
    }

    /**
     * Handle the Newmovie "restored" event.
     */
    public function restored(Newmovie $newmovie): void
    {
        //
    }

    /**
     * Handle the Newmovie "force deleted" event.
     */
    public function forceDeleted(Newmovie $newmovie): void
    {
        //
    }
}
