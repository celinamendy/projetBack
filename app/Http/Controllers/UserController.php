<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner une réponse JSON
        return response()->json([
            'status' => true,
            'message' => 'Liste des utilisateurs récupérée avec succès',
            'data' => $users
        ], 200);
    }

    /**
     * Afficher les détails d'un utilisateur spécifique.
     */
    public function show($id)
    {
        // Récupérer un utilisateur par son ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        // Retourner les détails de l'utilisateur
        return response()->json([
            'status' => true,
            'message' => 'Détails de l\'utilisateur récupérés avec succès',
            'data' => $user
        ], 200);
    }

    /**
     * Créer un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Valider les données d'entrée
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'nom' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hacher le mot de passe
            
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur créé avec succès',
            'data' => $user
        ], 201);
    }

    /**
     * Mettre à jour un utilisateur spécifique.
     */
    public function update(Request $request, $id)
    {
        // Trouver l'utilisateur à mettre à jour
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        // Valider les données entrantes
        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
        'prenom' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes', 
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        // Mise à jour des informations
        $user->update([
            'nom' => $request->nom ?? $user->nom,  // Utiliser 'nom' au lieu de 'name'
            'prenom' => $request->prenom ?? $user->prenom,  
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur mis à jour avec succès',
            'data' => $user
        ], 200);
    }

    /**
     * Supprimer un utilisateur spécifique.
     */
    public function destroy($id)
    {
        // Trouver l'utilisateur à supprimer
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        // Supprimer l'utilisateur
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur supprimé avec succès',
        ], 200);
    }
}
