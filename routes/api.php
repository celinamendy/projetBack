<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
    //return $request->user();
//})->middleware('auth:sanctum');


use App\Http\Controllers\AvisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\TrajetsController;
use App\Http\Controllers\PassagersController;
use App\Http\Controllers\VehiculesController;
use App\Http\Controllers\ConducteursController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\NotificationsController;
use App\Models\Conducteur;

// Routes pour l'enregistrement, la connexion, et la gestion des tokens
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/logout', [ApiController::class, 'logout']);
Route::post('/refresh-token', [ApiController::class, 'refreshToken']);


   // Routes pour Trajets
   Route::post('/trajets1{id}', [TrajetsController::class, 'update']);
   Route::put('trajets/confirmer/{id}', [TrajetsController::class, 'confirmer']);
   Route::apiResource('trajets', TrajetsController::class);

//    Route::put ('/trajets{id}', [TrajetsController::class,'update']);

// Routes protégées par authentification
Route::middleware('auth:api')->group(function () {
    // Routes pour Conducteurs



    // Routes pour Vehicules
    Route::apiResource('vehicules', VehiculesController::class);

    // Routes pour les réservations
    // Route::put('/trajets/{id}/verifier-statut', [TrajetsController::class, 'verifierStatutTrajet']);
    Route::apiResource('reservations', ReservationsController::class);
    Route::middleware('auth:api')->get('/passager/{id}/reservations', [ReservationsController::class, 'getReservationsByPassagerId']);
    Route::post('/reservations/{reservationId}/confirm', [ReservationsController::class, 'confirmReservation']);



    // Routes pour les avis
    Route::apiResource('avis', AvisController::class);
    // Route pour récupérer les avis d'un trajet spécifique
    Route::get('avis/trajet/{trajetId}', [AvisController::class, 'getNotes'])->name('avis.getNotes');

    // Route pour ajouter un avis "pour"
    Route::post('avis/ajout-pour', [AvisController::class, 'ajoutPour'])->name('avis.ajoutPour');

    // Route pour ajouter un avis "contre"
    Route::post('avis/ajout-contre', [AvisController::class, 'ajoutContre'])->name('avis.ajoutContre');

    Route::post('/reservations/avis', [ReservationsController::class, 'addAvis']);

    // Routes pour les notifications
    // Route::apiResource('notification', NotificationsController::class);
    Route::get('/notifications', [NotificationsController::class, 'getUserNotifications']);
    Route::post('/notificationsend', [NotificationsController::class, 'sendNotification']);

    // Routes pour les utilisateurs
    Route::apiResource('user', UserController::class);
    // Routes pour les passagers
    Route::apiResource('passagers', PassagersController::class);
    Route::middleware('auth:api')->get('/passager/user/{userId}', [PassagersController::class, 'getPassagerByUserId']);

    Route::middleware('auth:api')->get('/reservations', [ReservationsController::class, 'index']);
    Route::middleware('auth:api')->get('/details', [UserController::class, 'getUserDetails']);

});
Route::get('getPassagerByUserId/{userId}', [PassagersController::class, 'getPassagerByUserId']);
Route::get('getVehiculesByConducteurId/{id}', [VehiculesController::class, 'getVehiculesByConducteurId'])->middleware('auth:api');

Route::get('getConducteurByUserId', [ConducteursController::class, 'getConducteurByUserId'])->middleware('auth:api');

Route::apiResource('conducteurs', ConducteursController::class);

Route::get('getTrajetByconducteurId/{id}', [ConducteursController::class, 'getTrajetByconducteurId'])->middleware('auth:api');

// Dans routes/api.php


// naboo-e7c1f9e5-cc15-4bbf-ac0b-1fde5c9f5915.c9c82539-fbd5-45e0-b4c0-bcd93998fbb2
