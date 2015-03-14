<?php namespace Anomaly\StreamsDistribution;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class StreamsDistributionServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\StreamsDistribution
 */
class StreamsDistributionServiceProvider extends AddonServiceProvider
{

    /**
     * Register the service.
     */
    public function register()
    {
        $this->checkInstallation();
        $this->registerRoutes();
    }

    /**
     * If we're not in the installer and the distribution
     * file is not present than Streams is considered to
     * be NOT installed.
     *
     * In the case that Streams is not installed route
     * EVERYTHING to the installer.
     */
    protected function checkInstallation()
    {
        $application = app('Anomaly\Streams\Platform\Application\Application');

        if (app('request')->segment(1) !== 'installer' && !$application->isInstalled()) {

            app('router')->any(
                '{all}',
                function () {
                    return redirect(url('installer'));
                }
            )->where('all', '.*');

            return;
        }
    }

    /**
     * Register distribution routes.
     */
    protected function registerRoutes()
    {
        $this->app->register('Anomaly\StreamsDistribution\StreamsDistributionRouteProvider');
    }
}
