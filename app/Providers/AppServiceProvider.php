<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Адреса складов в Китае для бокового меню — на любой странице, независимо от контроллера
        View::composer('layouts.navigation', function ($view) {
            $config = Configuration::query()->select('address', 'address_talgar')->first();

            $view->with('warehouses', array_filter([
                'Жетісу' => $config?->address,
                'Талгар' => $config?->address_talgar,
            ]));
        });
    }
}
