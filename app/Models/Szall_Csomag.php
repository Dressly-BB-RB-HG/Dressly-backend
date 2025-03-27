<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Szall_Csomag extends Model
{
    protected $primaryKey = "csomag_id";

    protected $fillable = [
        "rendeles",
        "szallito",
        "csomag_allapot",
    ];

    // Szall_Csomag.php modell
public function rendeles()
{
    return $this->belongsTo(Rendeles::class, 'rendeles', 'rendeles_szam');
}

}
