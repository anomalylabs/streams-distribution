<?php namespace Anomaly\Streams\Distribution\Streams;

use Illuminate\Support\ServiceProvider;

class StreamsDistributionServiceProvider extends ServiceProvider
{
    /**
     * Register the service.
     */
    public function register()
    {
        // Register routes.
        $this->app->register('Streams\Addon\Distribution\Streams\Provider\RoutesServiceProvider');
    }
}
