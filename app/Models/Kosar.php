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

    public function felhasznalo()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function termek()
    {
        return $this->hasMany(Termek::class, 'termek_id');
    }
}
