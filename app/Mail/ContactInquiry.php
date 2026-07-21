<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
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

        $replyTo = [];
        $visitorEmail = $this->data['email'] ?? null;

        if (!empty($visitorEmail)) {
            $replyTo[] = new Address(
                $this->stripHeaderControlChars((string) $visitorEmail),
                $this->stripHeaderControlChars((string) ($this->data['name'] ?? '')),
            );
        }

        return new Envelope(
            // Always the configured mailer "from" address — never visitor input.
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: $replyTo,
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.contact-inquiry');
    }

    /**
     * Defensive belt-and-suspenders against mail-header injection: strip any
     * CR/LF a visitor-supplied value could contain before it reaches a header.
     */
    private function stripHeaderControlChars(string $value): string
    {
        return trim(str_replace(["\r", "\n"], '', $value));
    }
}
