<?php
use App\Http\Controllers\HirlevelController;
use App\Http\Controllers\KedvencekController;
use App\Http\Controllers\KosarController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TermekController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RendelesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SzallCsomagController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Raktaros;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// vendég által is elérhető:
Route::get('modellek-kategoriaval', [ModellController::class, 'modellekKategoriaval']);
Route::get('elerhetoMeretek/{id}', [TermekController::class, 'elerhetoMeretek']);
Route::post('regisztracio-email-kuldes', [RegisterController::class, 'sendRegistrationEmail']);




// VENDÉG ÁLTAL IS ELÉRHETŐ Szűrési/rendezési feltételekhez:
Route::get('szinu-ruha/{szin}/{kategoria}', [TermekController::class, 'szinuRuha']);
Route::get('szinu-minden/{szin}', [ModellController::class, 'szinuMinden']);
Route::get('marka-ruhak/{marka}', [ModellController::class, 'markaRuhak']);
Route::get('meret-ruhak/{meret}', [ModellController::class, 'meretRuhak']);
Route::get('nemu-ruhak/{nem}', [ModellController::class, 'adottNemu']);
Route::get('termek-rendez-ar-szerint', [ModellController::class, 'rendezTermekekArSzerint']);
Route::get('marka-kategoria/{marka}/{kategoria}', [TermekController::class, 'markaKategoria']);
Route::get('nemu-kategoria/{nem}/{kategoria}', [TermekController::class, 'nemuKategoria']);
Route::get('kategoria-ruhak/{kategoria}', [ModellController::class, 'kategoriaRuhak']);
Route::get('meret-marka-tipus/{meret}/{marka}/{tipus}', [TermekController::class, 'meretMarkaTipus']);
Route::get('meret-marka-tipus-kategoria/{meret}/{marka}/{tipus}/{kategoria}', [TermekController::class, 'meretMarkaTipusKategoria']);
Route::get('modell-minden-adattal', [ModellController::class, 'modellMindenAdattal']);
Route::get('modellek-kategoriaval', [ModellController::class, 'modellekKategoriaval']);
Route::get('legkedveltebb-modell', [RendelesController::class, 'legkedveltebbModell']);
Route::get('legujabb-modell', [ModellController::class, 'legujabbModell']);
Route::get('termek-szures', [ModellController::class, 'modellSzuressel']);




Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum', UserMiddleware::class])
    ->group(function(){
        Route::post('kosar', [KosarController::class, 'store']);
        Route::get('kosar-megjelen', [KosarController::class, 'index']);
        Route::delete('kosarTorles/{id}', [KosarController::class, 'destroy']);
        Route::get('kedvenc-termek', [KedvencekController::class, 'kedvencTermekek']);
        Route::post('kedvencekhez-ad', [KedvencekController::class, 'kedvencHozzaad']);
        Route::delete('kedvencek-torol/{id}', [KedvencekController::class, 'destroy']);
        Route::get('felhasznalo/{id}/rendelesek', [RendelesController::class, 'osszesRendeles']);
        Route::get('rendeles/{rendelesSzam}/tetel', [RendelesController::class, 'rendelesTetel']);
        Route::put('rendeles/{rendelesSzam}/atvettem', [RendelesController::class, 'atvettem']);
        Route::put('update-profile', [UserController::class, 'updateProfile']);
        Route::post('rendeles-leadas', [RendelesController::class, 'store']);
        Route::patch('feliratkozas-hirlevelre', [HirlevelController::class, 'feliratkozas']);
        Route::patch('leiratkozas-hirlevelrol', [HirlevelController::class, 'leiratkozas']);
        Route::get('feliratkozas-status', [HirlevelController::class, 'feliratkozasStatus']);
        Route::post('send-subscription-email', [NewsletterController::class, 'sendSubscriptionEmail']);
        Route::post('send-unsubscription-email', [NewsletterController::class, 'sendUnsubscriptionEmail']);
        Route::post('email-kuldes', [OrderController::class, 'sendOrderConfirmation']);
        /* Route::post('csomag-leadas', [SzallCsomagController::class, 'leadCsomag']); */
    });


