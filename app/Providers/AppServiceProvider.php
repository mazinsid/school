<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\class_room;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.header'], function ($view) {
            $classRooms = class_room::all();
                $view->with('ClassRooms', $classRooms);
            });
    }
}
