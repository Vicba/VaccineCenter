<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use App\Models\Vaccine;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;
    private $booking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this -> booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vaccine = Vaccine::find($this -> booking -> vaccine_id);
        return $this->view('confirmation', ["booking" => $this -> booking, "vaccine" => $vaccine]);
    }
}