Route::middleware(['auth:sanctum', Admin::class])
    ->group(function(){
        Route::get('admin/felhasznalo/{id}', [UserController::class, 'show']);
        Route::get('admin/felhasznalok', [UserController::class, 'index']);
        Route::get('admin/termekek/{modell_id}', [TermekController::class, 'index']);
        Route::post('admin/modell', [ModellController::class, 'store']);
        Route::get('admin/modellek', [ModellController::class, 'index']);
        Route::put('admin/termek-modosit/{modell_id}', [TermekController::class, 'update']);
        Route::get('admin/termek/{id}', [TermekController::class, 'show']);
        Route::get('admin/modell/{id}', [ModellController::class, 'show']);
        Route::delete('admin/felhasznalo-torles/{id}', [UserController::class, 'destroy']);
        Route::delete('admin/modell-torles/{id}', [ModellController::class, 'destroy']);
        Route::put('admin/felhasznalok/{id}/role', [UserController::class, 'updateRole']);
        Route::get('admin/szall-csomags', [SzallCsomagController::class, 'index']);
        Route::get('megrendelok-listazasa', [UserController::class, 'megrendelok']);
        Route::get('hirlevel-feliratkozok', [UserController::class, 'hirlevelFeliratkozok']);
        Route::get('melyik-megrendelo-a-legtobbet', [UserController::class, 'melyikMegrendeloALegtobbet']);
        Route::get('legsikeresebb-termek-kategoria/{kategoriaId}', [TermekController::class, 'legsikeresebbTermekKategoria']);
        Route::get('leggyakoribb-szin', [RendelesController::class, 'leggyakoribbSzin']);
        Route::get('leggyakoribb-meret', [RendelesController::class, 'leggyakoribbMeret']);
        Route::get('legsikeresebb-honap', [RendelesController::class, 'legsikeresebbHonap']);
        Route::get('legtobbet-rendelt-termek', [RendelesController::class, 'legtobbRendeles']);
        Route::get('admin/rendelesek-osszes', [RendelesController::class, 'rendelesekOsszes']);
        Route::delete('admin/adott-rendeles-torlese/{rendelesSzam}', [RendelesController::class, 'adottRendelesTorlese']);
        Route::get('utolso-rendeles-megrendelo/{userId}', [UserController::class, 'utolsoRendelesMegrendelo']);
        Route::put('admin/szall-csomags/{csomagId}/allapot', [SzallCsomagController::class, 'updateAllapot']);
        Route::get('termek-pillanatnyi-ara/{mikor}/{termek}', [TermekController::class, 'termekAra']);
        Route::get('mikor-valtozott-ar/{termek}', [TermekController::class, 'mikorValtozottAr']);
        Route::get('nincs-keszleten', [TermekController::class, 'nincsKeszleten']);

    });
    


Route::middleware(['auth:sanctum', Raktaros::class])
    ->group(function(){
        Route::get('raktaros/rendelesek-osszes', [RendelesController::class, 'rendelesekOsszes']);
        Route::delete('raktaros/adott-rendeles-torlese/{rendelesSzam}', [RendelesController::class, 'adottRendelesTorlese']);
        Route::put('raktaros/termek-modosit/{modell_id}', [TermekController::class, 'update']);
        Route::get('raktaros/termekek/{modell_id}', [TermekController::class, 'index']);
        Route::post('raktaros/modell', [ModellController::class, 'store']);
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
        Route::get('raktaros/utolso-rendeles', [RendelesController::class, 'utolsoRendeles']);
        Route::get('raktaros/utolso-termek-rendeles/{termek}', [RendelesController::class, 'utolsoTermekRendeles']);
        Route::get('raktaros/kiszallitasra_varakozo-rendelesek', [RendelesController::class, 'kiszallitasraVarakozoRendelesek']);
        Route::put('raktaros/szall-csomags/{csomagId}/allapot', [SzallCsomagController::class, 'updateAllapot']); 
        Route::get('raktaros/rendelesek-osszes', [RendelesController::class, 'rendelesekOsszes']);
        /* Route::get('rendeles/{rendelesSzam}/tetel', [RendelesController::class, 'rendelesTetel']); */
        /* Route::put('rendeles/{rendelesSzam}/atvettem', [RendelesController::class, 'atvettem']); */
        /* Route::put('update-profile', [UserController::class, 'updateProfile']); */
        //hasznos lekérdezések
        Route::get('raktaros/termek-pillanatnyi-ara/{mikor}/{termek}', [TermekController::class, 'termekAra']);
        Route::get('raktaros/mikor-valtozott-ar/{termek}', [TermekController::class, 'mikorValtozottAr']);
        Route::get('raktaros/nincs-keszleten', [TermekController::class, 'nincsKeszleten']);
        Route::get('raktaros/szall-csomags', [SzallCsomagController::class, 'index']); 
    });