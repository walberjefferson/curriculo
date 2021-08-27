<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->formularios();
        Paginator::defaultView('pagination::bootstrap-4');
    }

    protected function formularios()
    {
        \Form::macro('error', function ($field, $errors) {
            if (!str_contains($field, '*') && $errors->has($field) || count($errors->get($field)) > 0) {
                return view('errors.error_field', compact('field'));
            }
            return null;
        });

        \Html::macro('openFormGroup', function ($field = null, $errors = null, $class = null) {
            $result = false;
            if ($field != null and $errors != null) {
                if (is_array($field)) {
                    foreach ($field as $value) {
                        if (!str_contains($value, '*') && $errors->has($value) || count($errors->get($value)) > 0) {
                            $result = true;
                            break;
                        }
                    }
                } else {
                    if (!str_contains($field, '*') && $errors->has($field) || count($errors->get($field)) > 0) {
                        $result = true;
                    }
                }
            }
            $hasError = $result ? ' has-error' : '';
            return "<div class=\"{$class} form-group{$hasError}\">";
        });

        \Html::macro('closeFormGroup', function () {
            return "</div>";
        });
    }
}
