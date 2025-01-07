<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kedvenceks', function (Blueprint $table) {
            $table->primary(['felhasznalo', 'termek']);
            $table->foreignId('felhasznalo')->references('felhasznalo_id')->on('felhasznalos');
            $table->foreignId('termek')->references('modell_id')->on('modells');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kedvenceks');
    }
};
