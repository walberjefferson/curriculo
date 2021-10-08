<?php

namespace App\Http\Controllers\Admin;


use App\Contracts\Repositories\CidadeRepository;
use App\Criteria\JoinCidadeAndEstadoCriteria;
use App\Http\Controllers\Controller;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-cidade", description="Administração de Cidades")
 */
class CidadeController extends Controller
{
    private $repository;

    public function __construct(CidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="index", description="Lista")
     */
    public function index()
    {
        $this->repository->pushCriteria(JoinCidadeAndEstadoCriteria::class);
        $dados = $this->repository->with('estado')->orderBy('e.nome')->orderBy('cidade.nome')
            ->paginate();
        return view('admin.cidade.index', compact('dados'));
    }
}
