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

        Modell::create([
            'kategoria' => 5,
            'tipus' => 'N',
            'gyarto' => 'The North Face',
            'kep' => 'https://assets.thenorthface.com/images/t_img/c_pad,b_white,f_auto,h_1510,w_1300,e_sharpen:70/NF0A88Z1JK3-HERO/NF0A88Z1JK3-in-TNF-Black.png',
        ]);

        Modell::create([
            'kategoria' => 4,
            'tipus' => 'U',
            'gyarto' => 'Puma',
            'kep' => 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_550,h_550/global/906110/04/fnd/EEA/fmt/png/PUMA-Unisex-Short-Crew-Socks-3-Pack',
        ]);

        Modell::create([
            'kategoria' => 8,
            'tipus' => 'F',
            'gyarto' => 'Adidas',
            'kep' => 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/00807ed890c5497f89bbcd4bae02a308_9366/Manchester_United_24-25_Third_Jersey_White_IY7806_HM1.jpg',
        ]);

        Modell::create([
            'kategoria' => 2,
            'tipus' => 'N',
            'gyarto' => 'The North Face',
            'kep' => 'https://img2.ans-media.com/i/840x1260/AW24-BUD05F-99X_F1.jpg@webp?v=1721193971',
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
