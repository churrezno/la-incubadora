<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendConfirmationMailToSlateMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $slate;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $slate)
    {
        $this->user = $user;
        $this->slate = $slate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('ecam@ecam.es', 'La Incubadora | ECAM'),
            subject: 'Confirmación de Inscripción en La Incubadora - SLATE',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-slate',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
