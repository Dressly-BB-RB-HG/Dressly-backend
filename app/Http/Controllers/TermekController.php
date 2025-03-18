<?php

namespace App\Http\Controllers;

use App\Models\Termek;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
    $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->whereHas('modell', function ($query) use ($szin) {
            $query->where('szin', $szin);
        })
        ->get();

    return response()->json($termekek);
}

    // Adott nemű ruhák
    public function adottNemu(string $nem)
{
    $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->whereHas('modell', function ($query) use ($nem) {
            $query->where('tipus', $nem);
        })
        ->get();

    return response()->json($termekek);
}


public function rendezTermekekArSzerint(Request $request)
{
    // Az irány (növekvő vagy csökkenő) lekérése
    $irany = $request->query('irany');  // alapértelmezés szerint növekvő

    // Az ár szerint rendezés, és a kapcsolódó modellek betöltése
    if ($irany == 'csokkeno') {
        $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
            ->orderBy('ar', 'desc')
            ->get();
    } else {
        $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
            ->orderBy('ar', 'asc')
            ->get();
    }

    // A termékek visszaadása JSON formátumban
    return response()->json($termekek);
}

    //Adott márkájú ruha
    public function markaRuhak(string $marka)
{
    $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->whereHas('modell', function ($query) use ($marka) {
            $query->where('gyarto', $marka);
        })
        ->get();

    return response()->json($termekek);
}

    

    //Adott márkájú, adott kategóriájú ruha
    public function markaKategoria(string $marka, string $kategoria)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
            ->where('kategorias.ruhazat_kat', $kategoria)
            ->where('modells.gyarto', $marka)
            ->get(['termeks.*']);

        return response()->json($termekek);
    }

    //Adott kategóriájú ruhák
    public function kategoriaRuhak(string $kategoria)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
            ->where('kategorias.ruhazat_kat', $kategoria)
            ->get(['termeks.*']);

        return response()->json($termekek);
    }

    //Adott méretű, adott márkájú, adott típusu ruhák
    public function meretMarkaTipus(string $meret, string $marka, string $tipus)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
            ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
            ->where('termeks.meret', $meret)
            ->where('modells.gyarto', $marka)
            ->where('modells.tipus', $tipus)
            ->get(['termeks.*']);

        return response()->json($termekek);
    }

    //Adott méretű, adott márkájú, adott típusú, adott kategoriájú ruhák
    public function meretMarkaTipusKategoria(string $meret, string $marka, string $tipus, string $kategoria)
    {
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
    public function meretRuhak(string $meret)
{
    $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->whereHas('modell', function ($query) use ($meret) {
            $query->where('meret', $meret);
        })
        ->get();

    return response()->json($termekek);
}


    public function termekAra($ekkor, $termekId)
    {
        $ekkor = Carbon::parse($ekkor);

        $ar = DB::table('termek_ars')
            ->where('termek', $termekId)
            ->where('dtol', '<=', $ekkor)
            ->orderBy('dtol', 'desc')
            ->value('uj_ar');

        if ($ar === null) {
            $ar = DB::table('termeks')->where('termek_id', $termekId)->value('ar');
        }

        return response()->json(['ar' => $ar]);
    }


    public function mikorValtozottAr($termekID)
    {

        $legutolsoAr = DB::table('termek_ars')
            ->where('termek', $termekID)
            ->orderBy('dtol', 'desc')
            ->first();

        if ($legutolsoAr) {
            return response()->json([
                'Utolso valtozas' => $legutolsoAr->dtol,
                'Uj ar' => $legutolsoAr->uj_ar,
                'TermekID' => $termekID
            ]);
        } else {
            return response()->json([
                'message' => 'Nincs árváltozás a termékhez.'
            ]);
        }
    }

    public function nincsKeszleten(){
        $nincsKeszleten = DB::table('termeks')
            ->where('keszlet', '<', 1)
            ->get();
            return response()->json(['Ezekből a termékekből nincs készlet' => $nincsKeszleten]);
    }


    //Mely kategóriában melyik termék a legsikeresebb? 
    public function legsikeresebbTermekKategoria($kategoriaID)
    {
        $result = DB::table('rendeles_tetels as rt')
            ->join('termeks as t', 'rt.termek', '=', 't.termek_id')
            ->join('modells as m', 't.modell', '=', 'm.modell_id')
            ->join('kategorias as k', 'm.kategoria', '=', 'k.kategoria_id') 
            ->select(
                't.termek_id',
                't.szin',
                't.meret',
                't.ar',
                'k.kategoria_id',
                'k.ruhazat_kat',
                DB::raw('SUM(rt.mennyiseg) as ossz_rendeles_mennyiseg')
            )
            ->where('k.kategoria_id', '=', $kategoriaID)
            ->groupBy('t.termek_id', 't.szin', 't.meret', 't.ar', 'k.kategoria_id', 'k.ruhazat_kat')
            ->orderByDesc('ossz_rendeles_mennyiseg')
            ->limit(1) 
            ->first();

        if ($result) {
            return response()->json($result);
        } else {
            return response()->json(['message' => 'Nincs rendelés ebben a kategóriában.'], 404);
        }
    }


    public function termekMindenAdattal()
    {
        $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])->get();
        return response()->json($termekek);
    }

    public function legujabbTermek()
{
    $termekek = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->orderBy('created_at', 'desc') 
        ->get();

    return response()->json($termekek);
}
}
