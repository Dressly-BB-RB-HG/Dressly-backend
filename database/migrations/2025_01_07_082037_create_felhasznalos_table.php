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
        Schema::create('felhasznalos', function (Blueprint $table) {
            $table->id('felhasznalo_id');
            $table->string('fel_nev')->unique();
            $table->string('k_nev');
            $table->string('v_nev');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('jelszo');
            $table->integer('jogosultsag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felhasznalos');
    }
};
