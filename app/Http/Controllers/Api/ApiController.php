<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conducteur;
use App\Models\Passager;
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
            'password' => ['required', 'string', 'min:8'],
            'telephone' => ['nullable', 'string', 'max:15'],
            'adresse' => ['nullable', 'string'],
            'type' => ['required'],
            'permis_conduire' => 'nullable|string',
            'CIN' => 'nullable|string',
            'carte_gris' => 'nullable|string',
            'age' => 'required|integer|min:18', // Ex: l'âge minimum pour un conducteur
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

         // Assigner le rôle en fonction du type d'utilisateur
        $role = $request->input('type'); // Le type doit correspondre à un rôle existant
        $user->assignRole($role); // Assurez-vous que les rôles 'passager' et 'conducteur' existent
        if ($role == 'passager') {
            $user_id = $user->id ;
            $passager = Passager::create(['user_id' => $user_id,'telephone'=>$request->input('telephone'),'adresse'=>$request->input('adresse')] );
            return response()->json([$user, $passager ],201);

        }elseif ($role == 'conducteur') {
            $user_id = $user->id ;
            $conducteur = Conducteur::create(['user_id' => $user_id,'permis_conduire'=>$request->input('permis_conduire'),'CIN'=>$request->input('CIN'),'carte_gris'=>$request->input('carte_gris'),'age'=>$request->input('age'),'telephone'=>$request->input('telephone')] );
            return response()->json([$user, $conducteur ],201);

        }


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



