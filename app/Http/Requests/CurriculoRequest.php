<?php

namespace App\Http\Requests;

use App\Models\Escolaridade;
use App\Models\Pessoa;
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
        $id = null;
        if ($uuid = $this->route('dados')) {
            if(is_object($uuid)) {
                $id = $uuid->id;
            } else {
                $pessoa = Pessoa::query()->firstWhere('uuid', $uuid);
                $id = $pessoa->id;
            }
        }
        return [
            'nome' => 'required|string|max:180',
            'data_nascimento' => 'required|date',
            'sexo_id' => 'required',
            'cpf' => ['required', Rule::unique('pessoa', 'cpf')->ignore($id)],
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
            'outra_habilidade' => '',
            'filhos' => 'required|boolean',
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
        if (isset($all['cnh'])) {
            $all['cnh'] = (is_bool($all['cnh'])) ? $all['cnh'] : ($all['cnh'] === 'true') ? true : false;
        }
        if (isset($all['pcd'])) {
            $all['pcd'] = (is_bool($all['pcd'])) ? $all['pcd'] : ($all['pcd'] === 'true') ? true : false;
        }
        if (isset($all['filhos'])) {
            $all['filhos'] = (is_bool($all['filhos'])) ? $all['filhos'] : ($all['filhos'] === 'true') ? true : false;
        }
        return $all;
    }
}
