<?php

namespace Ducnm\app\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    public function boot(): void
    {
        $this->_loadViews();
        $this->_loadConfig();
        $this->_loadMigrations();
    }

    private function _loadConfig(): void
    {
        $dir = base_path('src/config');

        foreach (glob($dir . '/*.php') as $file) {
            $key = basename($file, '.php');
            config([$key => require $file]);
        }
    }

    private function _loadViews(): void
    {
        View::addLocation(base_path('src/resources/views'));
    }

    private function _loadMigrations(): void
    {
        $customMigrationPath = base_path('src/database/migrations');

        $this->loadMigrationsFrom($customMigrationPath);
    }
}
