<?php

namespace App\Listeners;

use App\Events\EventsManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class SendMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsManager $event): void
    {
            $user=$event->user;
            Mail::raw("heyyy message for you '{$event->user}' ",function($message) use ($event){
            $message->to($event->user->email)
                    ->subject('test mail');
            });

                dd('Listener triggered');
    }
}
