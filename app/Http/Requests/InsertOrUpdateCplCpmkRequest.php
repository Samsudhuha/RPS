<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertOrUpdateCplCpmkRequest extends FormRequest
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
            'cpl' => 'required',
            'cpmk1' => 'required',
            'cpmk2' => 'required',
            'cpmk3' => 'required',
            'cpmk4' => 'required',
        ];
    }
}
