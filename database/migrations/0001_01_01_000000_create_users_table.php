<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('k_nev');
            $table->string('v_nev');
            $table->string('password');
            $table->integer('role')->default(0);
            $table->integer('hirlevel')->default(0);
            $table->string('varos');
            $table->integer('iranyitoszam')->default(0);
            $table->string('utca');
            $table->integer('hazszam');
            $table->rememberToken();
            $table->timestamps();
        });
        
        User::create([
            'name' => 'admin', // Megadva!
            'k_nev' => 'Admin',
            'v_nev' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin12345'),
            'role' => 1,
            'varos' => 'Budapest',
            'iranyitoszam' => 2030,
            'utca' => 'Lajos utca',
            'hazszam' => 72
        ]);
        
    
        User::create([
            'name' => 'raktaros',
            'k_nev' => 'Raktaros',
            'v_nev' => 'Raktaros',
            'email' => 'raktaros@raktaros.com',
            'password' => Hash::make('raktaros12345'),
            'role' => 2,
            'varos' => 'Budapest',
            'iranyitoszam' => 2030,
            'utca' => 'Lajos utca',
            'hazszam' => 71
        ]);
    
        User::create([
            'name' => 'felhasznalo',
            'k_nev' => 'Felhasznalo',
            'v_nev' => 'Felhasznalo',
            'email' => 'felhasznalo@felhasznalo.com',
            'password' => Hash::make('felhasznalo12345'),
            'varos' => 'Budapest',
            'iranyitoszam' => 2030,
            'utca' => 'Lajos utca',
            'hazszam' => 70
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
