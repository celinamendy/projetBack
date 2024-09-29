<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Request;
//use App\Http\Requests\StoreTrajetsRequest;
//use App\Http\Requests\UpdateTrajetsRequest;

class TrajetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trajets = Trajet::all();

        return response()->json([
            'status' => true,
            'message' => 'Liste des trajets récupérée avec succès',
            'data' => $trajets
        ], 200);
    }

    /**
     * Créer un nouveau trajet.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données entrantes
            $validatedData = $request->validate([
                'conducteur_id' => 'required|exists:conducteurs,id',
                'point_depart' => 'required|string|max:255',
                'point_arrivee' => 'required|string|max:255',
                'date_heure_depart' => 'required|date_format:Y-m-d H:i:s',
                'statut' => 'required|string',
                'vehicule_id' => 'required|exists:vehicules,id',
                'prix' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation échouée',
                'errors' => $e->errors()
            ], 422);
        }

        // Création du trajet
        $trajet = Trajet::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Trajet créé avec succès',
            'data' => $trajet
        ], 201);
    }

    /**
     * Afficher les détails d'un trajet spécifique.
     */
    public function show($id)
    {
        $trajet = Trajet::find($id);

        if (!$trajet) {
            return response()->json([
                'status' => false,
                'message' => 'Trajet non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Détails du trajet récupérés avec succès',
            'data' => $trajet
        ], 200);
    }

    /**
     * Mettre à jour un trajet spécifique.
     */
    public function update(Request $request, $id)
    {
        $trajet = Trajet::find($id);

        if (!$trajet) {
            return response()->json([
                'status' => false,
                'message' => 'Trajet non trouvé',
            ], 404);
        }

        // Validation des données
        $request->validate([
            'conducteur_id' => 'sometimes|required|exists:conducteurs,id',
            'point_depart' => 'sometimes|required|string',
            'point_arrivee' => 'sometimes|required|string',
            'date_heure_depart' => 'sometimes|required|date',
            'statut' => 'sometimes|required|in:en cours,terminer,annuler,confirmer',
            'vehicule_id' => 'sometimes|required|exists:vehicules,id',
            'prix' => 'sometimes|required|numeric',
        ]);

        // Mise à jour des informations
        $trajet->update($request->only(
            'conducteur_id',
            'point_depart',
            'point_arrivee',
            'date_heure_depart',
            'statut',
            'vehicule_id',
            'prix'
        ));

        return response()->json([
            'status' => true,
            'message' => 'Trajet mis à jour avec succès',
            'data' => $trajet
        ], 200);
    }

    /**
     * Supprimer un trajet spécifique.
     */
    public function destroy($id)
    {
        $trajet = Trajet::find($id);

        if (!$trajet) {
            return response()->json([
                'status' => false,
                'message' => 'Trajet non trouvé',
            ], 404);
        }

        $trajet->delete();

        return response()->json([
            'status' => true,
            'message' => 'Trajet supprimé avec succès',
        ], 200);
    }
}
