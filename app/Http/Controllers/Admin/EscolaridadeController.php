<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EscolaridadeRequest;
use App\Contracts\Repositories\EscolaridadeRepository;

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

    public function edit($uuid)
    {
        $dados = $this->repository->findByField('uuid', $uuid)->first();
        return view('admin.escolaridade.edit', compact('dados'));
    }

    public function update(EscolaridadeRequest $request, $uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $this->repository->update($request->validated(), $info->id);
            \DB::commit();
            return redirect()->route('admin.escolaridade.index')->with('message', 'Escolaridade atualizado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar escolaridade.');
        }
    }

    public function destroy($uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $this->repository->delete($info->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Escolaridade removido com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir escolaridade.');
        }
    }
}
