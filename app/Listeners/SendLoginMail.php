<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendLoginMail
{
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;

        Mail::raw("You just logged in, {$user->name}!", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject("Login Successful");
        });

        // Log::info("✅ Listener triggered for: " . $user->email);
        dd('Listener triggered');
    }
}
