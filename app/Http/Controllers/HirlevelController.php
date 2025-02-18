<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HirlevelController extends Controller
{
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
}
