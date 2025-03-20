<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;

class NewsletterUnsubscriptionConfirmation extends Mailable
{
    public $user;  // A bejelentkezett felhasználó

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user(); // A bejelentkezett felhasználó elérése
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.newsletterUnsubscriptionConfirmation')  // A sablon fájl
                    ->with([
                        'name' => $this->user->name,  // A felhasználó neve
                        'email' => $this->user->email,  // A felhasználó email címe
                    ])
                    ->subject('Sikeres Leiratkozás');
    }
}
