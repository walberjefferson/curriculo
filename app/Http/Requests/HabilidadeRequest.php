<?php

namespace App\Http\Requests;

use App\Models\Habilidade;
use Illuminate\Foundation\Http\FormRequest;

class HabilidadeRequest extends FormRequest
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
        $id = $this->route('dados');
        if ($id) {
            $habilidade = Habilidade::query()->firstWhere('uuid', $id);
            $id = $habilidade->id;

        }
        return [
            'nome' => 'required|max:90',
            'codigo' => "nullable|max:4|unique:habilidade,id,{$id}"
        ];
    }
}
