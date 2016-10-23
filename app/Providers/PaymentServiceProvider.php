<?php

namespace App\Providers;

use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(PaymentService::class, function ($app) {
            return new PaymentService(
                $app['config']['paymentservice.consumer_key'],
                $app['config']['paymentservice.key_alias'],
                $app['config']['paymentservice.key_password'],
                $app['config']['paymentservice.private_key']
            );
        });
    }

    public function provides()
    {
        return [PaymentService::class];
    }
}
