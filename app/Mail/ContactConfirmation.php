<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

/**
 * Automatic confirmation sent to the visitor after their contact request was
 * successfully delivered to the business address. Always sent from the
 * configured noreply address, translated in the language the form was
 * submitted in, and containing only the visitor's own submitted data.
 */
class ContactConfirmation extends Mailable
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
        $subject = trans('contact.confirm_subject');
        App::setLocale($prevLocale);

        return new Envelope(
            // Noreply sender — never the visitor's own address, no reply-to.
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.contact-confirmation');
    }
}
