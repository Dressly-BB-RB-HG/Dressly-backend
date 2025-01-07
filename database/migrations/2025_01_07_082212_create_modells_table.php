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
        Schema::create('modells', function (Blueprint $table) {
            $table->id('modell_id');
            $table->foreignId('kategoria')->references('kategoria_id')->on('Kategoria');
            $table->char('tipus', 1);
            $table->string('gyarto');
            $table->string('kep');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modells');
    }
};
