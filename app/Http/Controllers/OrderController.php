<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation; // Az Mailable osztály, amely az email tartalmát tartalmazza

class OrderController extends Controller
{
    // Rendelés visszaigazolása (email küldés)
    public function sendOrderConfirmation(Request $request)
    {
        // Ellenőrizzük, hogy a felhasználó be van jelentkezve
        if(auth()->check()) {
            $user = auth()->user(); // Az autentikált felhasználó
            $userEmail = $user->email; // A felhasználó email címének lekérése

            // Az email elküldése
            try {
                Mail::to($userEmail)->send(new OrderConfirmation($request)); // Az OrderConfirmation osztályt fogjuk használni
                return response()->json(['message' => 'Email sikeresen elküldve']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Hiba történt az email küldésekor: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'A felhasználó nincs bejelentkezve'], 401);
        }
    }
}