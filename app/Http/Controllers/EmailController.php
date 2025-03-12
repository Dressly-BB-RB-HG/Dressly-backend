<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Importáld a User modellt

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Ellenőrizzük, hogy az email paramétert átadták-e
        $request->validate([
            'email' => 'required|email', // Ellenőrizzük, hogy érvényes emailt kaptunk
        ]);

        $email = $request->input('email'); // A frontendről érkező email cím

        // Lekérjük az adott felhasználót az email cím alapján
        $user = User::where('email', $email)->first();

        // Ha nem találjuk a felhasználót
        if (!$user) {
            return response()->json(['error' => 'Felhasználó nem található'], 404);
        }

        // E-mail küldés
        try {
            $details = [
                'subject' => 'Test Email from Laravel',
                'body' => 'This is a test email sent from Laravel to user: ' . $user->email,
                'recipient' => $user->email, // A felhasználó email cím
            ];

            // E-mail küldése a felhasználónak
            Mail::to($details['recipient'])->send(new TestEmail($details));

            return response()->json(['message' => 'Email sikeresen elküldve']);
        } catch (\Exception $e) {
            // Ha hiba történik, akkor visszaküldjük a hibát
            return response()->json(['error' => 'Hiba történt az email küldésekor: ' . $e->getMessage()], 500);
        }
    }
}