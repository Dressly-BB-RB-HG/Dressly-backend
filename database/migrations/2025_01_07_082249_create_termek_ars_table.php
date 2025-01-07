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
        Schema::create('termek_ars', function (Blueprint $table) {
            $table->primary(['termek', 'dtol']);
            $table->foreignId('termek')->references('termek_id')->on('Termek');
            $table->date('dtol');
            $table->integer('uj_ar');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termek_ars');
    }
};
