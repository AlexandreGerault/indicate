<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyDiagnosticRequest extends FormRequest
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
        $rules = ['needs' => 'required|array'];

        $comments = array_filter($this->request->all(), fn($elt) => preg_match('#^comment-[0-9]+$#', $elt),  ARRAY_FILTER_USE_KEY);

        foreach ($comments as $key => $value)
        {
            $rules[$key] = 'nullable|string';
        }

        return $rules;
    }
}
