<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EscolaridadeRequest;
use App\Contracts\Repositories\PessoaRepository;

class CurriculoController extends Controller
{
    private $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dados = $this->repository->orderBy('nome')->paginate();
        return view('admin.pessoa.index', compact('dados'));
    }

    public function create()
    {
        return view('admin.pessoa.create');
    }

    public function store(EscolaridadeRequest $request)
    {
        try {
            \DB::beginTransaction();
            $this->repository->create($request->validated());
            \DB::commit();
            return redirect()->route('admin.curriculo.index')->with('message', 'Escolaridade adicionado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar cadastrar pessoa.');
        }
    }

    public function edit($uuid)
    {
        $dados = $this->repository->findByField('uuid', $uuid)->first();
        return view('admin.pessoa.edit', compact('dados'));
    }

    public function update(EscolaridadeRequest $request, $uuid)
    {
        try {
            \DB::beginTransaction();
            $info = $this->repository->findByField('uuid', $uuid)->first();
            $this->repository->update($request->validated(), $info->id);
            \DB::commit();
            return redirect()->route('admin.curriculo.index')->with('message', 'Escolaridade atualizado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar pessoa.');
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
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir pessoa.');
        }
    }
}
