<?php

use App\Models\Kategoria;
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
        Schema::create('kategorias', function (Blueprint $table) {
            $table->id('kategoria_id');
            $table->string('ruhazat_kat');
            $table->rememberToken();
            $table->timestamps();
        });

        Kategoria::create([
            'ruhazat_kat' => 'Rövid ujjú póló'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Hosszú ujjú póló'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Pulóver'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Zokni'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Kabát'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Dzseki'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Galléros póló'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Mezek'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Farmernadrág'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Szabadidőnadrág'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Rövidnadrág'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Nadrág'
        ]);

        Kategoria::create([
            'ruhazat_kat' => 'Sapka'
        ]);
    }


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategorias');
    }
};
