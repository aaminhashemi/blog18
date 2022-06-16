<?php

namespace User\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
                //$user=auth()->user();
                //dd($user);
                //$permissions=$user->getAllPermissions();
               // /if (in_array('manage_users',$permissions)){
                    config()->prepend('sidebar', [
                        "href" => "#users",
                        "id" => "users",
                        "key" => 7,
                        "class" => "iconsminds-shop-4",
                        "title" => "کاربران",
                        "permission" => "manage_permissions",
                        "options" => [
                            ["icon" => "fa fa-list", "key" => 71, "title" => "کاربر ها", "url" => '/home/users'],
                            ["icon" => "fa fa-list", "key" => 711, "title" => "افزودن کاربر", "url" => '/home/users/create'],
                        ]
                    ]);
               // }


        });

    }

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

}
