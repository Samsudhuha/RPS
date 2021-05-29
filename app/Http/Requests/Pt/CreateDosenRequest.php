<?php

namespace App\Http\Requests\Pt;

use Illuminate\Foundation\Http\FormRequest;

class CreateDosenRequest extends FormRequest
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
            'jurusan' => 'required',
            'fakultas' => 'required',
            'rmk' => 'required',
            'dosen' => 'required|unique:dosens,id',
            'program_studi' => 'required',
        ];
    }
}
