<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\EstadoCivilRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoCivilRequest;
use App\Models\EstadoCivil;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-estado_civil", description="Administração de Estado Civil")
 */
class EstadoCivilController extends Controller
{
    private $repository;

    public function __construct(EstadoCivilRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="index", description="Lista")
     */
    public function index()
    {
        $dados = $this->repository->orderBy('codigo')->paginate();
        return view('admin.estado_civil.index', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
    public function create()
    {
        return view('admin.estado_civil.create');
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
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

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
    public function edit(EstadoCivil $dados)
    {
        return view('admin.estado_civil.edit', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
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

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="destroy", description="Exclusão")
     */
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
