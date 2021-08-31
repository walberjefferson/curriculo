<?php

namespace App\Http\Requests;

use App\Models\Escolaridade;
use App\Models\EstadoCivil;
use Illuminate\Foundation\Http\FormRequest;

class EstadoCivilRequest extends FormRequest
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
        $id = $this->route('estado_civil');
        if ($id) {
            $estadoCivil = EstadoCivil::query()->firstWhere('uuid', $id);
            $id = $estadoCivil->id;

        }
        return [
            'nome' => 'required|max:90',
            'codigo' => "nullable|max:4|unique:estado_civil,id,{$id}"
        ];
    }
}
