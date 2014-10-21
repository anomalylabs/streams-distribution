<?php namespace Anomaly\Streams\Distribution\Base;

use Illuminate\Support\ServiceProvider;

class BaseDistributionServiceProvider extends ServiceProvider
{
    /**
     * Register the service.
     */
    public function register()
    {
        // Register routes.
        $this->app->register('Streams\Addon\Distribution\Base\Provider\RoutesServiceProvider');
    }
}
