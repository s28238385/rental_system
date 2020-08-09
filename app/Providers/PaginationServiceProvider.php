<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\BootstrapFourPresenter;
use Illuminate\Pagination\Paginator;

class PaginationServiceProvider extends ServiceProvider
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
        //提供分頁按鈕Bootstrap 4的CSS樣式
        Paginator::presenter(function($paginator)
        {
            return new BootstrapFourPresenter($paginator);
        });
    }
}
