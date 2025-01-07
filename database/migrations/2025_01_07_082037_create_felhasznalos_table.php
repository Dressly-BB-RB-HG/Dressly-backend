<?php

use App\Models\Felhasznalo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('felhasznalos', function (Blueprint $table) {
            $table->id('felhasznalo_id');
            $table->string('fel_nev')->unique();
            $table->string('k_nev');
            $table->string('v_nev');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('jelszo');
            $table->integer('jogosultsag')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Felhasznalo::create([
            'fel_nev' => 'admin',
            'k_nev' => 'Admin',
            'v_nev' => 'Admin',
            'email' => 'admin@admin.com',
            'jelszo' => Hash::make('admin12345'),
            'jogosultsag' => 1,
        ]);
        
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felhasznalos');
    }
};
