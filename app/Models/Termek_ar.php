<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termek_ar extends Model
{

    protected $fillable = [
        'termek',
        'dtol',
        'uj_ar'

    ];


    public function termek()
    {
        return $this->belongsTo(Termek::class, 'termek', 'termek_id');
    }
}
