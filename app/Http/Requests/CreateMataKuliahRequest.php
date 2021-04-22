<?php

namespace App\Http\Requests;

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
            'jurusan' => 'required',
            'rmk' => 'required',
            'mata_kuliah' => 'required',
            'mata_kuliah_syarat' => '',
            'dosen' => 'required',
            'deskripsi' => 'required',
            'bahan_kajian' => 'required',
            'daftar_pustaka_utama' => 'required',
            'daftar_pustaka_pendukung' => 'required',
        ];
    }
}
