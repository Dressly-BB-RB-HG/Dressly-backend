<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'k_nev' => ['required', 'string', 'max:50'],
            'v_nev' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Város validáció
            'varos' => ['required', 'string', 'max:100'],  // Itt meghagyom string típusú validációt
            
            // Kerület validáció
            'iranyitoszam' => ['required', 'integer', 'max:10000'],  // Új mező, kerület
            
            // Utca validáció
            'utca' => ['required', 'string', 'max:255'],  // Új mező, utca
            
            // Házszám validáció
            'hazszam' => ['required', 'integer', 'max:255'],  // Új mező, házszám
        ]);

        $user = User::create([
            'name' => $request->name,
            'k_nev' => $request->k_nev,
            'v_nev' => $request->v_nev,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'varos' => $request->varos,  // Város mentése
            'iranyitoszam' => $request->iranyitoszam,  // Kerület mentése
            'utca' => $request->utca,  // Utca mentése
            'hazszam' => $request->hazszam,  // Házszám mentése
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}