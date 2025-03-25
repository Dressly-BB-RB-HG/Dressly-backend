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

        Modell::create([
            'kategoria' => 1,
            'tipus' => 'F',
            'gyarto' => 'Ralph Lauren',
            'kep' => 'https://img01.ztat.net/article/spp-media-p1/f7c4b084ab704316ad0654eb892e20a7/bbb7c8e0a2144c5599435ab76c609879.jpg?imwidth=762',
        ]);

        Modell::create([
            'kategoria' => 3,
            'tipus' => 'N',
            'gyarto' => 'Ralph Lauren',
            'kep' => 'https://img01.ztat.net/article/spp-media-p1/32d5c535f8bb41f7a089acfa8f2722f4/2c8bd3ab05b0476fbc09e45d55a89be5.jpg?imwidth=762',
        ]);

        Modell::create([
            'kategoria' => 1,
            'tipus' => 'N',
            'gyarto' => 'Boss',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/47f1e006ca934f62a976bc37f2adeb16/18f012cc3db746f0b97e8a792f5cce7d.jpg?imwidth=1800',
        ]);

        Modell::create([
            'kategoria' => 9,
            'tipus' => 'N',
            'gyarto' => 'Boss',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/e00da3e84079427ebd6acd135c4557b7/2b859b5c821b4c2ba04db8897357d3a1.jpg?imwidth=1800',
        ]);

        Modell::create([
            'kategoria' => 11,
            'tipus' => 'F',
            'gyarto' => 'Boss',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/6f8dbc76dc3a433c9e53b621234e8db7/3d635fbb6b4b481ea19208e44662f98c.jpg?imwidth=1800',
        ]);

        Modell::create([
            'kategoria' => 13,
            'tipus' => 'U',
            'gyarto' => 'Puma',
            'kep' => 'https://img01.ztat.net/article/spp-media-p1/14d265ca7b9d4e668c62363df1b371be/6833c58b40894a35a7e078520e8c55e8.jpg?imwidth=762&filter=packshot',
        ]);


        Modell::create([
            'kategoria' => 5,
            'tipus' => 'F',
            'gyarto' => 'Tommy Hilfiger',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/8fdb15e9ed3744f088d1b3a454ae58a5/dc79eedb2f0a4904aafa2dad86fce4be.jpg?imwidth=1800',
        ]);
        

        Modell::create([
            'kategoria' => 9,
            'tipus' => 'F',
            'gyarto' => 'Tommy Hilfiger',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/f2e91e5868114ad0992568b05a51ad4c/31b12ba5ef5f4d73a162949a03489f06.jpg?imwidth=1800',
        ]);

        Modell::create([
            'kategoria' => 10,
            'tipus' => 'N',
            'gyarto' => 'Adidas',
            'kep' => ' https://img01.ztat.net/article/spp-media-p1/a0fb4aea792e4f52a6e1b1c39d1fa209/d3d91a16e4a9477ca631720bb18953fe.jpg?imwidth=1800',
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
