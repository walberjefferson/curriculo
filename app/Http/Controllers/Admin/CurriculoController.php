<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\PessoaRepository;
use App\Http\Controllers\Controller;
use App\Models\Escolaridade;
use App\Models\Estado;
use App\Models\EstadoCivil;
use App\Models\Pessoa;
use App\Models\Sexo;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-curriculo", description="Administração de Currículo")
 */
class CurriculoController extends Controller
{
    private $repository;

    public function __construct(PessoaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="index", description="Lista")
     */
    public function index()
    {
        $dados = $this->repository->orderBy('nome')->paginate();
        return view('admin.pessoa.index', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="store", description="Criação")
     */
    public function create()
    {
        $sexo = Sexo::query()->orderBy('nome')->pluck('nome', 'id');
        $estado = Estado::query()->orderBy('nome')->pluck('nome', 'id');
        $escolaridade = Escolaridade::query()->orderBy('codigo')->pluck('nome', 'id');
        $estadoCivil = EstadoCivil::query()->orderBy('codigo')->pluck('nome', 'id');
        return view('admin.pessoa.create', compact('sexo', 'estado', 'escolaridade', 'estadoCivil'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="show", description="Visualização")
     */
    public function show(Pessoa $dados)
    {
        $dados->load(['experiencias', 'habilidades', 'escolaridade', 'estado_civil', 'sexo', 'estado', 'cidade'])
            ->loadCount(['habilidades', 'experiencias']);
        return view('admin.pessoa.show', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="update", description="Atualização")
     */
    public function edit(Pessoa $dados)
    {
        return view('admin.pessoa.edit', compact('dados'));
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="destroy", description="Exclusão")
     */
    public function destroy(Pessoa $dados)
    {
        try {
            \DB::beginTransaction();
            $this->repository->delete($dados->id);
            \DB::commit();
            return redirect()->back()->with('message-warning', 'Escolaridade removido com sucesso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir pessoa.');
        }
    }
}
