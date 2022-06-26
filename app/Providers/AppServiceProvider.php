<?php

namespace App\Providers;

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
        $this->app->bind('App\Handlers\ArtistEntityInterface', 'App\Handlers\Repositories\ArtistEntity');
        $this->app->bind('App\Handlers\AlbumEntityInterface', 'App\Handlers\Repositories\AlbumEntity');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
