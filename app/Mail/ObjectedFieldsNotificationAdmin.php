<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ObjectedFieldsNotificationAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $objectedFields;
    public $objectionMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($application, $objectedFields, $objectionMessage)
    {
        $this->application = $application;
        $this->objectedFields = $objectedFields;
        $this->objectionMessage = $objectionMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Objected Fields Sent - Application ' . $this->application->application_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.objected_fields_admin',
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
