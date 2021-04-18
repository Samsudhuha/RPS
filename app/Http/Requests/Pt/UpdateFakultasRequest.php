<?php

namespace App\Http\Requests\Pt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFakultasRequest extends FormRequest
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
            'program_studi' => 'required',
            'fakultas' => [
                "required",
                "string",
                Rule::unique('fakultases', 'name')
                    ->ignore($this->route('id'), 'id'),
            ],
        ];
    }
}