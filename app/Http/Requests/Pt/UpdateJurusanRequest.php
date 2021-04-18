<?php

namespace App\Http\Requests\Pt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJurusanRequest extends FormRequest
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
            'fakultas' => 'required',
            'jurusan' => [
                "required",
                "string",
                Rule::unique('jurusans', 'name')
                    ->ignore($this->route('id'), 'id'),
            ],
        ];
    }
}