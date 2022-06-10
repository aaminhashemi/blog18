<?php

namespace Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/category_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
    }

    public function register()
    {

    }
}
