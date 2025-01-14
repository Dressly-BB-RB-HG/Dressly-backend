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

    public function isFelhasznalo(){
        return $this->jogosultsag === 0;
    }

    public function isAdmin(){
        return $this->jogosultsag === 1;
    }

    public function isRaktaros(){
        return $this->jogosultsag === 2;
    }
}
