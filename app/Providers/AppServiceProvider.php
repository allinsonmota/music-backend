<?php

namespace App\Providers;

use App\Repositories\AlbumRepository;
use App\Repositories\AlbumRepositoryInterface;
use App\Repositories\ArtistRepository;
use App\Repositories\ArtistRepositoryInterface;
use App\Repositories\SongRepository;
use App\Repositories\SongRepositoryInterface;
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
        $this->app->bind(
            ArtistRepositoryInterface::class,
            ArtistRepository::class
        );
        $this->app->bind(
            AlbumRepositoryInterface::class,
            AlbumRepository::class
        );
        $this->app->bind(
            SongRepositoryInterface::class,
            SongRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
