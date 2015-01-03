<?php namespace Anomaly\StreamsDistribution\Provider;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    /**
     * Map the distribution routes.
     */
    public function map()
    {
        // Map the one page installer.
        get('installer', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@index');
        post('installer', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@index');

        // This is the "installation complete" page.
        get('/', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@complete');
    }
}