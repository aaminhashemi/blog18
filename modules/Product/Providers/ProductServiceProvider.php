<?php

namespace Product\Providers;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->booted(function () {
            config()->prepend('sidebar', [
                "href" => "#products",
                "id" => "products",
                "key"=> 33,
                "class" => "iconsminds-shop-4",
                "title" => "محصولات",
                "permission" => "manage products",
                "options" => [
                    ["icon" => "fa fa-list", "key"=> 331, "title" => "لیست محصولات ها", "url" => '/home/permissions'],
                    ["icon" => "fa fa-list", "key"=> 332, "title" => "افزودن محصول", "url" => '/home/permissions/create'],
                ]
            ]);
        });

    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/product_routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
