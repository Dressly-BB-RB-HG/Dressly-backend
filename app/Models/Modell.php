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
}
