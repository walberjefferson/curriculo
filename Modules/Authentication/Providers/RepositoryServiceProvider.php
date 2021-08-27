<?php

namespace Authentication\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Authentication\Repositories\PermissionRepository::class, \Authentication\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\Authentication\Repositories\RoleRepository::class, \Authentication\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\Authentication\Repositories\UserRepository::class, \Authentication\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
