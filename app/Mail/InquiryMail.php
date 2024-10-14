<?php

namespace App\Mail;

use App\Models\InquiryRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    private InquiryRecord $record;

    /**
     * Create a new message instance.
     */
    public function __construct(InquiryRecord $record)
    {
        $this->record = $record;
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
        $record = $this->record;
        return (new Content(
            view: 'mail.inquiry',
        ))->with(compact('record'));
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
