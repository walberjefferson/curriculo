<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurriculoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'data_nascimento' => $this->data_nascimento,
            'sexo_id' => $this->sexo_id,
            'cpf' => $this->cpf,
            'cnh' => $this->cnh,
            'categoria_cnh' => $this->categoria_cnh,
            'pcd' => $this->pcd,
            'telefone' => $this->telefone,
            'whatsapp' => $this->whatsapp,
            'endereco' => $this->endereco,
            'endereco_numero' => $this->endereco_numero,
            'complemento' => $this->complemento,
            'ponto_referencia' => $this->ponto_referencia,
            'instagram' => $this->instagram,
            'outras_informacoes' => $this->outras_informacoes,
            'foto' => $this->foto ? 'data:image/jpg;base64,' . $this->foto_base64 : null,
            'ativo' => $this->ativo,
            'outra_habilidade' => $this->outra_habilidade,
            'filhos' => $this->filhos,
            'filhos_quantidade' => $this->filhos_quantidade,
            'escolaridade_id' => $this->escolaridade_id,
            'estado_id' => $this->estado_id,
            'cidade_id' => $this->cidade_id,
            'estado_civil_id' => $this->estado_civil_id,
            'experiencias' => $this->whenLoaded('experiencias'),
            'habilidades' => $this->whenLoaded('habilidades'),
        ];
    }
}
