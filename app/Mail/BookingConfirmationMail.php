<?php

namespace App\Mail;

use App\Models\MovieBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(MovieBooking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {

             $qrCode = base64_encode(
                QrCode::format('png')->size(200)
                ->generate("Booking ID: {$this->booking->id}")
    );

        return $this->view('emails.Booking_confirmation')
                    ->with( [
                        'booking' => $this -> booking ,
                        'qrCode' => $qrCode,
                    ]);
    }
}
