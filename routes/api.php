<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ModellController;
use App\Http\Controllers\TermekController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Raktaros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth:sanctum', Admin::class])
    ->group(function(){
        Route::get('admin/felhasznalo/{id}', [UserController::class, 'show']);
        Route::get('admin/felhasznalok', [UserController::class, 'index']);
        Route::get('admin/termekek', [TermekController::class, 'index']);
        Route::get('modellek', [ModellController::class, 'index']);
        Route::get('admin/termek/{id}', [TermekController::class, 'show']);
        Route::get('admin/modell/{id}', [ModellController::class, 'show']);
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
