<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $ack;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($applicant, $ack, $pdfPath)
    {
        $this->applicant = $applicant;
        $this->ack = $ack;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Acknowledgement - ' . $this->ack->ack_no,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.application_acknowledgement',
            with: [
                'applicant' => $this->applicant,
                'ack'       => $this->ack,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->pdfPath)
                ->as("acknowledgement_{$this->ack->ack_no}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}
