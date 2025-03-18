<?php

namespace App\Http\Controllers;

use App\Models\Rendeles;
use App\Models\Rendeles_tetel;
use App\Models\Termek;
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


    public function legtobbRendeles()
    {

        $legtobbetRendeltTermek = Rendeles_tetel::select('termek', DB::raw('SUM(mennyiseg) as total_quantity'))
            ->groupBy('termek')
            ->orderByDesc('total_quantity')
            ->first();
        if ($legtobbetRendeltTermek) {
            $termek = Termek::find($legtobbetRendeltTermek->termek);
            return response()->json([
                'termek_id' => $termek->termek_id,
                'szin' => $termek->szin,
                'meret' => $termek->meret,
                'ar' => $termek->ar,
                'mennyiseg' => $legtobbetRendeltTermek->total_quantity,
            ]);
        }


        return response()->json([
            'uzenet' => 'Nincs rendelés.',
        ]);
    }

    //Melyik rendelések várnak még szállításra? 
    public function kiszallitasraVarakozoRendelesek()
    {
        $rendezesek = Rendeles::join('szall__csomags', 'rendeles.rendeles_szam', '=', 'szall__csomags.rendeles')
            ->whereIn('szall__csomags.csomag_allapot', ['csomagolas_alatt', 'becsomagolva', 'futarnal'])
            ->get(['rendeles.rendeles_szam', 'rendeles.rendeles_datum', 'szall__csomags.csomag_allapot']);

        return response()->json($rendezesek);
    }

    
    // bazsi - adott felhasználó rendeléshez tartozó termékadatai
    public function rendelesTetel($rendelesSzam)
    {
        // Lekérdezzük a rendelés tételeit és a kapcsolódó termék adatokat
        $rendelesTetel = DB::table('rendeles_tetels as rt')
            ->join('termeks as t', 'rt.termek', '=', 't.termek_id')
            ->where('rt.rendeles', $rendelesSzam)
            ->select(
                'rt.termek',          
                'rt.mennyiseg',       
                't.modell',           
                't.szin',             
                't.meret',            
                't.ar'                
            )
            ->get();

        // Ha vannak tételek a rendelésben, visszaadjuk őket
        if ($rendelesTetel->isNotEmpty()) {
            return response()->json($rendelesTetel);
        } else {
            return response()->json(['message' => 'Nincs tétel a rendelésben.']);
        }
    }
    
    public function rendelesekOsszes()
    {
        // Lekérdezzük az összes rendelést a szükséges adatokkal
        $rendelesek = DB::table('rendeles')
            ->select('rendeles_szam','felhasznalo', 'rendeles_datum', 'fizetve_e')
            ->orderBy('rendeles_datum', 'desc') // Legújabb rendelések előre
            ->get();

        // Ha vannak rendelések, visszaküldjük őket
        if ($rendelesek->isNotEmpty()) {
            return response()->json($rendelesek);
        } else {
            return response()->json(['message' => 'Nincsenek rendelések az adatbázisban.']);
        }
    }

    // adott rendelés törlése

    public function adottRendelesTorlese($rendelesSzam)
    {
        // Ellenőrizzük, hogy létezik-e a rendelés
        $rendeles = DB::table('rendeles')->where('rendeles_szam', $rendelesSzam)->first();
    
        if ($rendeles) {
            // Töröljük a rendeléshez kapcsolódó tételeket a 'rendeles_tetels' táblából
            DB::table('rendeles_tetels')->where('rendeles', $rendelesSzam)->delete();
    
            // Töröljük a rendelést a 'rendeles' táblából
            DB::table('rendeles')->where('rendeles_szam', $rendelesSzam)->delete();
    
            return response()->json(['message' => 'A rendelés és a kapcsolódó tételek sikeresen törölve.']);
        } else {
            return response()->json(['message' => 'A rendelés nem található.'], 404);
        }
    }

    public function legkedveltebbModell()
{
    $legkedveltebbModell = Termek::with(['modell.kategoria', 'arakMegjelenit'])
        ->leftJoin('rendeles_tetels', 'termeks.termek_id', '=', 'rendeles_tetels.termek')
        ->select('termeks.termek_id', 'termeks.modell', 'termeks.szin', 'termeks.meret', 'termeks.keszlet', 'termeks.ar', DB::raw('COALESCE(SUM(rendeles_tetels.mennyiseg), 0) as total_quantity'))
        ->groupBy('termeks.termek_id', 'termeks.modell', 'termeks.szin', 'termeks.meret', 'termeks.keszlet', 'termeks.ar')
        ->orderByDesc('total_quantity')
        ->get();

    return response()->json($legkedveltebbModell);
}
}
