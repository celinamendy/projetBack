<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
    //return $request->user();
//})->middleware('auth:sanctum');


use App\Http\Controllers\AvisController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ConducteurController;
use App\Http\Controllers\ReservationController;

// Routes pour l'enregistrement, la connexion, et la gestion des tokens
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/logout', [ApiController::class, 'logout']);
Route::post('/refresh-token', [ApiController::class, 'refreshToken']);

// Routes protégées par authentification
Route::middleware('auth:api')->group(function () {
    // Routes pour Conducteurs

    // Routes pour Trajets
    Route::apiResource('trajets', TrajetController::class);

    // Routes pour Vehicules
    Route::apiResource('vehicules', VehiculeController::class);

    // Routes pour les réservations
    Route::apiResource('reservations', ReservationController::class);

    // Routes pour les avis
    Route::apiResource('avis', AvisController::class);
});


Route::apiResource('conducteurs', ConducteurController::class);


// naboo-e7c1f9e5-cc15-4bbf-ac0b-1fde5c9f5915.c9c82539-fbd5-45e0-b4c0-bcd93998fbb2
