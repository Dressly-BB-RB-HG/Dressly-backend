<?php

namespace App\Http\Controllers;

use App\Models\Rendeles_tetel;
use App\Models\Termek;
use App\Models\Modell;
use App\Models\Kedvencek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KedvencekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($modellId)
    {
        $felhasznaloId = auth()->id();

    $kedvencElem = Kedvencek::where('felhasznalo', $felhasznaloId)
    ->where('modell', $modellId)
    ->first();
    if (!$kedvencElem) {
        return response()->json(['error' => 'A termék nem található a kedvencek között.'], 404);
    }else{
    Kedvencek::where('felhasznalo', $felhasznaloId)
    ->where('modell', $modellId)
    ->delete();
}
 }
    

    public function kedvencTermekek()
{
    $termekek = Termek::whereHas('modell', function ($query) {
            $query->whereHas('kedvencek', function ($subQuery) {
                $subQuery->where('felhasznalo', auth()->id());
            });
        })
        ->with(['modell.kategoria', 'arakMegjelenit'])
        ->get();

    return response()->json($termekek);
}

public function kedvencHozzaad(Request $request)
{
    $validated = $request->validate([
        'felhasznalo' => 'required|integer',
        'modell' => 'required|integer',
    ]);

    // Ha a termék még nincs a kedvencek között, hozzáadjuk
    $existing = Kedvencek::where('felhasznalo', $validated['felhasznalo'])
                         ->where('modell', $validated['modell'])
                         ->first();

    if ($existing) {
        return response()->json(['message' => 'A termék már a kedvencek között van.'], 200);
    } else {
        // Hozzáadjuk a kedvencekhez
        Kedvencek::create([
            'felhasznalo' => $validated['felhasznalo'],
            'modell' => $validated['modell'],
        ]);
        return response()->json(['message' => 'Termék hozzáadva a kedvencekhez.'], 200);
    }
}

// Termék eltávolítása a kedvencek közül
public function kedvencTorol(Request $request)
{
    
}
}