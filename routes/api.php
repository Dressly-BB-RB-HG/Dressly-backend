<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\TermekController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Raktaros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('admin/modellek', [ModellController::class, 'index']);

Route::get('uniszex-puloverek', [TermekController::class, 'uniszexPuloverek']);
Route::get('modellek-kategoriaval', [ModellController::class, 'modellekKategoriaval']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('update-profile', [UserController::class, 'updateProfile']);

Route::middleware(['auth:sanctum', User::class])
    ->group(function(){
        
    });


Route::middleware(['auth:sanctum', Admin::class])
    ->group(function(){
        Route::get('admin/felhasznalo/{id}', [UserController::class, 'show']);
        Route::get('admin/felhasznalok', [UserController::class, 'index']);
        Route::get('admin/termekek', [TermekController::class, 'index']);

        
        Route::get('admin/termek/{id}', [TermekController::class, 'show']);
        Route::get('admin/modell/{id}', [ModellController::class, 'show']);
        Route::patch('admin/update-password/{id}', [UserController::class, 'updatePassword']);
        Route::delete('admin/felhasznaloTorles/{id}', [UserController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', Raktaros::class])
    ->group(function(){
        Route::get('raktaros/modellek', [ModellController::class, 'index']);
        Route::get('raktaros/termekek', [TermekController::class, 'index']);
        Route::get('raktaros/termek/{id}', [TermekController::class, 'show']);
        Route::get('raktaros/modell/{id}', [ModellController::class, 'show']);
        Route::post('raktaros/modellHozzaad', [ModellController::class, 'store']);
        Route::post('raktaros/termekHozzaad', [TermekController::class, 'store']);
        Route::patch('raktaros/modellModosit', [ModellController::class, 'update']);
        Route::patch('raktaros/termekModosit', [TermekController::class, 'update']);
        Route::delete('raktaros/termekTorles/{id}', [TermekController::class, 'destroy']);
        Route::delete('raktaros/modellTorles/{id}', [ModellController::class, 'destroy']);
    });
