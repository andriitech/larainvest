<?php

namespace App\Providers;

use App\Adapters\Contracts\DataProviderInterface;
use App\Adapters\Market\MarketDataAdapter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(DataProviderInterface::class, MarketDataAdapter::class);
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
