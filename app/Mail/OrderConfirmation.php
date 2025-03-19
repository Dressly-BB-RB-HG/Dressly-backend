<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderConfirmation extends Mailable
{
    public $user;   // A bejelentkezett felhasználó adatai
    public $kosar;  // A kosár tartalma

    public function __construct()
    {
        // A bejelentkezett felhasználó adatai
        $this->user = Auth::user();
        
        // A kosár tartalma
        $this->kosar = DB::table('kosars')
                ->join('termeks', 'kosars.termek', '=', 'termeks.termek_id')
                ->join('modells', 'termeks.modell', '=', 'modells.modell_id')
                ->where('kosars.felhasznalo', $this->user->id) // A bejelentkezett felhasználó kosara
                ->select('kosars.mennyiseg', 'termeks.szin', 'termeks.meret', 'termeks.ar', 'modells.gyarto', 'modells.kep', 'termeks.termek_id')
                ->get();
    }

    public function build()
    {
        return $this->view('emails.orderConfirmation') // A Blade sablon
                    ->with([
                        'user' => $this->user,   // Felhasználó adatai
                        'kosar' => $this->kosar, // Kosár tartalma,
                    ])
                    ->to($this->user->email) // A bejelentkezett felhasználó email címére küldjük
                    ->subject('Rendelés visszaigazolás');
    }
}
