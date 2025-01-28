<?php

namespace App\Observers;

use App\Models\rendeles_Tetel;
use App\Models\Termek;

class RendelesTetelObserver
{
    /**
     * Handle the RendelesTetel "created" event.
     */
    public function created(rendeles_Tetel $rendelesTetel): void
    {
        {
            // Csökkentsd a készletet a rendelés tétel mennyiségével
            $termek = Termek::find($rendelesTetel->termek);
            if ($termek && $termek->keszlet >= $rendelesTetel->mennyiseg) {
                $termek->keszlet -= $rendelesTetel->mennyiseg;
                $termek->save();
            } else {
                throw new \Exception('Nincs elegendő készlet a termékből!');
            }
        }
    }

}
