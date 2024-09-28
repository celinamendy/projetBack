<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;  // Assure-toi que tu importes bien le Controller de base




class ApiController extends Controller
{
    /**
     * Authentification de l'utilisateur avec email et mot de passe.
     */
    public function login(Request $request)
    {
        // Validation des données
        $validator = validator($request->all(), [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé',
            ], 404); // User not found
        }

        // Vérifier si le mot de passe est correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Mot de passe incorrect',
            ], 401); // Incorrect password
        }

        // Authentification réussie, générer le token
        $token = auth()->guard('api')->login($user);

        // Obtenir les rôles de l'utilisateur
        $roles = $user->getRoleNames();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'roles' => $roles,
            'user' => $user,
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60, // Expiration en secondes
        ]);
    }
    /**
     * Enregistrer un nouvel utilisateur et retourner un token JWT.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json($user,201);
    }

    /**
     * Déconnecter l'utilisateur en révoquant le token JWT.
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    /**
     * Rafraîchir le token JWT.
     */
    public function refresh()
    {
        try {
            $token = auth()->refresh();
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => auth()->user(),
                'expires_in' => env('JWT_TTL') * 60 . ' seconds'
            ]);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Impossible de rafraîchir le token'], 500);
        }
    }
}



