<?php

namespace App\Http\Controllers;

use App\Models\Kosar;
use Illuminate\Http\Request;

class KosarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $felhasznaloId = auth()->id();

        $kosar = Kosar::where('felhasznalo', $felhasznaloId)
            ->with('termek', 'termek.modell') // Betöltjük a modell adatokat is
            ->get();

        return response()->json($kosar, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bejelentkezés szükséges!'], 401);
        }

        $felhasznaloId = auth()->id();
        $termekId = $request->termek_id;

        $kosarElem = Kosar::where('felhasznalo', $felhasznaloId)
            ->where('termek', $termekId)
            ->first();

        // Ha már létezik az elem, mennyiség növelés
        if ($kosarElem) {
            Kosar::where('felhasznalo', $felhasznaloId)
            ->where('termek', $termekId)
            ->update(['mennyiseg' => $kosarElem->mennyiseg + 1]);
        } else {
            // Ha még nem létezik az elem
            $ujKosarElem = Kosar::create([
                'felhasznalo' => $felhasznaloId,
                'termek' => $termekId,
                'mennyiseg' => 1,
            ]);
            return response()->json($ujKosarElem, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($termekId)
{
    $felhasznaloId = auth()->id();

    $kosarElem = Kosar::where('felhasznalo', $felhasznaloId)
        ->where('termek', $termekId)
        ->first();

    if (!$kosarElem) {
        return response()->json(['error' => 'A termék nem található a kosárban.'], 404);
    }

    if ($kosarElem->mennyiseg > 1) {
        // Ha mennyiseg tobb mint 1
        Kosar::where('felhasznalo', $felhasznaloId)
            ->where('termek', $termekId)
            ->update(['mennyiseg' => $kosarElem->mennyiseg - 1]);
    } else {
        // Ha már csak 1 volt a mennyiseg, akkor töröljük az elemet
        Kosar::where('felhasznalo', $felhasznaloId)
            ->where('termek', $termekId)
            ->delete();
    }
}
}
