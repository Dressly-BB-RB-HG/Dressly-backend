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
            $table->foreignId('modell')->references('modell_id')->on('modells')->onDelete('cascade');
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

        Termek::create([
            'modell' => 4,
            'szin' => 'Fekete',
            'meret' => 'M',
            'keszlet' => 40,
            'ar' => 73999,
        ]);

        Termek::create([
            'modell' => 5,
            'szin' => 'Fehér',
            'meret' => 'M',
            'keszlet' => 120,
            'ar' => 3890,
        ]);

        Termek::create([
            'modell' => 6,
            'szin' => 'Fehér',
            'meret' => 'M',
            'keszlet' => 32,
            'ar' => 30999,
        ]);

        Termek::create([
            'modell' => 7,
            'szin' => 'Fekete',
            'meret' => 'L',
            'keszlet' => 20,
            'ar' => 9999,
        ]);

        Termek::create([
            'modell' => 7,
            'szin' => 'Piros',
            'meret' => 'M',
            'keszlet' => 0,
            'ar' => 9999,
        ]);

        Termek::create([
            'modell' => 8,
            'szin' => 'Beige',
            'meret' => 'L',
            'keszlet' => 21,
            'ar' => 39990,
        ]);

        Termek::create([
            'modell' => 9,
            'szin' => 'Beige',
            'meret' => 'S',
            'keszlet' => 21,
            'ar' => 49990,
        ]);

        Termek::create([
            'modell' => 10,
            'szin' => 'Fehér',
            'meret' => 'S',
            'keszlet' => 25,
            'ar' => 29990,
        ]);
        
        Termek::create([
            'modell' => 11,
            'szin' => 'Kék',
            'meret' => 'M',
            'keszlet' => 25,
            'ar' => 27990,
        ]);

        Termek::create([
            'modell' => 12,
            'szin' => 'Beige',
            'meret' => 'M',
            'keszlet' => 25,
            'ar' => 19990,
        ]);

        Termek::create([
            'modell' => 13,
            'szin' => 'Lila',
            'meret' => 'M',
            'keszlet' => 25,
            'ar' => 9990,
        ]);

        Termek::create([
            'modell' => 14,
            'szin' => 'Barna',
            'meret' => 'L',
            'keszlet' => 25,
            'ar' => 59990,
        ]);
    
        Termek::create([
            'modell' => 15,
            'szin' => 'Kék',
            'meret' => 'S',
            'keszlet' => 25,
            'ar' => 29990,
        ]);

        Termek::create([
            'modell' => 16,
            'szin' => 'Fekete',
            'meret' => 'S',
            'keszlet' => 25,
            'ar' => 19990,
        ]);
    }


    public function down(): void
    {
        Schema::dropIfExists('termeks');
    }
};
