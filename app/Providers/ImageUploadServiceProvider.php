<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ImageUploader;

class ImageUploadServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Models\ImageUploader', function() {
            return new ImageUploader();
        });
    }

}
