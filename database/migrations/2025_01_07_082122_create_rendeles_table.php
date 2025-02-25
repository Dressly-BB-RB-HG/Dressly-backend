<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rendeles;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendeles', function (Blueprint $table) {
            $table->id('rendeles_szam');
            $table->foreignId('felhasznalo')->references('id')->on('users');
            $table->timestamp('rendeles_datum')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fizetve_e')->default(0);
            $table->timestamps();
        });

        Rendeles::create([
            'felhasznalo' => 3, 
            'fizetve_e' => 0, 
            ]);
    
        Rendeles::create([
            'felhasznalo' => 3, 
            'fizetve_e' => 0, 
        ]);

        Rendeles::create([
            'felhasznalo' => 3, 
            'fizetve_e' => 0, 
            'rendeles_datum' => '2024-12-22'
        ]);

        Rendeles::create([
            'felhasznalo' => 3, 
            'fizetve_e' => 0, 
            'rendeles_datum' => '2024-12-20'
        ]);

        Rendeles::create([
            'felhasznalo' => 3, 
            'fizetve_e' => 0, 
        ]);

    }


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendeles');
    }




};
