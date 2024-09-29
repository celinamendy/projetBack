<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Http\Requests\StoreVehiculesRequest;
use App\Http\Requests\UpdateVehiculesRequest;

class VehiculesController extends Controller
{
    /**
     * Afficher la liste des véhicules.
     */
    public function index()
    {
        $vehicules = Vehicule::all();

        return response()->json([
            'status' => true,
            'message' => 'Liste des véhicules récupérée avec succès',
            'data' => $vehicules
        ], 200);
    }

    /**
     * Créer un nouveau véhicule.
     */
    public function store(StoreVehiculesRequest $request) // Utiliser StoreVehiculeRequest pour la validation
    {
        $vehicule = Vehicule::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Véhicule créé avec succès',
            'data' => $vehicule
        ], 201);
    }

    /**
     * Afficher les détails d'un véhicule spécifique.
     */
    public function show($id)
    {
        $vehicule = Vehicule::find($id);

        if (!$vehicule) {
            return response()->json([
                'status' => false,
                'message' => 'Véhicule non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Détails du véhicule récupérés avec succès',
            'data' => $vehicule
        ], 200);
    }

    /**
     * Mettre à jour un véhicule spécifique.
     */
    public function update(UpdateVehiculesRequest $request, $id) // Utiliser UpdateVehiculeRequest pour la validation
    {
        $vehicule = Vehicule::find($id);

        if (!$vehicule) {
            return response()->json([
                'status' => false,
                'message' => 'Véhicule non trouvé',
            ], 404);
        }

        // Mise à jour des informations
        $vehicule->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Véhicule mis à jour avec succès',
            'data' => $vehicule
        ], 200);
    }

    /**
     * Supprimer un véhicule spécifique.
     */
    public function destroy($id)
    {
        $vehicule = Vehicule::find($id);

        if (!$vehicule) {
            return response()->json([
                'status' => false,
                'message' => 'Véhicule non trouvé',
            ], 404);
        }

        $vehicule->delete();

        return response()->json([
            'status' => true,
            'message' => 'Véhicule supprimé avec succès',
        ], 200);
    }
}
