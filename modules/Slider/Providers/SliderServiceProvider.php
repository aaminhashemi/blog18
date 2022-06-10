<?php

namespace Slider\Providers;

use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/slider_routes.php');
    }
}
