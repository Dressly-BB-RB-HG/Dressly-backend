<?php

namespace App\Http\Controllers;

use App\Models\Rendeles;
use App\Models\Szall_Csomag;
use Illuminate\Http\Request;

class SzallCsomagController extends Controller
{
    /**
     * Az összes csomag lekérése.
     */
    public function index()
    {
        $csomagok = Szall_Csomag::all();  // Az összes csomagot lekérjük az adatbázisból
        return response()->json($csomagok);  // JSON válasz küldése
    }

    /**
     * A csomag állapotának frissítése.
     */
    public function updateAllapot(Request $request, $csomagId)
    {
        // Kérjük a választható állapotokat és validáljuk az adatokat
        $validated = $request->validate([
            'csomag_allapot' => 'required|string|in:Csomagolás,Futárnál,Kézbesítve',  // Csak három lehetséges állapot
        ]);

        // Megkeressük a csomagot az id alapján
        $csomag = Szall_Csomag::find($csomagId);

        if (!$csomag) {
            return response()->json(['message' => 'Csomag nem található.'], 404);
        }

        // Frissítjük a csomag állapotát
        $csomag->csomag_allapot = $validated['csomag_allapot'];
        $csomag->save();  // Elmentjük az adatbázisba

        return response()->json(['message' => 'A csomag állapota sikeresen frissítve lett.']);
    }


    /* public function leadCsomag(Request $request)
    {
        // VALIDÁCIÓ
        $validated = $request->validate([
            'rendeles' => 'required|exists:rendeles,rendeles_szam',
            'szallito' => 'required|string|max:255',  
            'szall_datum' => 'required|date', 
        ]);
    
        // Csomag létrehozása
        $csomag = Szall_Csomag::create([
            'rendeles' => $validated['rendeles'],
            'szallito' => $validated['szallito'],
            'csomag_allapot' => 'Csomagolás alatt', 
            'szall_datum' => $validated['szall_datum'],
        ]);
    
        return response()->json(['message' => 'Csomag sikeresen mentve!', 'csomag' => $csomag], 201);
    } */

}
