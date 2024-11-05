<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
use App\Models\Trajet;
use Illuminate\Http\Request;



class TrajetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trajets = Trajet::with('conducteur')->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des trajets récupérée avec succès',
            'data' => $trajets
        ], 200);
    }



public function store(Request $request)
    {
        try {

            // Création du trajet
            $trajet = Trajet::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Trajet créé avec succès',
                'data' => $trajet
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création du trajet',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Afficher les détails d'un trajet spécifique.
     */
    public function show($id)
    {
        $trajet = Trajet::find($id)->load(['conducteur.user','conducteur.vehicules', 'reservations.user.passager', 'avis.user'] );

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
    public function update(Request $request, $id)
    {
        // Récupérer le trajet par son ID
        $trajet = Trajet::find($id);

        if (!$trajet) {
            return response()->json([
                'message' => 'Trajet non trouvé.',
                'status' => 404
            ]);
        }

        // Valider les données reçues
        try {
            $validatedData = $request->validate([
                'point_depart' => 'nullable|string|max:255',
                'conducteur_id' => 'nullable|integer',
                'point_arrivee' => 'nullable|string|max:255',
                'date_depart' => 'nullable|date_format:Y-m-d',
                'heure_depart' => 'nullable|date_format:H:i',
                'statut' => 'nullable|string',
                'vehicule_id' => 'nullable|integer',
                'prix' => 'nullable|numeric'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
                'message' => 'Validation échouée'
            ], 422);
        }


        // Mettre à jour le trajet avec les nouvelles données validées
        $trajet->update($validatedData);

        return response()->json([
            'message' => 'Trajet modifié avec succès.',
            'données' => $trajet,
            'status' => 200
        ]);
    }






//METHODE DE CONFIRMATION DE RESERVATION
    public function confirmer(Request $request, $id)
{
    $trajet = Trajet::find($id);

    if (!$trajet) {
        return response()->json([
            'status' => false,
            'message' => 'Trajet non trouvé',
        ], 404);
    }

    // Validation des données
    // $request->validate([
    //     'statut' => 'sometimes|required|in:confirmer',
    // ]);

    // Mise à jour des informations
    $trajet->statut = 'confirmer';
    $trajet->save();

    // Assurez-vous que la réponse JSON est correctement renvoyée
    return response()->json([
        'status' => true,
        'message' => 'Trajet mis à jour avec succès',
        'data' => $trajet
    ], 200);
}
//methode pour verifier les statut de la trajet
// TrajetController.php





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
