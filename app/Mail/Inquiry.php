<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    public string $name, $email, $type, $message;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $email, string $type, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $appName = config('app.name');
        return new Envelope(
            to: [config('const.mail_send_to')],
            subject: "[{$appName}] 問い合わせフォームの入力内容",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content(
            view: 'mail.inquiry',
        ))->with([
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'messageText' => $this->message,
        ]);
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
