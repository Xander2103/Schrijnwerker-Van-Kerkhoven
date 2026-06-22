<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly array  $data,
        public readonly string $submissionLocale = 'nl',
    ) {}

    public function envelope(): Envelope
    {
        $prevLocale = App::getLocale();
        App::setLocale($this->submissionLocale);
        $subject = trans('contact.email_subject');
        App::setLocale($prevLocale);

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.contact-inquiry');
    }
}
