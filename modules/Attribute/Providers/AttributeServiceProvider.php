<?php

namespace Attribute\Providers;

use Illuminate\Support\ServiceProvider;

class AttributeServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/attribute_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
