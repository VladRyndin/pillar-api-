<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Order\V1\OrderDetailsInterface;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(OrderDetailsInterface::class, function () {
            $service = config("orders.api.versions")[get_api_version()];
            return new $service();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
