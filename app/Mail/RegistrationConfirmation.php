<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RegistrationConfirmation extends Mailable
{
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('emails.registrationConfirmation')
                    ->with(['email' => $this->email])
                    ->subject('Sikeres Regisztráció');
    }
}