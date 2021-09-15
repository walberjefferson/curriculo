<?php

namespace App\Http\Requests;

use App\Models\Escolaridade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculoRequest extends FormRequest
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
//        $id = $this->route('escolaridade');
//        if ($id) {
//            $escolaridade = Escolaridade::query()->firstWhere('uuid', $id);
//            $id = $escolaridade->id;
//
//        }
        return [
//            'codigo' => "nullable|max:4|unique:escolaridade,id,{$id}",
            'nome' => 'required|string|max:180',
            'data_nascimento' => 'required|date',
            'sexo_id' => 'required',
            'cpf' => ['required', Rule::unique('pessoa', 'cpf')],
            'cnh' => 'required',
            'categoria_cnh' => 'nullable',
            'pcd' => 'nullable',
            'telefone' => 'required',
            'whatsapp' => 'nullable',
            'endereco' => 'required',
            'endereco_numero' => 'nullable',
            'complemento' => 'nullable',
            'ponto_referencia' => 'nullable',
            'instagram' => 'nullable',
            'outras_informacoes' => 'nullable',
            'foto' => 'nullable|image',
            'outra_habilidade' => '',
            'filhos' => 'required',
            'filhos_quantidade' => 'nullable',
            'escolaridade_id' => 'required',
            'estado_id' => 'required',
            'cidade_id' => 'required',
            'estado_civil_id' => 'required',
            'experiencias' => 'nullable|array',
            'habilidades' => 'nullable|array'
        ];
    }

    public function all($keys = null)
    {
        $all = parent::all($keys);
        if (isset($all['cpf'])) {
            $all['cpf'] = str_numbers($all['cpf']);
        }
        return $all;
    }
}
