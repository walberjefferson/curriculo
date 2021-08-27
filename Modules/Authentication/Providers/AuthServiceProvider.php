<?php

namespace Authentication\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Authentication\Criteria\FindPermissionResourceCriteria;
use Authentication\Models\User;
use Authentication\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        \Gate::define('super-admin', function (User $user) {
            return $user->isAdmin();
        });

        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            /** @var PermissionRepository $permissionRepository */
            $permissionRepository = app(PermissionRepository::class);
            $permissionRepository->pushCriteria(FindPermissionResourceCriteria::class);
            $permissions = $permissionRepository->all();
            foreach ($permissions as $p) {
                \Gate::define("{$p->name}/{$p->resource_name}", function (User $user) use ($p) {
                    return $user->hasRole($p->roles);
                });
            }
        }
    }
}
