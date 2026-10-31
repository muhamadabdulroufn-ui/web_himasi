<?php

namespace App\Providers;

use App\Models\Profiles;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;

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
        view()->composer('*', function (View $view) {
            $site_settings = Profiles::where('id', 1)->first() ?? new Profiles([
                'name' => 'HIMASI UNUSA',
                'description' => '',
                'address' => '',
                'address_link' => '',
                'telpon' => '',
                'email' => '',
                'logo' => null,
                'vision' => '',
                'mission' => '',
                'organization' => null,
                'filosofi_logo' => null,
            ]);

            $view->with('profiles', $site_settings);
        });
    }
}
