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
        Schema::create('szall__csomags', function (Blueprint $table) {
            $table->id('csomag_id');
            $table->foreignId('rendeles')->references('rendeles_szam')->on('Rendeles');
            $table->char('szallito', 3);
            $table->string('csomag_allapot', 15);
            $table->date('szall_datum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szall__csomags');
    }
};
