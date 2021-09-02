<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoRequest;
use App\Http\Requests\EscolaridadeRequest;
use App\Contracts\Repositories\PessoaRepository;
use App\Models\Escolaridade;
use App\Models\Estado;
use App\Models\EstadoCivil;
use App\Models\Sexo;

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
        $sexo = Sexo::query()->orderBy('nome')->pluck('nome', 'id');
        $estado = Estado::query()->orderBy('nome')->pluck('nome', 'id');
        $escolaridade = Escolaridade::query()->orderBy('codigo')->pluck('nome', 'id');
        $estadoCivil = EstadoCivil::query()->orderBy('codigo')->pluck('nome', 'id');
        return view('admin.pessoa.create', compact('sexo', 'estado', 'escolaridade', 'estadoCivil'));
    }

    public function store(CurriculoRequest $request)
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

    public function update(CurriculoRequest $request, $uuid)
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
