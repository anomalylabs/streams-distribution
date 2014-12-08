<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Provider;

class RoutesServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{

    protected $middleware = [];

    /**
     * Filter before routing.
     */
    public function before()
    {
    }

    /**
     * Map the distribution routes.
     */
    public function map()
    {
        $prefix = 'Anomaly\Streams\Addon\Distribution\Streams\Http\Controller\\';

        get('installer', $prefix . 'InstallerController@index');
        post('installer', $prefix . 'InstallerController@index');

        get('/', $prefix . 'InstallController@complete');
    }
}