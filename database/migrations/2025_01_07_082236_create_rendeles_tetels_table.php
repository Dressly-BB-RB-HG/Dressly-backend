<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rendeles_tetel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendeles_tetels', function (Blueprint $table) {
            $table->foreignId('rendeles')->references('rendeles_szam')->on('rendeles');
            $table->foreignId('termek')->references('termek_id')->on('termeks');
            $table->integer('mennyiseg');
            $table->rememberToken();
            $table->timestamps();
        });


        Rendeles_tetel::create([
            'rendeles' => 1, 
            'termek' => 1, 
            'mennyiseg' => 1,
        ]);

        Rendeles_tetel::create([
            'rendeles' => 2, 
            'termek' => 3, 
            'mennyiseg' => 5,
        ]);

        Rendeles_tetel::create([
            'rendeles' => 2, 
            'termek' => 3, 
            'mennyiseg' => 5,
        ]);

        Rendeles_tetel::create([
            'rendeles' => 3, 
            'termek' => 3, 
            'mennyiseg' => 2,
        ]);

        Rendeles_tetel::create([
            'rendeles' => 4, 
            'termek' => 1, 
            'mennyiseg' => 15,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendeles_tetels');
    }
};
