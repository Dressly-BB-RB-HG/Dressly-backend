<?php

namespace App\Http\Controllers;

use App\Models\Felhasznalo;
use Illuminate\Http\Request;

class FelhasznaloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Felhasznalo::all();
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
    public function show($felhasznalo_id)
    {
        return Felhasznalo::find($felhasznalo_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $felhasznalo_id)
    {
        $record = $this->show($felhasznalo_id);
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Felhasznalo::find($id)->delete();
        return "Felhasználó törölve!";
    }
}
