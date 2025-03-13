<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;

class OrderConfirmation extends Mailable
{
    public $request; // Request paraméter átadása az emailnek

    public function __construct(Request $request)
    {
        $this->request = $request; // Az emailben szereplő rendelési adatokat itt adhatod át
    }

    public function build()
    {
        return $this->view('emails.orderConfirmation') // Válassz egy nézetet, amit megjelenítesz az emailben
                    ->with([
                        'orderDetails' => $this->request->all(), // Átadhatod a rendelési adatokat is az emailnek
                    ])
                    ->subject('Rendelés visszaigazolás');
    }

}