<?php


namespace Brand\Providers;


use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            config()->prepend('sidebar', [
                "href" => "#brands",
                "id" => "brands",
                "key"=> 55,
                "class" => "iconsminds-shop-4",
                "title" => "برند ها",
                "permission" => "manage products",
                "options" => [
                    ["icon" => "fa fa-list", "key"=> 56, "title" => "لیست برند ها", "url" => '/home/brands'],
                    ["icon" => "fa fa-list", "key"=> 56, "title" => "افزودن برند", "url" => '/home/brands/create'],
                ]
            ]);
        });
    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/brand_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
