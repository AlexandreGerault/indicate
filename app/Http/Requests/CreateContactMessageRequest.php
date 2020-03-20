<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:4000'
        ];
    }

    /**
     * Get the error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vous devez renseignez votre nom.',
            'email.required' => 'Veuillez indiquer une adresse mail pour être contacté en retour.',
            'message.required' => 'Vous devez écrire un message avant de soumettre le formulaire.',
            'message.max' => 'Le message est limité à 4000 caractères.'
        ];
    }
}
