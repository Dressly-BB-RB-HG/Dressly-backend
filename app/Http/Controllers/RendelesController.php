<?php

namespace App\Http\Controllers;

use App\Models\Rendeles;

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
            ->limit(1)
            ->get();

        return response()->json($result);
    }
}
