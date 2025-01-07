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
        Schema::create('rendeles_tetels', function (Blueprint $table) {
            $table->integer('rendeles');
            $table->integer('termek');
            $table->integer('mennyiseg');
            $table->foreignId('rendeles')->references('rendeles_szam')->on('Rendeles');
            $table->foreignId('termek')->references('termek_id')->on('Termek');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendeles_tetels');
    }
};
