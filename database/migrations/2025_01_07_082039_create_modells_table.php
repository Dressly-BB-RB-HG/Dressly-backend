<?php

use App\Models\Modell;
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
            $table->foreignId('kategoria')->references('kategoria_id')->on('kategorias');
            $table->char('tipus', 1);
            $table->string('gyarto');
            $table->string('kep');
            $table->timestamps();
        });


        Modell::create([
            'kategoria' => 1,
            'tipus' => 'F',
            'gyarto' => 'Nike',
            'kep' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/38f07fd9-b7f8-4203-bde0-53d037c6f6f0/M+NSW+TEE+M90+OC+LBR+SEGA.png',
        ]);

        Modell::create([
            'kategoria' => 3,
            'tipus' => 'N',
            'gyarto' => 'Nike',
            'kep' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/2a9a11b5-754a-4a69-84d9-eb11fefe910d/W+NSW+PHNX+FLC+OS+PO+HOODIE.png',
        ]);

        Modell::create([
            'kategoria' => 3,
            'tipus' => 'U',
            'gyarto' => 'Nike',
            'kep' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/4a6d71f5-e43c-4e09-b851-c7ef8cfacd88/U+NK+SABRINA+SIGNATURE+HDY.png',
        ]);
    }

    /**
     * Reverse the migrations.
     */

     
     
    public function down(): void
    {
        Schema::dropIfExists('modells');
    }
};
