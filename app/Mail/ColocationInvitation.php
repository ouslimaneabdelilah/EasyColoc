<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ColocationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $inviterName;
    public $colocationName;
    public $url;


    public function __construct($inviterName, $colocationName, $url)
    {
        $this->inviterName = $inviterName;
        $this->colocationName = $colocationName;
        $this->url = $url;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "You've been invited to join {$this->colocationName}",
        );
    }

    
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.colocations.invitation',
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
