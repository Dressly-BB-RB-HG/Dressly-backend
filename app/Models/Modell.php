<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    protected $primaryKey = "modell_id";

    protected $fillable = [
        "kategoria",
        "tipus",
        "gyarto",
        "kep"
    ];


    public function kategoria()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria');
    }

    public function modellekKategoriaval()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria_id', 'kategoria_id');
    }
}
