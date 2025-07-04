<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        if (!function_exists('getWeatherIcon')) {
            function getWeatherIcon($condition)
            {

                if ($condition == 'clear') {
                    return 'wi-day-sunny';
                } elseif ($condition == 'rain') {
                    return 'wi-day-rain';
                } elseif ($condition == 'cloudy') {
                    return 'wi-day-cloudy';
                } else {
                    return 'wi-day-sunny';
                }
            }
        }
    }
}
