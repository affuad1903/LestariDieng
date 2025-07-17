<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('🔥 URGENT: Pesan Baru dari Website - ' . $this->data['contactus_subject'])
                    ->view('emails.contactus')
                    ->with('data', $this->data)
                    ->replyTo($this->data['contactus_email'], $this->data['contactus_name'])
                    ->priority(1); // High priority
    }
}
