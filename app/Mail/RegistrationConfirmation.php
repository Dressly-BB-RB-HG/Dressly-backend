<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;

class RegistrationConfirmation extends Mailable
{
    public $user;  // A bejelentkezett felhasználó

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Az Auth::user() segítségével elérheted a bejelentkezett felhasználót
        $this->user = Auth::user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Az email sablon, amelyet ki kell cserélni a megfelelő email sablonra
        return $this->view('emails.registrationConfirmation')  // A sablon fájl
                    ->with([
                        'name' => $this->user->name,  // A felhasználó neve
                        'email' => $this->user->email,  // A felhasználó email címe
                    ])
                    ->subject('Sikeres Regisztráció');
    }
}
