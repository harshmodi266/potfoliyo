<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Define email subject
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Message',
        );
    }

    /**
     * Define email content (Blade file)
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
    }

    /**
     * Attachments (if any)
     */
    public function attachments(): array
    {
        return [];
    }
}