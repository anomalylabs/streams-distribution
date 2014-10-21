<?php namespace Anomaly\Streams\Distribution\Streams\Provider;

class RoutesServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
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
        $prefix = 'Streams\Addon\Distribution\Base\Http\Controller\\';

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
        get('installer/complete', $prefix . 'InstallController@complete');
    }
}