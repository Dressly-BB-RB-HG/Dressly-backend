<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HirlevelController;
use App\Http\Controllers\KedvencekController;
use App\Http\Controllers\KosarController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\TermekController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RendelesController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Raktaros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OrderController as GlobalOrderController;

// TermekController
// 'MODELLEK' HELYETT 'TERMEK-MINDEN-ADATTAL'
//Route::get('modellek', [ModellController::class, 'index']);

Route::get('termek-pillanatnyi-ara/{mikor}/{termek}', [TermekController::class, 'termekAra']);
Route::get('mikor-valtozott-ar/{termek}', [TermekController::class, 'mikorValtozottAr']);
Route::get('nincs-keszleten', [TermekController::class, 'nincsKeszleten']);

// ModellController
Route::get('modellek-kategoriaval', [ModellController::class, 'modellekKategoriaval']);
Route::post('kosar', [KosarController::class, 'store']);
Route::get('kosar-megjelen', [KosarController::class, 'index']);
Route::delete('kosarTorles/{id}', [KosarController::class, 'destroy']);


// RendelesController

Route::get('felhasznalo/{id}/rendelesek', [RendelesController::class, 'osszesRendeles']);

// bazsi
Route::get('rendeles/{rendelesSzam}/tetel', [RendelesController::class, 'rendelesTetel']);
  
// KedvencekController


// UserController

// EMAIL TESZT
Route::post('email-kuldes', [OrderController::class, 'sendOrderConfirmation']);

// HirlevelController
Route::patch('feliratkozas-hirlevelre', [HirlevelController::class, 'feliratkozas']);


// Szűrési/rendezési feltételekhez:
Route::get('szinu-ruha/{szin}/{kategoria}', [TermekController::class, 'szinuRuha']);
Route::get('szinu-minden/{szin}', [TermekController::class, 'szinuMinden']);
Route::get('marka-ruhak/{marka}', [TermekController::class, 'markaRuhak']);
Route::get('meret-ruhak/{meret}', [TermekController::class, 'meretRuhak']);
Route::get('nemu-ruhak/{nem}', [TermekController::class, 'adottNemu']);
Route::get('termek-rendez-ar-szerint', [TermekController::class, 'rendezTermekekArSzerint']);
Route::get('marka-kategoria/{marka}/{kategoria}', [TermekController::class, 'markaKategoria']);
Route::get('nemu-kategoria/{nem}/{kategoria}', [TermekController::class, 'nemuKategoria']);
Route::get('kategoria-ruhak/{kategoria}', [TermekController::class, 'kategoriaRuhak']);
Route::get('meret-marka-tipus/{meret}/{marka}/{tipus}', [TermekController::class, 'meretMarkaTipus']);
Route::get('meret-marka-tipus-kategoria/{meret}/{marka}/{tipus}/{kategoria}', [TermekController::class, 'meretMarkaTipusKategoria']);
Route::get('termek-minden-adattal', [TermekController::class, 'termekMindenAdattal']);
Route::get('modellek-kategoriaval', [ModellController::class, 'modellekKategoriaval']);
Route::get('legkedveltebb-modell', [RendelesController::class, 'legkedveltebbModell']);
Route::get('legujabb-modell', [TermekController::class, 'legujabbModell']);
Route::get('termek-szures', [TermekController::class, 'termekSzuressel']);


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('update-profile', [UserController::class, 'updateProfile']);


Route::middleware(['auth:sanctum', User::class])
    ->group(function(){
        
    });


Route::middleware(['auth:sanctum', Admin::class])
    ->group(function(){
        Route::get('admin/felhasznalo/{id}', [UserController::class, 'show']);
        Route::get('admin/felhasznalok', [UserController::class, 'index']);
        Route::get('admin/termekek/{modell_id}', [TermekController::class, 'index']);
        Route::post('admin/modell', [ModellController::class, 'store']);
        Route::put('admin/termek-modosit/{modell_id}', [TermekController::class, 'update']);
        Route::get('admin/termek/{id}', [TermekController::class, 'show']);
        Route::get('admin/modell/{id}', [ModellController::class, 'show']);
        Route::delete('admin/felhasznalo-torles/{id}', [UserController::class, 'destroy']);
        Route::delete('admin/modell-torles/{id}', [ModellController::class, 'destroy']);
        Route::put('admin/felhasznalok/{id}/role', [UserController::class, 'updateRole']);
        Route::get('admin/modellek', [ModellController::class, 'index']);
        Route::get('megrendelok-listazasa', [UserController::class, 'megrendelok']);
        Route::get('hirlevel-feliratkozok', [UserController::class, 'hirlevelFeliratkozok']);
        Route::get('melyik-megrendelo-a-legtobbet', [UserController::class, 'melyikMegrendeloALegtobbet']);
        Route::get('legsikeresebb-termek-kategoria/{kategoriaId}', [TermekController::class, 'legsikeresebbTermekKategoria']);
        Route::get('leggyakoribb-szin', [RendelesController::class, 'leggyakoribbSzin']);
        Route::get('leggyakoribb-meret', [RendelesController::class, 'leggyakoribbMeret']);
        Route::get('legsikeresebb-honap', [RendelesController::class, 'legsikeresebbHonap']);
        Route::get('legtobbet-rendelt-termek', [RendelesController::class, 'legtobbRendeles']);
        // összes rendelés listázása
        Route::get('admin/rendelesek-osszes', [RendelesController::class, 'rendelesekOsszes']);
        // adott rendelés törlése
        Route::delete('admin/adott-rendeles-torlese/{rendelesSzam}', [RendelesController::class, 'adottRendelesTorlese']);

        Route::get('utolso-rendeles-megrendelo/{userId}', [UserController::class, 'utolsoRendelesMegrendelo']);
        

    });
    

Route::middleware(['auth:sanctum', Raktaros::class])
    ->group(function(){
        Route::get('raktaros/modellek', [ModellController::class, 'index']);
        Route::get('raktaros/termekek', [TermekController::class, 'index']);
        Route::get('raktaros/termek/{id}', [TermekController::class, 'show']);
        Route::get('raktaros/modell/{id}', [ModellController::class, 'show']);
        Route::post('raktaros/modell-hozzaad', [ModellController::class, 'store']);
        Route::post('raktaros/termek-hozzaad', [TermekController::class, 'store']);
        Route::patch('raktaros/modell-modosit', [ModellController::class, 'update']);
        Route::patch('raktaros/termek-modosit', [TermekController::class, 'update']);
        Route::delete('raktaros/termek-torles/{id}', [TermekController::class, 'destroy']);
        Route::delete('raktaros/modell-torles/{id}', [ModellController::class, 'destroy']);
        Route::get('utolso-rendeles', [RendelesController::class, 'utolsoRendeles']);
        Route::get('utolso-termek-rendeles/{termek}', [RendelesController::class, 'utolsoTermekRendeles']);
        Route::get('kiszallitasra_varakozo-rendelesek', [RendelesController::class, 'kiszallitasraVarakozoRendelesek']);
    });