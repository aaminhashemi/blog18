<?php


namespace Brand\Providers;


use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/brand_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
