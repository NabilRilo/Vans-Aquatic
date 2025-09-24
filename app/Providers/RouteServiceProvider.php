<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(function () {
                    require base_path('routes/api.php');
                });

            Route::middleware('web')
                ->group(function () {
                    require base_path('routes/web.php');
                });
        });
    }
}
