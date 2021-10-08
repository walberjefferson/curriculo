<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\EstadoRepository;
use App\Http\Controllers\Controller;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-estado", description="Administração de Estados")
 */
class EstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="index", description="Lista")
     */
    public function index()
    {
        $dados = $this->repository->withCount('cidades')->orderBy('nome')->paginate();
        return view('admin.estado.index', compact('dados'));
    }
}
