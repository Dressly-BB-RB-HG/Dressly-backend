<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kedvencek extends Model
{

    protected $fillable = [
        'felhasznalo',
        'modell'

    ];

    public function modell()
    {
        return $this->belongsTo(Modell::class, 'modell', 'modell_id');
    }
}
