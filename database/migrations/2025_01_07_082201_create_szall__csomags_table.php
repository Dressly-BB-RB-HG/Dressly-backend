<?php

use App\Models\Szall_Csomag;
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
            $table->foreignId('rendeles')->references('rendeles_szam')->on('rendeles');
            $table->char('szallito', 3);
            $table->string('csomag_allapot', 15);
            $table->date('szall_datum')->nullable();
            $table->timestamps();
        });

        Szall_Csomag::create([
            'rendeles' => 2,
            'szallito' => 'GLS',
            'csomag_allapot' => 'Csomagolás',

        ]);

        Szall_Csomag::create([
            'rendeles' => 1,
            'szallito' => 'MPL',
            'csomag_allapot' => 'Csomagolás',

        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szall__csomags');
    }
};
