<?php

// app/Http/Controllers/PassagerController.php

namespace App\Http\Controllers;

use App\Models\Passager;
use Illuminate\Http\Request;

class PassagerController extends Controller
{
    public function index()
    {
        $passagers = Passager::all();
        return response()->json($passagers);
    }

    public function show($id)
    {
        $passager = Passager::find($id);
        if (!$passager) {
            return response()->json(['message' => 'Passager not found'], 404);
        }
        return response()->json($passager);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
        ]);

        $passager = Passager::create($request->all());
        return response()->json($passager, 201);
    }

    public function update(Request $request, $id)
    {
        $passager = Passager::find($id);
        if (!$passager) {
            return response()->json(['message' => 'Passager not found'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'adresse' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
        ]);

        $passager->update($request->all());
        return response()->json($passager);
    }

    public function destroy($id)
    {
        $passager = Passager::find($id);
        if (!$passager) {
            return response()->json(['message' => 'Passager not found'], 404);
        }
        $passager->delete();
        return response()->json(['message' => 'Passager deleted successfully']);
    }
}

