<?php

namespace App\Http\Controllers;

use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ModellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Modell::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validáljuk a bemeneti adatokat
        $request->validate([
            'kategoria' => 'required|string',
            'tipus' => 'required|string|max:1', // Típus 1 karakter
            'gyarto' => 'required|string',
            'kep' => 'required|string', // A kép URL
        ]);

        // Új modell létrehozása és mentése
        $modell = new Modell();
        $modell->kategoria = $request->input('kategoria');
        $modell->tipus = $request->input('tipus');
        $modell->gyarto = $request->input('gyarto');
        $modell->kep = $request->input('kep');
        $modell->save();

        return response()->json(['message' => 'Új modell sikeresen feltöltve!', 'modell' => $modell], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($modell_id)
    {
        $modell = Modell::where('modell_id', $modell_id)
        ->get();
        return $modell[0];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $modell_id)
    {
        $record = $this->show($modell_id);
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $modell = Modell::find($id); // Keressük a modellt az ID alapján
    
    if ($modell) {
        $modell->delete(); // Ha találunk modellt, töröljük
        return response()->json(['message' => 'Modell törölve!'], 200);
    } else {
        return response()->json(['error' => 'Modell nem található.'], 404);
    }
}


    public function modellekKategoriaval()
{
    $modellek = Modell::with('kategoria')
        ->get();

    return response()->json($modellek);
}

public function modellMindenAdattal()
    {
        $modellek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])->get();
        return response()->json($modellek);
    }

    public function legujabbModell()
{
    $modellek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
        ->orderBy('created_at', 'desc') 
        ->get();

    return response()->json($modellek);
}


    public function modellSzuressel(Request $request)
    {
        $query = Modell::with(['kategoria', 'termekek.arakMegjelenit']);

        
        if ($request->has('marka') && $request->marka !== null) {
            $query->whereHas('modell', function ($query) use ($request) {
                $query->where('marka', $request->marka);
            });
        }
        if ($request->has('meret') && $request->meret !== null) {
            $query->where('meret', $request->meret);
        }
        if ($request->has('nem') && $request->nem !== null) {
            $query->where('nem', $request->nem);
        }
        if ($request->has('szin') && $request->szin !== null) {
            $query->where('szin', $request->szin);
        }

        
        if ($request->has('rendezes') && in_array($request->rendezes, ['novekv', 'csokkeno'])) {
            $query->orderBy('ar', $request->rendezes == 'novekv' ? 'asc' : 'desc');
        }

        
        $termekek = $query->get();
        return response()->json($termekek);
    }

    public function meretRuhak(string $meret)
    {
        $termekek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
            ->whereHas('termekek.modell', function ($query) use ($meret) {
                $query->where('meret', $meret);
            })
            ->get();

        return response()->json($termekek);
    }


    public function kategoriaRuhak(string $kategoria)
        {
            $termekek = Modell::join('termeks', 'termeks.modell', '=', 'modells.modell_id')
                ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
                ->where('kategorias.ruhazat_kat', $kategoria)
                ->get(['modells.*']);

            return response()->json($termekek);
        }


        public function markaRuhak(string $marka)
        {
            $termekek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
                ->whereHas('termekek.modell', function ($query) use ($marka) {
                    $query->where('gyarto', $marka);
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
        $termekek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
            ->orderBy('ar', 'desc')
            ->get();
    } else {
        $termekek = Modell::with(['kategoria', 'termekek.arakMegjelenit'])
            ->orderBy('ar', 'asc')
            ->get();
    }

    // A termékek visszaadása JSON formátumban
    return response()->json($termekek);
}

}