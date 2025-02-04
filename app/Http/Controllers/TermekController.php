<?php

namespace App\Http\Controllers;

use App\Models\Termek;
use Illuminate\Http\Request;

class TermekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Termek::all();
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
    public function update(Request $request, $termek_id)
    {
        $record = $this->show($termek_id);
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Termek::find($id)->delete();
        return "Termék törölve!";
    }


    public function uniszexPuloverek()
    {
        $termekek = Termek::with(['modell.kategoria'])
            ->whereHas('modell.kategoria', function($query) {
                $query->where('ruhazat_kat', 'Pulóver');
            })
            ->whereHas('modell', function($query) {
                $query->where('tipus', 'U');
            })
            ->get();

        return response()->json($termekek);
    }


    public function noiPuloverek()
    {
        $termekek = Termek::with(['modell.kategoria'])
            ->whereHas('modell.kategoria', function($query) {
                $query->where('ruhazat_kat', 'Pulóver');
            })
            ->whereHas('modell', function($query) {
                $query->where('tipus', 'N');
            })
            ->get();

        return response()->json($termekek);
    }

    public function szinuRuha(string $szin, string $kategoria)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('termeks.szin', $szin)
        ->where('kategorias.ruhazat_kat', $kategoria)
        ->get(['termeks.*']);
        return response()->json($termekek);
    }

    public function szinuMinden(string $szin)
    {
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('termeks.szin', $szin)
        ->get(['termeks.*']);
        return response()->json($termekek);
    }

    public function nikeRuhak()
    {
    $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('modells.gyarto', 'Nike')
        ->get(['termeks.*']);
    
    return response()->json($termekek);
    }   

    public function nikePulcsik(){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('kategorias.ruhazat_kat', 'pulóver')
        ->where('modells.gyarto', 'Nike') 
        ->get(['termeks.*']);

        return response()->json($termekek);
    }

    public function adidasRuhak()
    {
    $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('modells.gyarto', 'Adidas')
        ->get(['termeks.*']);
    
    return response()->json($termekek);
    }   

    public function pumaRuhak()
    {
    $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->where('modells.gyarto', 'Puma')
        ->get(['termeks.*']);
    
    return response()->json($termekek);
    }   



    public function rovidUjjuPolok()
    {
        $termekek = Termek::with(['modell.kategoria'])
            ->whereHas('modell.kategoria', function($query) {
                $query->where('ruhazat_kat', 'Rövid ujjú póló');
            })
            ->get();
}
    
    public function pulcsik(){
        $termekek = Termek::join('modells', 'termeks.modell', '=', 'modells.modell_id')
        ->join('kategorias', 'modells.kategoria', '=', 'kategorias.kategoria_id')
        ->where('kategorias.ruhazat_kat', 'pulóver') 
        ->get(['termeks.*']);

        return response()->json($termekek);
    }
}


