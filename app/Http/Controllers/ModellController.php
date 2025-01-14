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
        $record = new Modell();
        $record->fill($request->all());
        $record->save();
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Modell::find($id)->delete();
        return "Modell törölve!";
    }
}
