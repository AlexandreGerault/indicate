<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConsultingRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'responsible' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'skills' => 'required|array'
        ];

        $specifications = array_filter(
            $this->all(),
            fn($elt) => preg_match('#^specification-[0-9]+$#', $elt),
            ARRAY_FILTER_USE_KEY
        );

        foreach ($specifications as $key => $value) {
            $rules[$key] = 'nullable|string';
        }

        return $rules;
    }
}
