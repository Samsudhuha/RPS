<?php

namespace App\Http\Requests\Taksonomi;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaksonomiRequest extends FormRequest
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
            'role' => 'required',
            'name' => 'required|unique:taksonomis,name'
        ];
    }
}
