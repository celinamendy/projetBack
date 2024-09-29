<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehiculesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // $this->route('vehicule') accède à l'ID du véhicule dans la route
         return [
            'marque' => 'sometimes|required|string|max:255',
            'modele' => 'sometimes|required|string|max:255',
            'couleur' => 'sometimes|required|string|max:255',
            'immatriculation' => 'sometimes|required|string|max:255|unique:vehicules,immatriculation,'.$this->route('vehicule'),
            'conducteur_id' => 'sometimes|required|exists:conducteurs,id',
            'nombre_place' => 'sometimes|required|integer',
            'assurance_vehicule' => 'sometimes|required|string|max:255',
            'photo' => 'sometimes|nullable|string'
        ];
    }
}
