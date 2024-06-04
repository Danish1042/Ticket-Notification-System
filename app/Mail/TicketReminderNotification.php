<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReminderNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $ticket;
    public $messageContent;

    public function __construct($user, $ticket, $messageContent)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Mail from Admin')->view('website.emails.TicketReminder');
    }
}
