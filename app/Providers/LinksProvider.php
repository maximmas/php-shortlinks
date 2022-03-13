<?php

namespace App\Providers;

use App\Http\Controllers\Links;
use App\Services\ShortLinkCreator;
use Illuminate\Support\ServiceProvider;

class LinksProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Links::class, function($app){
            return new Links($app->make(ShortLinkCreator::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
