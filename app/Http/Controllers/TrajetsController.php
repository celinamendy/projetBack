<?php

namespace App\Http\Controllers;

use App\Models\Conducteur;
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
        $trajets = Trajet::with('conducteur')->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des trajets récupérée avec succès',
            'data' => $trajets
        ], 200);
    }

//     /**
//      * Créer un nouveau trajet.
//      */
//     public function store(Request $request)
// {
//     try {
//         // Validation des données entrantes
//         $validatedData = $request->validate([
//             'conducteur_id' => 'required|exists:conducteurs,id',
//             'point_depart' => 'required|string|max:255',
//             'point_arrivee' => 'required|string|max:255',
//             'date_heure_depart' => 'required|date_format:Y-m-d\TH:i',
//             'vehicule_id' => 'required|exists:vehicules,id',
//             'prix' => 'required|numeric',
//             'nombre_places' => 'required|numeric',
//         ]);


//     } catch (\Illuminate\Validation\ValidationException $e) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Validation échouée',
//             'errors' => $e->errors()
//         ], 422);
//     }

//     // Création du trajet
//     $trajet = Trajet::create($validatedData);

//     return response()->json([
//         'status' => true,
//         'message' => 'Trajet créé avec succès',
//         'data' => $trajet
//     ], 201);
// }

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
        $trajet = Trajet::find($id)->load(['conducteur.user', 'reservations.user', 'avis.user'] );

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
            'point_depart' => 'sometimes|required|string|max:255',
            'point_arrivee' => 'sometimes|required|string|max:255',
            'date_depart' => 'sometimes|required|date_format:Y-m-d',
            'heure_depart' => 'sometimes|required|date_format:H:i',
            'statut' => 'sometimes|required|in:en cours,terminer,annuler,confirmer',
            'vehicule_id' => 'sometimes|required|exists:vehicules,id',
            'prix' => 'sometimes|required|numeric',
            'nombre_places'=> 'sometimes|required|numeric',
        ]);



        // Mise à jour des informations
        $trajet->update($request->only([
            'conducteur_id',
            'point_depart',
            'point_arrivee',
            'date_depart',
            'heure_depart',
            'statut',
            'vehicule_id',
            'prix',
            'nombre_places'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Trajet mis à jour avec succès',
            'data' => $trajet
        ], 200);
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

public function verifierStatutTrajet($trajetId)
{
    $trajet = Trajet::find($trajetId);

    if (!$trajet) {
        return response()->json(['message' => 'Trajet non trouvé'], 404);
    }

    $nombreReservations = $trajet->reservations()->count();
    $nombrePlaces = $trajet->places;

    // Vérifier si le nombre de réservations correspond au nombre de places
    if ($nombreReservations >= $nombrePlaces) {
        $trajet->statut = 'terminé';
    } else {
        $trajet->statut = 'en cours';
    }

    $trajet->save();

    return response()->json([
        'message' => 'Statut mis à jour',
        'statut' => $trajet->statut
    ]);
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
