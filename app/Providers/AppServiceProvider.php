<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        
        if (!defined('ADMIN')) {
            define('ADMIN', config('variables.APP_ADMIN', 'admin'));
        }
        $config = Configuration::find(1);
        config([
            'paypal.sandbox' =>[
                'username' => $config->paypal_username,
                'password' => $config->paypal_password,
                'secret' => $config->paypal_secret,
                'certificate' => '',
                'app_id' => 'APP-80W284485P519543T',
                ],
            'paypal.mode' => 'sandbox',
        ]);
        require_once base_path('resources/macros/form.php');
        Schema::defaultStringLength(191);
    }
}
