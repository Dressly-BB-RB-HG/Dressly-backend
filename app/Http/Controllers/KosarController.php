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
                  ->with('termek')
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

        // Validálás
        $request->validate([
            'termek_id' => 'required|exists:termeks,termek_id',
            'mennyiseg' => 'required|integer|min:1',
        ]);

        $kosarElem = Kosar::where('felhasznalo', $felhasznaloId)
                        ->where('termek', $request->termek_id)
                        ->first();

        if ($kosarElem) {
            // Ha már létezik, növeljük a mennyiséget
            $kosarElem->increment('mennyiseg', $request->mennyiseg);
            return response()->json($kosarElem, 200);
        }

        // Új kosár elem létrehozása
        $ujKosarElem = Kosar::create([
            'felhasznalo' => $felhasznaloId,
            'termek' => $request->termek_id,
            'mennyiseg' => $request->mennyiseg,
        ]);

        return response()->json($ujKosarElem, 201);
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
    public function destroy($termekId)
{
    $deleted = Kosar::where('felhasznalo', auth()->id()) 
                    ->where('termek', $termekId)
                    ->delete(); 

    if ($deleted > 0) { 
        // Friss kosárlista visszaküldése törlés után
        $kosar = Kosar::where('felhasznalo', auth()->id())->with('termek')->get();
        return response()->json($kosar, 200);
    }

    return response()->json(['error' => 'A termék nem található a kosárban.'], 404);
}

}
