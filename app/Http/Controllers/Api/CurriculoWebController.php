<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\PessoaRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoWebRequest;

class CurriculoWebController extends Controller
{
    private $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CurriculoWebRequest $request)
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
}
