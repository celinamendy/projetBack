<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Passager;
use Illuminate\Http\Request;

class PassagersController extends Controller
{
    /**
     * Afficher une liste des passagers.
     */
    public function index()
    {
        $passagers = Passager::all();
        return response()->json([
            'status' => true,
            'message' => 'La liste des passagers',
            'data' => $passagers
        ]);
    }

    /**
     * Enregistrer un passager nouvellement créé dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'adresse' => 'required|string', 
            'telephone' => 'required|string', 

        ]);

        // Création d'un utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Création d'un passager associé
        $passager = Passager::create([
            'user_id' => $user->id,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Passager créé avec succès',
            'data' => $passager
        ], 201);
    }

    /**
     * Afficher les détails d'un passager spécifié.
     */
    public function show(Passager $passager)
    {
        return response()->json([
            'status' => true,
            'message' => 'Détails du passager récupérés avec succès',
            'data' => $passager
        ]);
    }

    /**
     * Mettre à jour les informations d'un passager spécifique.
     */
    public function update(Request $request, $id)
{
    // Trouver le passager par ID
    $passager = Passager::find($id);

    // Vérifier si le passager existe
    if (!$passager) {
        return response()->json([
            'status' => false,
            'message' => 'Passager non trouvé'
        ], 404);
    }

    // Validation des données pour le passager et l'utilisateur
    $request->validate([
        'adresse' => 'sometimes|string',
        'telephone' => 'sometimes|string',
        'nom' => 'sometimes|string|max:255',
        'prenom' => 'sometimes|string|max:255',
        'email' => 'sometimes|string|email|max:255|unique:users,email,' . $passager->user->id,
        'password' => 'nullable|string|min:8',
    ]);

    // Mettre à jour les informations du passager
    $passager->update([
        'adresse' => $request->input('adresse', $passager->adresse),
        'telephone' => $request->input('telephone', $passager->telephone),
    ]);

    // Charger les informations de l'utilisateur associé
    $user = $passager->user;

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Mettre à jour les informations de l'utilisateur
        $user->nom = $request->input('nom', $user->nom);
        $user->prenom = $request->input('prenom', $user->prenom);
        $user->email = $request->input('email', $user->email);

        // Mettre à jour le mot de passe uniquement s'il est fourni
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Sauvegarder les modifications de l'utilisateur
        $user->save();
    }

    return response()->json([
        'status' => true,
        'message' => 'Informations du passager et de l\'utilisateur mises à jour avec succès',
        'data' => [
            'passager' => $passager,
            'user' => $user
        ]
    ]);
}

    /**
     * Mettre à jour les informations d'un utilisateur spécifique.
     */
    private function updateUser(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Utilisateur non trouvé'
        ], 404);
    }

    // Valider les données soumises
    $request->validate([
        'nom' => 'sometimes|string|max:255',
        'prenom' => 'sometimes|string|max:255',
        'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
    ]);

    // Conserver les valeurs existantes si elles ne sont pas fournies
    $user->nom = $request->input('nom', $user->nom);
    $user->prenom = $request->input('prenom', $user->prenom);
    $user->email = $request->input('email', $user->email);

    // Mise à jour du mot de passe uniquement s'il est fourni
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'Informations de l\'utilisateur mises à jour avec succès',
        'data' => $user
    ]);
    }

    /**
     * Supprimer un passager spécifié de la base de données.
     */
    public function destroy(Passager $passager)
    {
        $user = $passager->user;

        if ($user) {
            $user->delete();
        }

        $passager->delete();

        return response()->json([
            'status' => true,
            'message' => 'Passager supprimé avec succès',
        ]);
    }
}
