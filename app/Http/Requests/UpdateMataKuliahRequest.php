<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMataKuliahRequest extends FormRequest
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
            'dosen' => 'required',
            'deskripsi' => 'required',
            'bahan_kajian' => 'required',
            'daftar_pustaka_utama' => 'required',
            'daftar_pustaka_pendukung' => 'required',
        ];
    }
}
