<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termek extends Model
{
    protected $primaryKey = "termek_id";

    protected $fillable = [
        "modell",
        "szin",
        "meret",
        "keszlet",
        "ar"
    ];


    public function modell()
    {
        return $this->belongsTo(Modell::class, 'modell');
    }
    

}
