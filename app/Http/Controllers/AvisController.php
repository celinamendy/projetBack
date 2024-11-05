<?php
namespace App\Http\Controllers;

use App\Models\Avis;
use App\Http\Requests\StoreAvisRequest;
use App\Http\Requests\UpdateAvisRequest;

class AvisController extends Controller
{
    public function index()
    {
        $avis = Avis::all();
        return $this->customJsonResponse("Liste des avis récupérée avec succès", $avis, 200);
    }

    public function getAvis($trajetId)
    {
        $avis = Avis::where('trajet_id', $trajetId)->get();
        return $this->customJsonResponse("Avis récupérés avec succès", $avis, 200);
    }

    public function store(StoreAvisRequest $request)
    {
        $avis = new Avis();
        $avis->user_id = $request->user_id;
        $avis->trajet_id = $request->trajet_id;
        $avis->note = $request->note; // Peut être "pour", "contre" ou null
        $avis->commentaire = $request->commentaire; // Peut être null
        $avis->save();

        return $this->customJsonResponse("Avis créé avec succès", $avis, 201);
    }

    public function update(UpdateAvisRequest $request, $id)
    {
        $avis = Avis::find($id);

        if (!$avis) {
            return $this->customJsonResponse("Avis non trouvé", null, 404);
        }

        $avis->fill($request->validated());
        $avis->save();

        return $this->customJsonResponse("Avis mis à jour avec succès", $avis, 200);
    }

    public function updateNote(UpdateAvisRequest $request, $avisId)
    {
        $avis = Avis::find($avisId);
        if ($avis) {
            $avis->note = $request->input('note');
            $avis->save();
            return $this->customJsonResponse("Note mise à jour avec succès", $avis, 200);
        }
        return $this->customJsonResponse("Avis introuvable", null, 404);
    }

    public function ajoutPour(StoreAvisRequest $request)
    {
        $avis = new Avis();
        $avis->user_id = $request->user_id;
        $avis->trajet_id = $request->trajet_id;
        $avis->note = 'pour';
        $avis->commentaire = $request->commentaire;
        $avis->save();

        return $this->customJsonResponse("Avis 'pour' ajouté avec succès", $avis, 201);
    }

    public function ajoutContre(StoreAvisRequest $request)
    {
        $avis = new Avis();
        $avis->user_id = $request->user_id;
        $avis->trajet_id = $request->trajet_id;
        $avis->note = 'contre';
        $avis->commentaire = $request->commentaire;
        $avis->save();

        return $this->customJsonResponse("Avis 'contre' ajouté avec succès", $avis, 201);
    }

    // public function getNotes($trajetId)
    // {
    //     $avis = Avis::where('trajet_id', $trajetId)->get();
    //     return $this->customJsonResponse("Avis récupérés avec succès", $avis, 200);
    // }

    public function getNotes($trajetId)
{
    $avis = Avis::where('trajet_id', $trajetId)->get();
    return response()->json(['status' => true, 'message' => 'Avis récupérés avec succès', 'data' => $avis]);
}

    public function destroy($id)
    {
        $avis = Avis::find($id);

        if (!$avis) {
            return $this->customJsonResponse("Avis non trouvé", null, 404);
        }

        $avis->delete();
        return $this->customJsonResponse("Avis supprimé avec succès", null, 200);
    }

    protected function customJsonResponse($message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
