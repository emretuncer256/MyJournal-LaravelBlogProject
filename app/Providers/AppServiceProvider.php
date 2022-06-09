<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfigModel as CM;

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
        view()->share('config', CM::find(1));
    }
}
