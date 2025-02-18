<?php

namespace App\Http\Controllers;

use App\Models\Rendeles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RendelesController extends Controller
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
    public function destroy(string $id)
    {
        //
    }

    //Mikor rendeltek utoljára? 
    public function utolsoRendeles()
    {
        $utolsoRendeles = Rendeles::orderBy('rendeles_datum', 'desc')->first();

        if ($utolsoRendeles) {
            return response()->json([
                'utolso_rendeles' => $utolsoRendeles->rendeles_datum
            ]);
        } else {
            return response()->json([
                'uzenet' => 'Még nem történt rendelés.'
            ]);
        }
    }


    //Adott Felhasználó összes rendelése. 
    public function osszesRendeles($felhasznaloId)
    {
        $rendelesek = Rendeles::where('felhasznalo', $felhasznaloId)
            ->with('rendelesTetel.termek.modell')
            ->get();

        return response()->json($rendelesek);
    }



    public function utolsoTermekRendeles($termekID)
    {
        $utolsoRendeles = DB::table('rendeles_tetels')
            ->join('rendeles', 'rendeles_tetels.rendeles', '=', 'rendeles.rendeles_szam')
            ->where('rendeles_tetels.termek', $termekID)
            ->orderBy('rendeles.rendeles_datum', 'desc')
            ->select('rendeles.rendeles_datum')
            ->first();

        if ($utolsoRendeles) {
            return response()->json(['Termék utolsó rendelése: ' => $utolsoRendeles->rendeles_datum]);
        } else {
            return response()->json(['message' => 'Nincs rendelés ehhez a termékhez.']);
        }
    }

    public function leggyakoribbSzin()
    {
        $result = DB::table('rendeles_tetels as rt')
            ->join('termeks as t', 'rt.termek', '=', 't.termek_id')
            ->select('t.szin', DB::raw('COUNT(*) as rendelesek_szama'))
            ->groupBy('t.szin')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->get();

        return response()->json($result);
    }


    public function leggyakoribbMeret()
    {
        $result = DB::table('rendeles_tetels as rt')
            ->join('termeks as t', 'rt.termek', '=', 't.termek_id')
            ->select('t.meret', DB::raw('COUNT(*) as rendelesek_szama'))
            ->groupBy('t.meret')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->limit(1)
            ->get();

        return response()->json($result);
    }


    public function legsikeresebbHonap()
{
    $result = DB::table('rendeles')
        ->join('rendeles_tetels', 'rendeles.rendeles_szam', '=', 'rendeles_tetels.rendeles')
        ->select(
            DB::raw('MONTH(rendeles.rendeles_datum) as honap'),
            DB::raw('SUM(rendeles_tetels.mennyiseg) as eladott_mennyiseg'),
            DB::raw('COUNT(DISTINCT rendeles.rendeles_szam) as rendeles_szam')
        )
        ->groupBy(DB::raw('MONTH(rendeles.rendeles_datum)'))
        ->orderByDesc(DB::raw('SUM(rendeles_tetels.mennyiseg)'))
        ->limit(1)
        ->get();

    return response()->json($result);
}


}
