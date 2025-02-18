<?php

use App\Models\Termek_ar;
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
            $table->foreignId('termek')->references('termek_id')->on('termeks');
            $table->date('dtol');
            $table->integer('uj_ar');
            $table->rememberToken();
            $table->timestamps();
        });


        Termek_ar::create([
            'termek' => 1,
            'dtol' => '2024-01-01',
            'uj_ar' => 12990,
        ]);

        Termek_ar::create([
            'termek' => 2,
            'dtol' => '2024-02-01',
            'uj_ar' => 14990,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termek_ars');
    }


};
