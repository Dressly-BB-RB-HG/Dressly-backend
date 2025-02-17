<?php

namespace App\Http\Controllers;

use App\Models\Termek;
use Illuminate\Http\Request;

class TermekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($modell_id)
{
    // A termék keresése a `modell` mező alapján, amely a `modellek` táblában lévő `modell_id`-ra hivatkozik
    $termek = Termek::where('modell', $modell_id)->first(); // FONTOS: 'modell' mezőt használunk
    
    if ($termek) {
        return response()->json(['termek' => $termek]);
    } else {
        return response()->json(['message' => 'Nem található termék az adott modellhez'], 404);
    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = new Termek();
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($termek_id)
    {
        $termek = Termek::where('termek_id', $termek_id)
            ->get();
        return $termek[0];
    }

    /**
     * Update the specified resource in storage.
     */
    
     public function update(Request $request, $modell_id)
{
    // Megpróbáljuk megkeresni a terméket a modell alapján
    $termek = Termek::where('modell', $modell_id)->first();

    // Ha nincs még ilyen termék, akkor létrehozzuk
    if (!$termek) {
        $termek = new Termek();
        $termek->modell = $modell_id; // Új termék esetén hozzárendeljük a modellt
    }

    // Frissítjük a termék adatait
    $termek->szin = $request->szin;
    $termek->meret = $request->meret;
    $termek->keszlet = $request->keszlet;
    $termek->ar = $request->ar;

    // Elmentjük az új vagy frissített terméket
    $termek->save();

    return response()->json(['message' => 'Termék sikeresen mentve!', 'termek' => $termek]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Termek::find($id)->delete();
        return "Termék törölve!";
    }


    //Adott nemű, adott kategóriájú ruha
    public function nemuKategoria(string $nem, string $kategoria)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
            ->where('modells.tipus', $nem)
            ->where('kategorias.ruhazat_kat', $kategoria)
            ->get(['termeks.*']);
        return response()->json($termekek);
    }

    //Adott színű, adott kategóriájú ruha
    public function szinuRuha(string $szin, string $kategoria)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
            ->where('termeks.szin', $szin)
            ->where('kategorias.ruhazat_kat', $kategoria)
            ->get(['termeks.*']);
        return response()->json($termekek);
    }

    //Adott színű ruha
    public function szinuMinden(string $szin)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->where('termeks.szin', $szin)
            ->get(['termeks.*']);
        return response()->json($termekek);
    }

    //Adott márkájú ruha
    public function markaRuhak(string $marka)
    {
    $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('modells.gyarto', $marka)
        ->get(['termeks.*']);
    
    return response()->json($termekek);
    }   

    //Adott márkájú, adott kategóriájú ruha
    public function markaKategoria(string $marka, string $kategoria){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('kategorias.ruhazat_kat', $kategoria)
        ->where('modells.gyarto', $marka) 
        ->get(['termeks.*']);

        return response()->json($termekek);
    }
    
    //Adott kategóriájú ruhák
    public function kategoriaRuhak(string $kategoria){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('kategorias.ruhazat_kat', $kategoria) 
        ->get(['termeks.*']);

        return response()->json($termekek);
    }

    //Adott méretű, adott márkájú, adott típusu ruhák
    public function meretMarkaTipus(string $meret, string $marka, string $tipus){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('termeks.meret', $meret)
        ->where('modells.gyarto', $marka)
        ->where('modells.tipus', $tipus)
        ->get(['termeks.*']);

        return response()->json($termekek);
    }

    //Adott méretű, adott márkájú, adott típusú, adott kategoriájú ruhák
    public function meretMarkaTipusKategoria(string $meret, string $marka, string $tipus, string $kategoria){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('termeks.meret', $meret)
        ->where('modells.gyarto', $marka)
        ->where('modells.tipus', $tipus)
        ->where('kategorias.ruhazat_kat', $kategoria)
        ->get(['termeks.*']);
        return response()->json($termekek);
    }

    //Adott méretű ruhák
    public function meretRuhak(string $meret){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('termeks.meret', $meret)
        ->get(['termeks.*']);
        return response()->json($termekek);
    }
}
