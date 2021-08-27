<?php

namespace Authentication\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Authentication\Http\Requests\UserRequest;
use Authentication\Repositories\RoleRepository;
use Authentication\Repositories\UserRepository;
use Authentication\Annotations\Mapping as Permissions;

/**
 * Class UsersController
 * @package Authentication\Http\Controllers
 * @Permissions\ControllerAnnotation(name="admin-users", description="(Authentication) - Administração de Usuários")
 */
class UsersController extends Controller
{
    private $repository;
    private $roleRepository;

    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @Permissions\ActionAnnotation(name="list", description="Ver listagem de Usuários")
     */
    public function index()
    {
        $dados = $this->repository->paginate();
        return view('authentication::users.index', compact('dados'));
    }

    /**
     * @Permissions\ActionAnnotation(name="create", description="Adicionar Usuários")
     */
    public function create()
    {
        $roles = $this->roleRepository->pluck('name', 'id');
        return view('authentication::users.create', compact('roles'));
    }

    /**
     * @Permissions\ActionAnnotation(name="create", description="Adicionar Usuários")
     */
    public function store(UserRequest $request)
    {
        try {
            \DB::transaction(function () use ($request) {
                $this->repository->create($request->all());
            });
            return redirect()->route('user.index')->with('message', 'Usuário cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar cadastrar usuário' . $e->getMessage())->withInput();
        }
    }

    /**
     * @Permissions\ActionAnnotation(name="edit", description="Editar Usuários")
     */
    public function edit($id)
    {
        $dados = $this->repository->find($id);
        $roles = $this->roleRepository->pluck('name', 'id');
        return view('authentication::users.edit', compact('dados', 'roles'));
    }

    /**
     * @Permissions\ActionAnnotation(name="edit", description="Editar Usuários")
     */
    public function update(UserRequest $request, $id)
    {
        try {
            \DB::transaction(function () use ($request, $id) {
                $this->repository->update($request->all(), $id);
            });
            return redirect()->route('user.index')->with('message', 'Usuário alterado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar alterar usuário')->withInput();
        }
    }

    /**
     * @Permissions\ActionAnnotation(name="delete", description="Excluir Usuários")
     */
    public function destroy($id)
    {
        try {
            \DB::transaction(function () use ($id) {
                $this->repository->delete($id);
            });
            return redirect()->route('user.index')->with('message', 'Usuário excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message-danger', 'Erro ao tentar excluir usuário');
        }
    }
}
