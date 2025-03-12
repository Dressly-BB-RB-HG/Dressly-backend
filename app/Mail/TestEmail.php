<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details; // A részletek tárolása, amit a sablonban felhasználunk
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->details['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test', // A blade sablon elérési útja
            with: [
                'body' => $this->details['body'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}