<?php
namespace App\Http\Controllers;

use App\Models\Avis;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreAvisRequest;
use App\Http\Requests\UpdateAvisRequest;


class AvisController extends Controller
{
    public function index()
    {
        $avis = Avis::all();
        return $this->customJsonResponse("Liste des avis récupérée avec succès", $avis, 200);
    }


    public function store(StoreAvisRequest $request)
    {
        $avis = new Avis();
        $avis->fill($request->validated());
        $avis->save();

        return $this->customJsonResponse("Avis créé avec succès", $avis, 201);
    }

    protected function customJsonResponse($message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function update(UpdateAvisRequest $request, $id)
    {
        $avis = Avis::find($id);

        if (!$avis) {
            return response()->json([
                'status' => false,
                'message' => 'Avis non trouvé',
            ], 404);
        }

        $avis->fill($request->validated());
        $avis->save();

        return $this->customJsonResponse("Avis mis à jour avec succès", $avis, 200);
    }

    public function destroy($id)
    {
        $avis = Avis::find($id);

        if (!$avis) {
            return response()->json([
                'status' => false,
                'message' => 'Avis non trouvé',
            ], 404);
        }

        $avis->delete();

        return $this->customJsonResponse("Avis supprimé avec succès", null, 200);
    }


}
