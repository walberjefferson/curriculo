<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Contracts\Repositories\SexoRepository::class, \App\Repositories\Eloquent\SexoRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\CidadeRepository::class, \App\Repositories\Eloquent\CidadeRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\EscolaridadeRepository::class, \App\Repositories\Eloquent\EscolaridadeRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\EstadoCivilRepository::class, \App\Repositories\Eloquent\EstadoCivilRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\ExperienciaRepository::class, \App\Repositories\Eloquent\ExperienciaRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\HabilidadeRepository::class, \App\Repositories\Eloquent\HabilidadeRepositoryEloquent::class);
        $this->app->bind(\App\Contracts\Repositories\PessoaRepository::class, \App\Repositories\Eloquent\PessoaRepositoryEloquent::class);
        //:end-bindings:
    }
}
