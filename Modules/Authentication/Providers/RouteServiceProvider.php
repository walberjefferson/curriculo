<?php

namespace Authentication\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $rootUrlNamespace = 'Authentication\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'auth', 'auth.resource'])->namespace($this->rootUrlNamespace)
            ->group(function () {
                require __DIR__ . '/../routes/web.php';
            });
    }

    protected function mapApiRoutes()
    {
        Route::group(['middleware' => 'api', 'namespace' => $this->rootUrlNamespace], function () {
            require __DIR__ . '/../routes/api.php';
        });
    }
}
