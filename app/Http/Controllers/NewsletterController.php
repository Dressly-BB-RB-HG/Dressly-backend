<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NewsletterSubscriptionConfirmation;
use App\Mail\NewsletterUnsubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    // Hírlevél feliratkozás
    public function sendSubscriptionEmail(Request $request)
    {
        $user = Auth::user();  // A bejelentkezett felhasználó lekérése

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);  // Ha nincs bejelentkezve, hibát jelezünk
        }

        $email = $user->email;  // A bejelentkezett felhasználó email címének lekérése

        try {
            Mail::to($email)->send(new NewsletterSubscriptionConfirmation());  // Feliratkozás email küldése

            return response()->json(['message' => 'Subscription email sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send subscription email.'], 500);
        }
    }

    // Hírlevél leiratkozás
    public function sendUnsubscriptionEmail(Request $request)
    {
        $user = Auth::user();  // A bejelentkezett felhasználó lekérése

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);  // Ha nincs bejelentkezve, hibát jelezünk
        }

        $email = $user->email;  // A bejelentkezett felhasználó email címének lekérése

        try {
            Mail::to($email)->send(new NewsletterUnsubscriptionConfirmation());  // Leiratkozás email küldése

            return response()->json(['message' => 'Unsubscription email sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send unsubscription email.'], 500);
        }
    }
}
