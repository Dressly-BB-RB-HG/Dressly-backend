<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Felhasznalo extends Model
{
    protected $primaryKey = "felhasznalo_id";

    protected $fillable = [
        'fel_nev',
        'k_nev',
        'v_nev',
        'email',
        'jelszo',
        'jogosultsag'
    ];
}
