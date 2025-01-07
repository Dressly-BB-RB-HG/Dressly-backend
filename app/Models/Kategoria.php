<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{
    protected $primaryKey = "kategoria_id";

    protected $fillable = [
        "ruhazat_kat"
    ];
}
