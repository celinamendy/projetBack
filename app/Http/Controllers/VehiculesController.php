<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;

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
    try {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'conducteur_id' => 'nullable|integer|exists:conducteurs,id',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

        // Création du véhicule
//         $vehicules = Vehicule::create($validatedData);

//         return response()->json([
//             'status' => true,
//             'message' => 'Véhicule créé avec succès',
//             'data' => $vehicules
//         ], 201);
//     } catch (\Exception $e) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Erreur lors de la création du véhicule',
//             'error' => $e->getMessage()
//         ], 500);
//     }
// }

        // Gestion de l'upload de l'image
        if ($request->hasFile('photo')) {
            // Enregistrer le fichier et obtenir son chemin
            $imagePath = $request->file('photo')->store('vehicules', 'public');
            $validatedData['photo'] = $imagePath;  // Enregistrer le chemin de l'image dans la DB
        }

        // Création du véhicule avec les données validées
        $vehicule = Vehicule::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Véhicule créé avec succès',
            'data' => $vehicule
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Erreur lors de la création du véhicule',
            'error' => $e->getMessage()
        ], 500);
    }
}




    public function getVehiculesByConducteurId($id)
    {
       $vehicules = Vehicule::where('conducteur_id', $id)->get();

        if ($vehicules->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Aucun véhicule trouvé pour ce conducteur',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Liste des véhicules récupérée avec succès',
            'data' => $vehicules
        ], 200);
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
            'photo' => 'sometimes|nullable|string|max:255'
        ]);

        // Mise à jour des informations
        $vehicule->update($request->only([
            'marque', 'modele', 'couleur', 'immatriculation', 'conducteur_id',  'photo'
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
