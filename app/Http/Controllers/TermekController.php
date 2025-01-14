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
}
