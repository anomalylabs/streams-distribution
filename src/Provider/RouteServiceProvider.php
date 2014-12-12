<?php namespace Anomaly\Streams\Addon\Distribution\Streams\Provider;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    /**
     * Map the distribution routes.
     */
    public function map()
    {
        // Map the one page installer.
        get('installer', 'Anomaly\Streams\Addon\Distribution\Streams\Http\Controller\InstallerController@index');
        post('installer', 'Anomaly\Streams\Addon\Distribution\Streams\Http\Controller\InstallerController@index');

        // This is the "installation complete" page.
        get('/', 'Anomaly\Streams\Addon\Distribution\Streams\Http\Controller\InstallController@complete');
    }
}