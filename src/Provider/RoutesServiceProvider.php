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
     * Map the ditribution routes.
     */
    public function map()
    {
        $prefix = 'Anomaly\Streams\Addon\Distribution\Streams\Http\Controller\\';

        get(
            'installer',
            function () {
                return redirect('installer/system');
            }
        );

        get('installer/system', $prefix . 'SystemController@index');
        get('installer/license', $prefix . 'LicenseController@index');
        get('installer/configuration', $prefix . 'ConfigurationController@index');
        post('installer/install', $prefix . 'InstallController@install');

        get('/', $prefix . 'InstallController@complete');
    }
}