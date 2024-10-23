<?php
namespace App\Http\Controllers;

use App\Models\Passager;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Trait\AvisNotification;

class ReservationsController extends Controller
{
    use AvisNotification;

    /**
     * Afficher la liste des réservations.
     */
    public function index()
    {
        $reservations = Reservation::with('trajet')->get(); // Charger les trajets avec les réservations

        return response()->json([
            'status' => true,
            'message' => 'Liste des réservations récupérée avec succès',
            'data' => $reservations
        ], 200);
    }

    /**
     * Récupérer les réservations d'un passager par son ID.
     */
    public function getReservationsByPassagerId($id)
    {
        try {
            // Récupérer l'ID de l'utilisateur authentifié
            $userIdauthenticated = auth()->user()->id;

            // Rechercher le passager lié à cet utilisateur
            $passager = Passager::where('user_id', $userIdauthenticated)->first();

            // Vérifier si un passager a été trouvé
            if (!$passager) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucun passager trouvé pour cet utilisateur',
                ], 404);
            }

            // Récupérer les réservations associées au passager avec les trajets
            // $reservations = Reservation::where('user_id', $passager->user_id)->with('trajet')->get();
            $reservations = Reservation::where('user_id', $id)->with('trajet')->get();
            // Vérifier si des réservations existent
            if ($reservations->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Aucune réservation trouvée pour ce passager',
                ], 404);
            }

            // Répondre avec succès et renvoyer les réservations et trajets
            return response()->json([
                'status' => true,
                'message' => 'Réservations récupérées avec succès',
                'data' => $reservations
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la récupération des réservations',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Créer une nouvelle réservation.
     */
    public function store(Request $request)
    {
        try {
            // Création de la réservation avec les données fournies
            $reservation = Reservation::create($request->all());

            // Récupérer le trajet associé à cette réservation
            $trajet = $reservation->trajet;

            // Récupérer le conducteur à partir du trajet
            $conducteur = $trajet ? $trajet->conducteur : null; // Vérifie si le trajet existe

            // Envoyer une notification au conducteur, si existant
            if ($conducteur) {
                $this->sendNotification($conducteur->user, 'Nouvelle réservation pour votre véhicule');
            } else {
                // Gérer le cas où le conducteur est null
                return response()->json([
                    'status' => false,
                    'message' => 'Conducteur non trouvé pour cette réservation.',
                ], 404);
            }

            // Récupérer le passager à partir de l'utilisateur
            $passager = $reservation->user; // On suppose que l'utilisateur qui fait la réservation est le passager

            // Envoyer une notification au passager
            $this->sendNotification($passager, 'Votre réservation a été confirmée');

            return response()->json([
                'status' => true,
                'message' => 'Réservation créée avec succès',
                'data' => $reservation
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de la réservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupérer une réservation spécifique.
     */
    public function show($id)
    {
        $reservation = Reservation::with('trajet')->find($id); // Charger le trajet avec la réservation
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }
        return response()->json($reservation);
    }

    /**
     * Mettre à jour une réservation spécifique.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Réservation non trouvée',
            ], 404);
        }

        // Validation des données
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'trajet_id' => 'sometimes|required|exists:trajets,id',
            'date_heure_reservation' => 'sometimes|required|date',
            'statut' => 'sometimes|required|string|max:255',
        ]);

        // Mise à jour des informations
        $reservation->update($request->only([
            'user_id', 'trajet_id', 'date_heure_reservation', 'statut'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Réservation mise à jour avec succès',
            'data' => $reservation
        ], 200);
    }
//Fonction pour confirmer
    // public function confirmer(Request $request, $id)
    // {
    //     $reservation = Reservation::find($id);

    //     if (!$reservation) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Réservation non trouvée',
    //         ], 404);
    //     }

    //     // Validation des données
    //     $request->validate([
    //         'trajet_id' => 'sometimes|required|exists:trajets,id',
    //         'statut' => 'sometimes|required|string|max:255',
    //     ]);

    //     // Mise à jour des informations
    //     $reservation->update($request->only([
    //          'trajet_id',
    //          'statut'=>'confirmer'
    //     ]));

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Réservation mise à jour avec succès',
    //         'data' => $reservation
    //     ], 200);
    // }

    /**
     * Supprimer une réservation spécifique.
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Réservation non trouvée',
            ], 404);
        }

        $reservation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Réservation supprimée avec succès',
        ], 200);
    }
}
