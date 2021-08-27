<?php

namespace Authentication\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Authentication\Http\Requests\RoleDeleteRequest;
use Authentication\Http\Requests\RoleRequest;
use Authentication\Repositories\RoleRepository;
use Authentication\Annotations\Mapping as Permissions;

/**
 * Class RolesController
 * @package Authentication\Http\Controllers
 * @Permissions\ControllerAnnotation(name="admin-roles", description="(Authentication) - Administração de Papeis")
 */
class RolesController extends Controller
{
    private $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Permissions\ActionAnnotation(name="list", description="Ver listagem de Papeis")
     */
    public function index()
    {
        $dados = $this->repository->paginate();
        return view('authentication::roles.index', compact('dados'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Permissions\ActionAnnotation(name="create", description="Adicionar Papeis")
     */
    public function create()
    {
        return view('authentication::roles.create');
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @Permissions\ActionAnnotation(name="create", description="Adicionar Papeis")
     */
    public function store(RoleRequest $request)
    {
        try {
            $this->repository->create($request->all());
            return redirect()->route('admin.role.index')->with('message', 'Role cadastrada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar cadastrar role' . $e->getMessage())->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Permissions\ActionAnnotation(name="edit", description="Editar Papeis")
     */
    public function edit($id)
    {
        $dados = $this->repository->find($id);
        return view('authentication::roles.edit', compact('dados'));
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @Permissions\ActionAnnotation(name="edit", description="Editar Papeis")
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $inputs = $request->except('permissions');
            $this->repository->update($inputs, $id);
            return redirect()->route('admin.role.index')->with('message', 'Role alterada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar alterar role')->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @Permissions\ActionAnnotation(name="delete", description="Excluir Papeis")
     */
    public function destroy(RoleDeleteRequest $request, $id)
    {
        try {
            $this->repository->delete($id);
            return redirect()->back()->with('message', 'Role excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir role');
        }
    }
}
