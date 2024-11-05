<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'trajet_id' => 'required|exists:trajets,id',
            'commentaire' => 'nullable|string|max:500', // Le commentaire est optionnel
            'note' => 'nullable|in:pour,contre',        // La note est optionnelle et de type enum
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->input('note')) && empty($this->input('commentaire'))) {
                $validator->errors()->add('note', 'Vous devez fournir soit un commentaire, soit une note.');
            }
        });
    }
}
