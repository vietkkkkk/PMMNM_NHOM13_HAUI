<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use  App\Models\AdminModel;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole', function($expression) {
            if(Auth::user()) {
                if(Auth::user()->hasAnyRoles($expression)) {
                    return true;
                }
            }
            return false;
        });
        Blade::if('users_transfer', function() {
            if(session()->get('users_transfer')) {
                return true;
            }
            return false;
        });
    }
}
