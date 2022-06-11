<?php

namespace Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            config()->prepend('sidebar', [
                "href" => "#categories",
                "id" => "categories",
                "key"=> 1,
                "class" => "iconsminds-shop-4",
                "title" => "دسته بندی ها",
                "permission" => "manage_categories",
                "options" => [
                    ["icon" => "fa fa-list", "key"=> 2, "title" => "دسته بندی ها", "url" => '/home/categories'],
                    ["icon" => "fa fa-list" , "key"=> 3, "title" => "افزودن دسته بندی", "url" => '/home/categories/create'],
                ]
            ]);
        });
    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/category_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
    }
}
