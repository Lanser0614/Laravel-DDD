<?php

namespace Modules\UI\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\BaseModule\RegisterInterfaceRealisation\RegisterInterfaceRealisation;

class InterfaceBindServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach (RegisterInterfaceRealisation::$binds as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
