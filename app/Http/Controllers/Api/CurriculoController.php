<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\PessoaRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoRequest;
use App\Http\Resources\CurriculoResource;
use App\Models\Pessoa;

class CurriculoController extends Controller
{
    private $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
    public function store(CurriculoRequest $request)
    {
        try {
            \DB::beginTransaction();
            $dados = $this->repository->create($request->validated());
            \DB::commit();
            return response()->json(['data' => $dados, 'message' => 'Currículo adicionado com sucesso', 'redirect' => route('admin.curriculo.index'), 'error' => false]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar cadastrar currículo. - ' . $e->getMessage(), 'error' => true], 500);
        }
    }

    public function show(Pessoa $dados)
    {
        $dados->load(['experiencias', 'habilidades']);
        return CurriculoResource::make($dados);
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
    public function update(CurriculoRequest $request, Pessoa $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->update($request->validated(), $dados->id);
            $dados->refresh();
            \DB::commit();
            return response()->json(['data' => $dados, 'message' => 'Currículo atualizado com sucesso', 'redirect' => route('admin.curriculo.index'), 'error' => false]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar atualizar currículo. - ' . $e->getMessage(), 'error' => true], 500);
        }
    }
}
