<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\HabilidadeRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\HabilidadeRequest;
use App\Models\Habilidade;

class HabilidadeController extends Controller
{
    private $repository;

    public function __construct(HabilidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dados = $this->repository->orderBy('codigo')->orderBy('nome')->paginate();
        return view('admin.habilidade.index', compact('dados'));
    }

    public function create()
    {
        return view('admin.habilidade.create');
    }

    public function store(HabilidadeRequest $request)
    {
        try {
            \DB::beginTransaction();
            $this->repository->create($request->validated());
            \DB::commit();
            return redirect()->route('admin.habilidade.index')->with('message', 'Habilidade adicionada com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar cadastrar habilidade.');
        }
    }

    public function edit(Habilidade $dados)
    {
        return view('admin.habilidade.edit', compact('dados'));
    }

    public function update(HabilidadeRequest $request, Habilidade $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->update($request->validated(), $dados->id);
            \DB::commit();
            return redirect()->route('admin.habilidade.index')->with('message', 'Habilidade atualizada com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar habilidade.');
        }
    }

    public function destroy(Habilidade $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->delete($dados->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Habilidade removida com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir habilidade.');
        }
    }
}
