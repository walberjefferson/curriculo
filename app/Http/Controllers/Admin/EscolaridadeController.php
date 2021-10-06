<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EscolaridadeRequest;
use App\Contracts\Repositories\EscolaridadeRepository;
use App\Models\Escolaridade;

class EscolaridadeController extends Controller
{
    private $repository;

    public function __construct(EscolaridadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dados = $this->repository->orderBy('codigo')->orderBy('nome')->paginate();
        return view('admin.escolaridade.index', compact('dados'));
    }

    public function create()
    {
        return view('admin.escolaridade.create');
    }

    public function store(EscolaridadeRequest $request)
    {
        try {
            \DB::beginTransaction();
            $this->repository->create($request->validated());
            \DB::commit();
            return redirect()->route('admin.escolaridade.index')->with('message', 'Escolaridade adicionado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar cadastrar escolaridade.');
        }
    }

    public function edit(Escolaridade $dados)
    {
        return view('admin.escolaridade.edit', compact('dados'));
    }

    public function update(EscolaridadeRequest $request, Escolaridade $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->update($request->validated(), $dados->id);
            \DB::commit();
            return redirect()->route('admin.escolaridade.index')->with('message', 'Escolaridade atualizado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar escolaridade.');
        }
    }

    public function destroy(Escolaridade $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->delete($dados->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Escolaridade removido com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir escolaridade.');
        }
    }
}
