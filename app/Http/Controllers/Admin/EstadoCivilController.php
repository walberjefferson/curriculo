<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\EstadoCivilRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoCivilRequest;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    private $repository;

    public function __construct(EstadoCivilRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dados = $this->repository->orderBy('codigo')->paginate();
        return view('admin.estado_civil.index', compact('dados'));
    }

    public function create()
    {
        return view('admin.estado_civil.create');
    }

    public function store(EstadoCivilRequest $request)
    {
        try {
            \DB::beginTransaction();
            $this->repository->create($request->validated());
            \DB::commit();
            return redirect()->route('admin.estado_civil.index')->with('message', 'Sexo adicionado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar cadastrar sexo.');
        }
    }

    public function edit(EstadoCivil $dados)
    {
        return view('admin.estado_civil.edit', compact('dados'));
    }

    public function update(EstadoCivilRequest $request, EstadoCivil $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->update($request->validated(), $dados->id);
            \DB::commit();
            return redirect()->route('admin.estado_civil.index')->with('message', 'Sexo atualizado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar sexo.');
        }
    }

    public function destroy(EstadoCivil $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->delete($dados->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Sexo removido com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir sexo.');
        }
    }
}
