<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;

class OrderConfirmation extends Mailable
{
    public $user;   // A bejelentkezett felhasználó adatai
    public $kosar;  // A kosár tartalma

    public function __construct()
    {
        // A bejelentkezett felhasználó adatai
        $this->user = Auth::user();
        
        // A kosár tartalma
        $this->kosar = \DB::table('kosars')
                          ->where('felhasznalo', $this->user->id) // A bejelentkezett felhasználó kosara
                          ->get();
    }

    public function build()
    {
        return $this->view('emails.orderConfirmation') // A Blade sablon
                    ->with([
                        'user' => $this->user,   // Felhasználó adatai
                        'kosar' => $this->kosar, // Kosár tartalma
                    ])
                    ->to($this->user->email) // A bejelentkezett felhasználó email címére küldjük
                    ->subject('Rendelés visszaigazolás');
    }
}
