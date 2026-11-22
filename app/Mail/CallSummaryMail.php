<?php

namespace App\Mail;

use App\Models\Call;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CallSummaryMail extends Mailable
{
    public function __construct(public Call $call) {}

    public function envelope(): Envelope
    {
        $urgent = collect($this->call->messages ?? [])->contains(fn ($m) => ! empty($m['urgent']));

        return new Envelope(
            subject: ($urgent ? 'URGENT · ' : '').'New call from '.($this->call->caller_number ?: 'unknown number'),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.call-summary');
    }
}
