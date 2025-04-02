<?php

namespace App\Http\Controllers;

use App\Models\Rendeles;
use App\Models\Rendeles_tetel;
use App\Models\Termek;
use App\Models\Modell;
use App\Models\Szall_Csomag;
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
    $validated = $request->validate([
        'felhasznalo_id' => 'required|exists:users,id',
        'szallitas_mod' => 'required|string',
        'rendeles_tetels' => 'required|array|min:1',
        'rendeles_tetels.*.termek_id' => 'required|exists:termeks,termek_id',
        'rendeles_tetels.*.mennyiseg' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        // 🔹 Rendelés létrehozása
        $rendeles = Rendeles::create([
            'felhasznalo' => $validated['felhasznalo_id'],
            'rendeles_datum' => now(),
            'fizetve_e' => 0,
        ]);

        // 🔹 Rendelés tételeinek mentése
        foreach ($validated['rendeles_tetels'] as $tetel) {
            Rendeles_tetel::create([
                'rendeles' => $rendeles->rendeles_szam,
                'termek' => $tetel['termek_id'],
                'mennyiseg' => $tetel['mennyiseg'],
            ]);
        }

        // 🔹 Csomag mentése a szall_csomags táblába
        Szall_Csomag::create([
            'rendeles' => $rendeles->rendeles_szam, // 🔥 A rendelés ID-ját használjuk
            'szallito' => $validated['szallitas_mod'],
            'csomag_allapot' => 'Csomagolás', // Alapértelmezett állapot
            'szall_datum' => now(), // Aktuális dátum
        ]);

        DB::commit();
        return response()->json([
            'success' => true, 
            'message' => 'Rendelés és csomag sikeresen mentve!',
            'rendeles_szam' => $rendeles->rendeles_szam
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false, 
            'message' => 'Hiba a rendelés mentésekor', 
            'error' => $e->getMessage()
        ], 500);
    }
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
    // A rendeléshez tartozó szall_csomags adatokat is beolvassuk
    $rendelesek = Rendeles::where('felhasznalo', $felhasznaloId)
        ->with(['szallCsomag'])  // Ezt a kapcsolatot feltételezve hozzuk be a szall_csomag adatokat
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

    public function atvettem($rendelesSzam)
    {
        // Keresd meg a rendelést a rendelés szám alapján
        $rendeles = Rendeles::where('rendeles_szam', $rendelesSzam)->first();
    
        if (!$rendeles) {
            return response()->json(['message' => 'Rendelés nem található.'], 404);
        }
    
        // Keresd meg a rendeléshez tartozó csomagot
        $csomag = Szall_Csomag::where('rendeles', $rendeles->rendeles_szam)->first();
    
        if (!$csomag) {
            return response()->json(['message' => 'A rendeléshez nem található csomag.'], 404);
        }
    
        // Ellenőrizzük, hogy a csomag állapota 'Futárnál'-e
        if ($csomag->csomag_allapot !== 'Futárnál') {
            return response()->json(['message' => 'A rendelés még csomagolás alatt van, nem vehető át.'], 400);
        }
    
        // Ha a rendelés már át van véve (fizetve_e = 1), nem lehet újra átvenni
        if ($rendeles->fizetve_e) {
            return response()->json(['message' => 'A rendelés már át lett véve.'], 400);
        }
    
        // Módosítsuk a rendelés státuszát: átvevő státusz
        $rendeles->fizetve_e = 1;
        $rendeles->save();
    
        // A csomag állapotát 'Kézbesítve'-re módosítjuk
        $csomag->csomag_allapot = 'Kézbesítve';
        $csomag->save();
    
        return response()->json(['message' => 'A rendelést sikeresen átvettem, és a csomag állapota Kézbesítve lett.'], 200);
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
    $legkedveltebbModell = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
        ->join('termeks', 'modells.modell_id', '=', 'termeks.modell') // Összekapcsolás a termeks táblával
        ->leftJoin('rendeles_tetels', 'termeks.termek_id', '=', 'rendeles_tetels.termek') // Összekapcsolás a rendelések tételeivel
        ->select('modells.modell_id','modells.kategoria','modells.tipus','modells.gyarto','modells.kep', DB::raw('COALESCE(SUM(rendeles_tetels.mennyiseg), 0) as total_quantity'))
        ->groupBy('modells.modell_id', 'modells.kategoria','modells.tipus','modells.gyarto','modells.kep') // Csak a modelleket csoportosítjuk
        ->orderByDesc('total_quantity') // A legnépszerűbb modell előre kerüljön
        ->get();

    return response()->json($legkedveltebbModell);
}

}
 