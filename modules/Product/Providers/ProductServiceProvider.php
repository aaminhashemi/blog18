<?php

namespace Product\Providers;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/product_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function register()
    {

    }
}
