<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSilabusRequest extends FormRequest
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
            'tatap_muka' => 'required',
            'kemampuan_akhir' => 'required',
            'keluasan' => 'required',
            'metode_pembelajaran' => 'required',
            'tm' => 'required',
            'pt' => 'required',
            'bm' => 'required',
            'kriteria_penilaian' => 'required',
            'pengamalan' => 'required',
            'bobot' => '',
        ];
    }
}
