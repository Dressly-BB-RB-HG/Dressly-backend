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
        Schema::create('kosars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('felhasznalo')->references('felhasznalo_id')->on('Felhasznalo');
            $table->foreignId('termek')->references('termek_id')->on('Termek');
            $table->integer('mennyiseg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosars');
    }
};
