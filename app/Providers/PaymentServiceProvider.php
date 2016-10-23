<?php

namespace App\Providers;

use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

            $key = $app['config']['paymentservice.private_key'];

            if (Str::startsWith($key, 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }
            return new PaymentService(
                $app['config']['paymentservice.consumer_key'],
                $app['config']['paymentservice.key_alias'],
                $app['config']['paymentservice.key_password'],
                $key
            );
        });
    }

    public function provides()
    {
        return [PaymentService::class];
    }
}
