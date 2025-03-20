<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HirlevelController extends Controller
{
    // Feliratkozás a hírlevélre
    public function feliratkozas(Request $request)
    {
        $user = Auth::user(); // Az aktuális bejelentkezett felhasználó lekérése
        
        // Ellenőrizzük, hogy a felhasználó már fel van-e iratkozva
        if ($user->hirlevel == 1) {
            return response()->json(['message' => 'Már fel vagy iratkozva a hírlevélre.']);
        }
        
        // Frissítjük a felhasználó hirlevel státuszát
        $user->hirlevel = 1;
        $user->save();
        
        return response()->json(['message' => 'Feliratkozás sikeres!']);
    }

    // Leiratkozás a hírlevélről
    public function leiratkozas(Request $request)
    {
        $user = Auth::user(); // Az aktuális bejelentkezett felhasználó lekérése
        
        // Ellenőrizzük, hogy a felhasználó már fel van-e iratkozva
        if ($user->hirlevel == 0) {
            return response()->json(['message' => 'Már le vagy iratkozva a hírlevélről.']);
        }
        
        // Frissítjük a felhasználó hirlevel státuszát (leiratkozás)
        $user->hirlevel = 0;
        $user->save();
        
        return response()->json(['message' => 'Leiratkozás sikeres!']);
    }

    // Feliratkozás státuszának lekérdezése
    public function feliratkozasStatus()
    {
        $user = Auth::user(); // Az aktuális bejelentkezett felhasználó lekérése
        
        // Visszaadjuk, hogy a felhasználó fel van-e iratkozva
        return response()->json(['subscribed' => $user->hirlevel == 1]);
    }
}
