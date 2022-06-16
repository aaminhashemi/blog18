<?php

namespace Company\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            config()->prepend('sidebar', [
                "href" => "#companies",
                "id" => "companies",
                "key"=> 660,
                "class" => "iconsminds-shop-4",
                "title" => "شرکت های پخش",
                "permission" => "manage_companies",
                "options" => [
                    ["icon" => "fa fa-list", "key"=> 661, "title" => "شرکت ها", "url" => '/home/companies'],
                    ["icon" => "fa fa-list" , "key"=> 662, "title" => "افزودن شرکت", "url" => '/home/companies/create'],
                ]
            ]);
        });
    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/company_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
    }
}
