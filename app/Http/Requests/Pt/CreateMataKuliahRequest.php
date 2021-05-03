<?php

namespace App\Http\Requests\Pt;

use Illuminate\Foundation\Http\FormRequest;

class CreateMataKuliahRequest extends FormRequest
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
            'fakultas' => 'required',
            'jurusan' => 'required',
            'rmk' => 'required',
            'matakuliah' => 'required|string',
            'kode' => 'required|max:10',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'user' => 'required',
        ];
    }
}
