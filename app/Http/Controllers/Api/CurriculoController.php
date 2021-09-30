<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\PessoaRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoRequest;
use App\Http\Resources\CurriculoResource;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CurriculoController extends Controller
{
    private $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CurriculoRequest $request)
    {
        try {
            \DB::beginTransaction();
            $dados = $this->repository->create($request->validated());
            \DB::commit();
            return response()->json(['data' => $dados, 'message' => 'Currículo adicionado com sucesso', 'error' => false]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar cadastrar currículo. - ' . $e->getMessage(), 'error' => true], 500);
        }
    }

    public function show($uuid)
    {
        $dados = $this->repository->with(['experiencias', 'habilidades'])->findWhere(['uuid' => $uuid])->first();
        return CurriculoResource::make($dados);
    }

    public function update(CurriculoRequest $request, $uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $dados = $this->repository->update($request->validated(), $info->id);
            \DB::commit();
            return response()->json(['data' => $dados, 'message' => 'Currículo atualizado com sucesso', 'error' => false]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar atualizar currículo. - ' . $e->getMessage(), 'error' => true], 500);
        }
    }
}
