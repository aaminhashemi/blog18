<?php

namespace RolePermission\Providers;

use Illuminate\Support\ServiceProvider;

class RolePermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            config()->prepend('sidebar', [
                "href" => "#roles",
                "id" => "roles",
                "key"=> 88,
                "class" => "iconsminds-shop-4",
                "title" => "نقش های کاربری",
                "permission" => "manage_permissions",
                "options" => [
                    ["icon" => "fa fa-list", "key"=> 89, "title" => "دسترسی ها", "url" => '/home/permissions'],
                    ["icon" => "fa fa-list", "key"=> 90, "title" => "افزودن دسترسی", "url" => '/home/permissions/create'],
                    ["icon" => "fa fa-list" , "key"=> 91, "title" => "نقش ها", "url" => '/home/roles'],
                    ["icon" => "fa fa-list" , "key"=> 92, "title" => "افزودن نقش", "url" => '/home/roles/create'],
                ]
            ]);
        });
    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/role_permission_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
    }

}
