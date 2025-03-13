<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kosar extends Model
{

    protected $fillable = [
        "felhasznalo",
        "termek",
        "mennyiseg"
    ];

    public $incrementing = false; // Laravel ne várja el az `id` mezőt
    protected $primaryKey = null; // Nem használ elsődleges kulcsot

    
    public function felhasznalo()
    {
        return $this->belongsTo(User::class, 'felhasznalo');
    }

    public function termek()
    {
        return $this->belongsTo(Termek::class, 'termek');
    }



}
