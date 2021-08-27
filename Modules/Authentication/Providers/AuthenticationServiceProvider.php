<?php

namespace Authentication\Providers;

use Authentication\Console\CreatePermissionCommand;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\FilesystemCache;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    protected $moduleNameLower = 'authentication';


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->bind(Reader::class, function () {
            return new CachedReader(
                new AnnotationReader(),
                new FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
                config('app.debug')
            );
        });
        $this->registerAnnotations();
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $this->commands([
            CreatePermissionCommand::class
        ]);
    }

    protected function registerAnnotations()
    {
        $loader = require __DIR__ . '/../../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', $this->moduleNameLower);
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', $this->moduleNameLower);
        }
    }
}
