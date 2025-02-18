<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rendeles_tetel;

class Rendeles extends Model
{
    protected $primaryKey = "rendeles_szam";

    protected $fillable = [
        "felhasznalo",
        "rendeles_datum",
        "fizetve_e"
    ];
    
    public function rendelesTetel()
    {
        return $this->hasMany(Rendeles_tetel::class, 'rendeles');
    }


}
