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
        return $this->belongsTo(Kategoria::class, 'kategoria', 'kategoria_id');
    }

    public function kategoriaTermekMegjelenit()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria', 'kategoria_id');
    }

    public function termekek()
    {
        return $this->hasMany(Termek::class, 'modell', 'modell_id');
    }

    public function modellekKategoriaval()
    {
        return $this->belongsTo(Kategoria::class, 'kategoria_id', 'kategoria_id');
    }

    public function kedvencek()
    {
        return $this->hasMany(Kedvencek::class, 'modell', 'modell_id');
    }

}
