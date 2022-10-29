<?php

namespace Modules\Auth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function build(): ForgotEmail
    {
        return $this->view('mail')
            ->with([
                'url' => route('auth.password.reset') . '?token=' . $this->token,
            ]);
    }
}
