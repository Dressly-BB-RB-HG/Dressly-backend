<?php

use App\Models\Kedvencek;
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
            $table->primary(['felhasznalo', 'modell']);
            $table->foreignId('felhasznalo')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('modell')->references('modell_id')->on('modells')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });


        Kedvencek::create([
            'felhasznalo' => 1,
            'modell' => 1,   
        ]);
    
        Kedvencek::create([
            'felhasznalo' => 3,
            'modell' => 1,
        ]);

        Kedvencek::create([
            'felhasznalo' => 3,
            'modell' => 5,
        ]);

        Kedvencek::create([
            'felhasznalo' => 3,
            'modell' => 7,
        ]);

        Kedvencek::create([
            'felhasznalo' => 3,
            'modell' => 3,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kedvenceks');
    }
};
