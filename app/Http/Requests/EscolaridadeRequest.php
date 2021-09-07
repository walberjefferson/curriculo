<?php

namespace App\Http\Requests;

use App\Models\Escolaridade;
use Illuminate\Foundation\Http\FormRequest;

class EscolaridadeRequest extends FormRequest
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
        $id = $this->route('escolaridade');
        if ($id) {
            $escolaridade = Escolaridade::query()->firstWhere('uuid', $id);
            $id = $escolaridade->id;

        }
        return [
            'nome' => 'required|max:90',
            'codigo' => "nullable|max:4|unique:escolaridade,id,{$id}"
        ];
    }
}
