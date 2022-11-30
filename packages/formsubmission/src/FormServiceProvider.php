<?php

namespace DissanayakeG\SimpleFormSubmission;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'formsubmission');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/contact.php','formsubmission');

        $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
        ]);

    }

    public function register()
    {

    }

}
