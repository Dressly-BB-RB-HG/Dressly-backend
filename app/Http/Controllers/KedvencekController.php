<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KedvencekController extends Controller
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

    public function legkedveltebbModell()
{
    $legkedveltebbModell = DB::table('kedvenceks')
        ->select('modell', DB::raw('COUNT(DISTINCT felhasznalo) as kedvenc_count'))
        ->groupBy('modell')
        ->orderByDesc('kedvenc_count')
        ->first();

    return response()->json([
        'modell_id' => $legkedveltebbModell->modell,
        'kedvencek_szama' => $legkedveltebbModell->kedvenc_count
    ]);
}

}
