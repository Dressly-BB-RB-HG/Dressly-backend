<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendeles_tetel extends Model
{

    protected $fillable = [
        'rendeles',
        'termek',
        'mennyiseg'

    ];


    public function rendeles()
    {
        return $this->belongsTo(Rendeles::class, 'rendeles');
    }

    public function termek()
    {
        return $this->belongsTo(Termek::class, 'termek');
    }

    public function modell()
    {
        return $this->belongsTo(Modell::class, 'modell');
    }
    
}
