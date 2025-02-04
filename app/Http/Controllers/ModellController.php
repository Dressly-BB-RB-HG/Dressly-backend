<?php

namespace App\Http\Controllers;

use App\Models\Modell;
use Illuminate\Http\Request;

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

    
}

