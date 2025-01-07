<?php

use App\Models\Termek;
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
        Schema::create('termeks', function (Blueprint $table) {
            $table->id('termek_id');
            $table->foreignId('modell')->references('modell_id')->on('modells');
            $table->string('szin');
            $table->char('meret', 3);
            $table->integer('keszlet');
            $table->integer('ar');
            $table->timestamps();
        });

        Termek::create([
            'modell' => 1,
            'szin' => 'Barna',
            'meret' => 'M',
            'keszlet' => 50,
            'ar' => 7999,
        ]);
        
        Termek::create([
            'modell' => 2,
            'szin' => 'Szürke',
            'meret' => 'L',
            'keszlet' => 30,
            'ar' => 10999,
        ]);
        
        Termek::create([
            'modell' => 3,
            'szin' => 'Rózsaszín',
            'meret' => 'S',
            'keszlet' => 20,
            'ar' => 8999,
        ]);
        
    }


    public function down(): void
    {
        Schema::dropIfExists('termeks');
    }
};
