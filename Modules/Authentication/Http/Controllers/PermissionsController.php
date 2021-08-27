<?php

namespace Authentication\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Authentication\Models\Role;
use Authentication\Http\Requests\PermissionRequest;
use Authentication\Repositories\PermissionRepository;
use Authentication\Criteria\FindPermissionGroupCriteria;
use Authentication\Criteria\FindPermissionResourceCriteria;
use Authentication\Repositories\RoleRepository;
use Authentication\Annotations\Mapping as Permissions;

/**
 * Class UsersController
 * @package Authentication\Http\Controllers
 * @Permissions\ControllerAnnotation(name="admin-permission", description="(Authentication) - Administração de Permissões")
 */
class PermissionsController extends Controller
{
    private $repository;
    private $roleRepository;

    public function __construct(PermissionRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Permissions\ActionAnnotation(name="edit", description="Alterar Permissões")
     */
    public function edit(Role $role)
    {
        $this->repository->pushCriteria(FindPermissionResourceCriteria::class);
        $permissions = $this->repository->all();

        $this->repository->resetCriteria();
        $this->repository->pushCriteria(FindPermissionGroupCriteria::class);
        $permissionsGroup = $this->repository->all(['name', 'description']);

        return view('authentication::permissions.edit', compact('role', 'permissions', 'permissionsGroup'));
    }

    /**
     * @param PermissionRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @Permissions\ActionAnnotation(name="edit", description="Alterar Permissões")
     */
    public function update(PermissionRequest $request, Role $role)
    {
        try {
            $permissions = $request->get('permissions', []);
            $this->roleRepository->update_permissions($permissions, $role->id);
            return redirect()->route('admin.role.index')->with('message', 'Permissões atribuidas com sucesso.');
        } catch (QueryException $e) {
            return redirect()->back()->with('message-danger', 'Não foi possível atribuir permissões')->withInput();
        }
    }
}
