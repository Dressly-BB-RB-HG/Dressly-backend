<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function sendRegistrationEmail(Request $request)
    {
        $email = $request->input('email');  // Az email amit a frontend küld

        if (!$email) {
            return response()->json(['error' => 'Email address is required.'], 400);
        }

        // Email küldése
        try {
            Mail::to($email)->send(new RegistrationConfirmation($email));

            return response()->json(['message' => 'Email sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email.'], 500);
        }
    }
}
