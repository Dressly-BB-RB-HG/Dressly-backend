<?php

namespace App\Http\Controllers;

use App\Models\Kosar;
use Illuminate\Http\Request;

class KosarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kosar::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validálás
        $request->validate([
            'termek_id' => 'required|exists:termek,id',
            'mennyiseg' => 'required|integer|min:1',
        ]);

        // Kosárba helyezés
        $kosar = Kosar::create([
            'felhasznalo_id' => auth()->user()->id,  
            'termek_id' => $request->termek_id,
            'mennyiseg' => $request->mennyiseg,
        ]);

        return response()->json($kosar, 201);
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
}
