<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\HabilidadeRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\HabilidadeRequest;

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

    public function edit($uuid)
    {
        $dados = $this->repository->findByField('uuid', $uuid)->first();
        return view('admin.habilidade.edit', compact('dados'));
    }

    public function update(HabilidadeRequest $request, $uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $this->repository->update($request->validated(), $info->id);
            \DB::commit();
            return redirect()->route('admin.habilidade.index')->with('message', 'Habilidade atualizada com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar habilidade.');
        }
    }

    public function destroy($uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $this->repository->delete($info->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Habilidade removida com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir habilidade.');
        }
    }
}
