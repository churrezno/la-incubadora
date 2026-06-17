<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendConfirmationMailToUserMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $inscripcion;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $inscripcion)
    {
        $this->user = $user;
        $this->inscripcion = $inscripcion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('ecam@ecam.es', 'La Incubadora | ECAM'),
            subject: 'Confirmación de Inscripción en La Incubadora - DESARROLLO',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-inscripcion',
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
