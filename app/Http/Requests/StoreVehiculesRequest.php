<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehiculesRequest extends FormRequest
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
        return [
           // 'marque' => 'required|string|max:255',
            //'modele' => 'required|string|max:255',
            //'couleur' => 'required|string|max:255',
            //'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation',
            //'conducteur_id' => 'required|exists:conducteurs,id',
            //'nombre_place' => 'required|integer',
            //'assurance_vehicule' => 'required|string|max:255',
            //'photo' => 'nullable|string'
        ];
    }
}
