<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SexoRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\SexoRepository;
use App\Models\Sexo;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-sexo", description="Administração de Sexos")
 */
class SexoController extends Controller
{
    private $repository;

    public function __construct(SexoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="index", description="Lista")
     */
    public function index()
    {
        $dados = $this->repository->orderBy('nome')->paginate();
        return view('admin.sexo.index', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
    public function create()
    {
        return view('admin.sexo.create');
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
    public function store(SexoRequest $request)
    {
        try {
            \DB::beginTransaction();
            $this->repository->create($request->validated());
            \DB::commit();
            return redirect()->route('admin.sexo.index')->with('message', 'Sexo adicionado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar cadastrar sexo.');
        }
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
    public function edit(Sexo $dados)
    {
        return view('admin.sexo.edit', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
    public function update(SexoRequest $request, Sexo $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->update($request->validated(), $dados->id);
            \DB::commit();
            return redirect()->route('admin.sexo.index')->with('message', 'Sexo atualizado com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('message-danger', 'Erro ao tentar atualizar sexo.');
        }
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="destroy", description="Exclusão")
     */
    public function destroy(Sexo $dados)
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
