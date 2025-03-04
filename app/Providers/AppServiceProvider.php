<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Shop;
use App\Observers\OrderObserver;
use App\Observers\ShopObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Shop::observe(ShopObserver::class);
        Order::observe(OrderObserver::class);
    }
}
