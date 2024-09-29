<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation',
            'conducteur_id' => 'required|exists:conducteurs,id',
            'nombre_place' => 'required|integer',
            'assurance_vehicule' => 'required|string|max:255',
            'photo' => 'nullable|string'
        ]);

        // Création du véhicule avec toutes les données
        $vehicule = Vehicule::create([
            'marque' => $request->marque,
            'modele' => $request->modele,
            'couleur' => $request->couleur,
            'immatriculation' => $request->immatriculation,
            'conducteur_id' => $request->conducteur_id,
            'nombre_place' => $request->nombre_place,
            'assurance_vehicule' => $request->assurance_vehicule,
            'photo' => $request->photo
        ]);

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
    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::find($id);

        if (!$vehicule) {
            return response()->json([
                'status' => false,
                'message' => 'Véhicule non trouvé',
            ], 404);
        }

        // Validation des données
        $request->validate([
            'marque' => 'sometimes|required|string|max:255',
            'modele' => 'sometimes|required|string|max:255',
            'couleur' => 'sometimes|required|string|max:255',
            'immatriculation' => 'sometimes|required|string|max:255|unique:vehicules,immatriculation,'.$id,
            'conducteur_id' => 'sometimes|required|exists:conducteurs,id',
            'nombre_place' => 'sometimes|required|integer',
            'assurance_vehicule' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|nullable|string|max:255'
        ]);

        // Mise à jour des informations
        $vehicule->update($request->only([
            'marque', 'modele', 'couleur', 'immatriculation', 'conducteur_id', 'nombre_place', 'assurance_vehicule', 'photo'
        ]));

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
