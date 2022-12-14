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
        //
        $this->app->bind(
            'App\Repositories\Contracts\BookStoreRepositoryInterface',
            'App\Repositories\Eloquent\BookStoreRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CategoryRepositoryInterface',
            'App\Repositories\Eloquent\CategoryRepository'
        );
        
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );
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
