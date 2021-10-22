<?php

namespace App\Http\Requests;

use App\Models\Escolaridade;
use App\Models\Pessoa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculoWebRequest extends FormRequest
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
            'nome' => 'required|string|max:180',
            'data_nascimento' => 'required|date',
            'sexo_id' => 'required',
            'cpf' => ['required', 'cpf', Rule::unique('pessoa', 'cpf')],
            'cnh' => 'required|boolean',
            'categoria_cnh' => 'nullable',
            'pcd' => 'required|boolean',
            'telefone' => 'required',
            'whatsapp' => 'nullable',
            'endereco' => 'required',
            'endereco_numero' => 'nullable',
            'complemento' => 'nullable',
            'ponto_referencia' => 'nullable',
            'instagram' => 'nullable',
            'outras_informacoes' => 'nullable',
            'foto' => 'nullable|image',
            'outra_habilidade' => 'nullable|max:120',
            'filhos' => 'required|boolean',
            'lei_lgpd' => 'required|accepted|boolean',
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
        if (isset($all['lei_lgpd'])) {
            $all['lei_lgpd'] = is_bool($all['lei_lgpd']) ? $all['lei_lgpd'] : $all['lei_lgpd'] === 'true';
        }
        if (isset($all['cnh'])) {
            $all['cnh'] = is_bool($all['cnh']) ? $all['cnh'] : $all['cnh'] === 'true';
        }
        if (isset($all['pcd'])) {
            $all['pcd'] = is_bool($all['pcd']) ? $all['pcd'] : $all['pcd'] === 'true';
        }
        if (isset($all['filhos'])) {
            $all['filhos'] = is_bool($all['filhos']) ? $all['filhos'] : $all['filhos'] === 'true';
        }
        return $all;
    }
}
