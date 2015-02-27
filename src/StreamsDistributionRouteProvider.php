<?php namespace Anomaly\StreamsDistribution;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class StreamsDistributionRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution
 */
class StreamsDistributionRouteProvider extends RouteServiceProvider
{

    /**
     * Map the installer routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Map the one page installer.
        $router->get('installer', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@index');
        $router->post('installer', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@index');

        // This is the "installation complete" page.
        $router->get('installer/complete', 'Anomaly\StreamsDistribution\Http\Controller\InstallerController@complete');
    }
}
