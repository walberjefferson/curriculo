<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\PessoaRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoRequest;
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
        return $this->repository->with(['experiencias', 'habilidades'])->findWhere(['uuid' => $uuid])->first();
    }
}
